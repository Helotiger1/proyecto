<?php
namespace App\ORM;

use PDO;
use PDOException;
use InvalidArgumentException;

class QueryBuilder
{
    // ==================== PROPIEDADES ====================
    protected PDO $pdo;
    protected ?string $table = null;

    protected string $type = 'select';
    protected array $columns = ['*'];
    protected array $wheres = [];
    protected array $bindings = [
        'where' => [],
        'having' => [],
        'insert' => [],
        'update' => [],
    ];
    protected array $joins = [];
    protected array $orderBy = [];
    protected array $groupBy = [];
    protected array $having = [];
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected bool $distinct = false;

    // ==================== CONSTRUCTOR ====================
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // ==================== MÉTODOS PÚBLICOS ====================
    
    // ------------ Configuración inicial ------------
    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    // ------------ Métodos de construcción ------------
    public function select($columns = ['*']): self
    {
        $this->type = 'select';
        $this->columns = is_array($columns) ? $columns : func_get_args();
        return $this;
    }

    public function where($column, $operator = null, $value = null, string $boolean = 'AND'): self
    {

        if (empty($column)) {
            throw new InvalidArgumentException("Column name cannot be empty");
        }
        
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->wheres[] = [
            'type' => 'basic',
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ];
        
        $this->addBinding($value, 'where');
        return $this;
    }

    public function join(string $table, string $first, ?string $operator = null, ?string $second = null, string $type = 'INNER'): self
    {
        $this->joins[] = [
            'table' => $table,
            'first' => $first,
            'operator' => $operator,
            'second' => $second,
            'type' => $type
        ];
        return $this;
    }

    public function joinNested(array $relations): self
    {
        if (empty($relations)) return $this;

        $previousTable = $this->table;
        foreach ($relations as $table => $column) {
            $this->join(
                $table,
                "$previousTable.$column",
                '=',
                "$table.$column"
            );
            $previousTable = $table;
        }
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = [
            'column' => $column,
            'direction' => strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC'
        ];
        return $this;
    }

    public function groupBy(...$groups): self
    {
        $this->groupBy = array_merge($this->groupBy, $groups);
        return $this;
    }

