<?php

namespace App\ORM;

use App\Database\Connection;

class QueryBuilder
{
    protected static $pdo;
    protected $modelClass;
    protected $table;

    protected $type = 'select';
    protected $columns = ['*'];
    protected $wheres = [];
    protected $bindings = [
        'where' => [],
        'having' => [],
        'insert' => [],
        'update' => [],
    ];
    protected $joins = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $having = [];
    protected $limit = null;
    protected $offset = null;
    protected $distinct = false;

    public function __construct(string $modelClass, string $table)
    {
        self::$pdo = Connection::connect();
        $this->modelClass = $modelClass;
        $this->table = $table;
    }

    public function getAttributes(): array
    {
        return [
            'modelClass' => $this->modelClass,
            'table' => $this->table,
            'type' => $this->type,
            'columns' => $this->columns,
            'wheres' => $this->wheres,
            'bindings' => $this->bindings,
            'joins' => $this->joins,
            'orderBy' => $this->orderBy,
            'groupBy' => $this->groupBy,
            'having' => $this->having,
            'limit' => $this->limit,
            'offset' => $this->offset,
            'distinct' => $this->distinct,
        ];
    }

    // ==================== MÉTODOS DE CONSTRUCCIÓN ====================

    public function select($columns = ['*']): self
    {
        $this->type = 'select';
        $this->columns = is_array($columns) ? $columns : func_get_args();
        return $this;
    }

    public function where($column, $operator = null, $value = null, $boolean = 'AND'): self
    {
        if (is_callable($column)) {
            return $this->whereNested($column, $boolean);
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

    public function orWhere($column, $operator = null, $value = null): self
    {
        return $this->where($column, $operator, $value, 'OR');
    }

    public function whereIn($column, array $values, $boolean = 'AND', $not = false): self
    {
        $this->wheres[] = [
            'type' => 'in',
            'column' => $column,
            'values' => $values,
            'boolean' => $boolean,
            'not' => $not
        ];

        $this->addBinding($values, 'where');
        return $this;
    }

    public function whereNested(\Closure $callback, $boolean = 'AND'): self
    {
        $nestedQuery = new self($this->modelClass, $this->table);
        $callback($nestedQuery);

        if (empty($nestedQuery->wheres)) {
            return $this;
        }

        $this->wheres[] = [
            'type' => 'nested',
            'query' => $nestedQuery,
            'boolean' => $boolean
        ];

        $this->addBinding($nestedQuery->bindings['where'], 'where');
        return $this;
    }

    public function join($table, $first, $operator = null, $second = null, $type = 'INNER'): self
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
                "{$previousTable}.{$column}",
                '=',
                "{$table}.{$column}"
            );
            $previousTable = $table;
        }