    public function having(string $column, string $operator, $value, string $boolean = 'AND'): self
    {
        $this->having[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ];
        $this->addBinding($value, 'having');
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function distinct(): self
    {
        $this->distinct = true;
        return $this;
    }

    // ------------ Métodos de ejecución ------------
    public function get(): array
    {
        $sql = $this->buildSelect();
        return $this->run($sql);
    }

    public function first(): ?array
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function find(string $column, $value): ?array
    {
        return $this->where($column, $value)->first();
    }

    public function insert(array $data): bool
    {
        $this->type = 'insert';
        return $this->run($this->buildInsert($data), false);
    }

    public function update(array $data): bool
    {
        $this->type = 'update';
        return $this->run($this->buildUpdate($data), false);
    }

    public function delete(): bool
    {
        $this->type = 'delete';
        return $this->run($this->buildDelete(), false);
    }

    public function count(): int
    {
        $this->columns = ['COUNT(*) as count'];
        $result = $this->first();
        return (int) ($result['count'] ?? 0);
    }

    // ==================== MÉTODOS PROTEGIDOS ====================
    
    // ------------ Construcción de queries ------------
    protected function buildSelect(): string
    {
        $components = [
            'SELECT' . ($this->distinct ? ' DISTINCT' : ''),
            $this->buildColumns(),
            'FROM ' . $this->table,
            $this->buildJoins(),
            $this->buildWheres(),
            $this->buildGroupBy(),
            $this->buildHaving(),
            $this->buildOrderBy(),
            $this->buildLimit(),
            $this->buildOffset()
        ];

        return implode(' ', array_filter($components));
    }

    protected function buildInsert(array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $this->addBinding(array_values($data), 'insert');
        return "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
    }

    protected function buildUpdate(array $data): string
    {
        $setClause = implode(', ', array_map(
            fn($col) => "$col = ?",
            array_keys($data)
        ));
        
        $this->addBinding(array_values($data), 'update');
        $whereClause = $this->buildWheres();
        
        return "UPDATE $this->table SET $setClause" . ($whereClause ? " $whereClause" : '');
    }

    protected function buildDelete(): string
    {
        return "DELETE FROM $this->table" . $this->buildWheres();
    }

    // ------------ Componentes de queries ------------
    protected function buildColumns(): string
    {
        return implode(', ', $this->columns);
    }

    protected function buildWheres(): string
    {
        if (empty($this->wheres)) return '';
        
        $clauses = [];
        foreach ($this->wheres as $index => $where) {
            $clause = $index === 0 ? 'WHERE ' : "{$where['boolean']} ";
            $clause .= "{$where['column']} {$where['operator']} ?";
            $clauses[] = $clause;
        }
        
        return implode(' ', $clauses);
    }

    protected function buildJoins(): string
    {
        if (empty($this->joins)) return '';
        
        return implode(' ', array_map(
            fn($join) => "{$join['type']} JOIN {$join['table']} ON {$join['first']} {$join['operator']} {$join['second']}",
            $this->joins
        ));
    }

    protected function buildGroupBy(): string
    {
        return empty($this->groupBy) ? '' : 'GROUP BY ' . implode(', ', $this->groupBy);
    }

    protected function buildHaving(): string
    {
        if (empty($this->having)) return '';
        
        $clauses = [];
        foreach ($this->having as $index => $having) {
            $clause = $index === 0 ? 'HAVING ' : "{$having['boolean']} ";
            $clause .= "{$having['column']} {$having['operator']} ?";
            $clauses[] = $clause;
        }
        
        return implode(' ', $clauses);
    }

    protected function buildOrderBy(): string
    {
        return empty($this->orderBy) ? '' : 'ORDER BY ' . implode(', ', array_map(
            fn($order) => "{$order['column']} {$order['direction']}",
            $this->orderBy
        ));
    }

    protected function buildLimit(): string
    {
        return $this->limit ? "LIMIT $this->limit" : '';
    }

    protected function buildOffset(): string
    {
        return $this->offset ? "OFFSET $this->offset" : '';
    }

    // ------------ Gestión de bindings ------------
    protected function addBinding($value, string $type = 'where'): void
    {
        if (!array_key_exists($type, $this->bindings)) {
            throw new InvalidArgumentException("Invalid binding type: $type");
        }

        $this->bindings[$type] = array_merge(
            $this->bindings[$type],
            is_array($value) ? $value : [$value]
        );
    }

    // ------------ Ejecución y reset ------------
    protected function run(string $sql, bool $fetch = true)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $bindings = $this->prepareBindings();
            
            $stmt->execute($bindings);
            $result = $fetch ? $stmt->fetchAll(PDO::FETCH_ASSOC) : true;
            
            $this->reset();
            return $result;
        } catch (PDOException $e) {
            throw new PDOException("Query error: " . $e->getMessage());
        }
    }

    protected function prepareBindings(): array
    {
        return match ($this->type) {
            'insert' => $this->bindings['insert'],
            'update' => array_merge($this->bindings['update'], $this->bindings['where']),
            'delete' => $this->bindings['where'],
            default => array_merge($this->bindings['where'], $this->bindings['having']),
        };
    }

    protected function reset(): void
    {
        $this->type = 'select';
        $this->columns = ['*'];
        $this->wheres = [];
        $this->bindings = [
            'where' => [],
            'having' => [],
            'insert' => [],
            'update' => [],
        ];
        $this->joins = [];
        $this->orderBy = [];
        $this->groupBy = [];
        $this->having = [];
        $this->limit = null;
        $this->offset = null;
        $this->distinct = false;
    }
}
?>