        return $this;
    }

    public function orderBy($column, $direction = 'ASC'): self
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

    public function having($column, $operator, $value, $boolean = 'AND'): self
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

    // ==================== MÉTODOS DE EJECUCIÓN ====================

    public function get(): array
    {
        $sql = $this->buildSelect();
        $results = $this->run($sql);
        return array_map(function ($item) {
            return $this->modelClass::hydrate($item);
        }, $results);
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function find($nameId, $id)
    {
        return $this->where($nameId, $id)->first();
    }

    public function insert(array $data): bool
    {
        $this->type = 'insert';
        $sql = $this->buildInsert($data);
        return $this->run($sql, false);
    }

    public function update(array $data): bool
    {
        $this->type = 'update';
        $sql = $this->buildUpdate($data);
        return $this->run($sql, false);
    }

    public function delete(): bool
    {
        $this->type = 'delete';
        $sql = $this->buildDelete();
        return $this->run($sql, false);
    }

    public function count(): int
    {
        $this->columns = ['COUNT(*) as count'];
        $result = $this->first();
        return $result->count ?? 0;
    }

    // ==================== MÉTODOS INTERNOS ====================

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
        return "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
    }

    protected function buildUpdate(array $data): string
    {
        $setClause = implode(', ', array_map(
            fn($col) => "{$col} = ?",
            array_keys($data)
        ));
        $this->addBinding(array_values($data), 'update');
        $whereClause = $this->buildWheres();
        $sql = "UPDATE {$this->table} SET {$setClause}";
        if ($whereClause) {
            $sql .= " {$whereClause}";
        }
        return $sql;
    }

    protected function buildDelete(): string
    {
        $whereClause = $this->buildWheres();
        return "DELETE FROM {$this->table} " . $whereClause;
    }

    protected function buildColumns(): string
    {
        if ($this->columns === ['*']) return '*';
        return implode(', ', $this->columns);
    }

    protected function buildWheres(): string
    {
        if (empty($this->wheres)) return '';

        $clauses = [];
        foreach ($this->wheres as $index => $where) {
            $clause = $index === 0 ? 'WHERE ' : "{$where['boolean']} ";

            switch ($where['type']) {
                case 'basic':
                    $clause .= "{$where['column']} {$where['operator']} ?";
                    break;
                case 'in':
                    $placeholders = implode(', ', array_fill(0, count($where['values']), '?'));
                    $clause .= "{$where['column']} " . ($where['not'] ? 'NOT IN' : 'IN') . " ({$placeholders})";
                    break;
                case 'nested':
                    $nestedClause = $where['query']->buildWheres();
                    $nestedClause = preg_replace('/^WHERE /', '', $nestedClause);
                    $clause .= "({$nestedClause})";
                    break;
            }

            $clauses[] = $clause;
        }

        return implode(' ', $clauses);
    }

    protected function buildJoins(): string
    {
        if (empty($this->joins)) return '';

        $clauses = [];
        foreach ($this->joins as $join) {
            $clause = "{$join['type']} JOIN {$join['table']} ON {$join['first']} {$join['operator']} {$join['second']}";
            $clauses[] = $clause;
        }

        return implode(' ', $clauses);
    }

    protected function buildGroupBy(): string
    {
        if (empty($this->groupBy)) return '';
        return 'GROUP BY ' . implode(', ', $this->groupBy);
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
        if (empty($this->orderBy)) return '';

        $clauses = [];
        foreach ($this->orderBy as $order) {
            $clauses[] = "{$order['column']} {$order['direction']}";
        }

        return 'ORDER BY ' . implode(', ', $clauses);
    }

    protected function buildLimit(): string
    {
        return $this->limit !== null ? "LIMIT {$this->limit}" : '';
    }

    protected function buildOffset(): string
    {
        return $this->offset !== null ? "OFFSET {$this->offset}" : '';
    }

    protected function addBinding($value, string $type = 'where'): void
    {
        if (!isset($this->bindings[$type])) {
            throw new \InvalidArgumentException("Invalid binding type: {$type}");
        }

        if (is_array($value)) {
            $this->bindings[$type] = array_merge($this->bindings[$type], $value);
        } else {
            $this->bindings[$type][] = $value;
        }
    }

    protected function run(string $sql, bool $fetch = true)
    {
        try {
            $stmt = self::$pdo->prepare($sql);

            $bindings = [];
            switch ($this->type) {
                case 'insert':
                    $bindings = $this->bindings['insert'];
                    break;
                case 'update':
                    $bindings = array_merge(
                        $this->bindings['update'],
                        $this->bindings['where']
                    );
                    break;
                case 'delete':
                    $bindings = $this->bindings['where'];
                    break;
                default: // select
                    $bindings = array_merge(
                        $this->bindings['where'],
                        $this->bindings['having']
                    );
                    break;
            }

            $stmt->execute($bindings);
            $this->reset();
            return $fetch ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : true;
        } catch (\PDOException $e) {
            throw new \Exception("Query error: " . $e->getMessage());
        }
    }

    protected function reset(): void
    {
        $this->type = 'select';
        $this->columns = '*';
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
