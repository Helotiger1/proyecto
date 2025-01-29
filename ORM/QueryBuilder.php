<?php

class QueryBuilder {
    protected $pdo;
    protected $modelClass;
    protected $table;
    
    // Estado de la consulta
    protected $type = 'select';
    protected $columns = '*';
    protected $wheres = [];
    protected $bindings = [];
    protected $joins = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $having = [];
    protected $limit = null;
    protected $offset = null;
    protected $distinct = false;

    public function __construct(\PDO $pdo, string $modelClass, string $table) {
        $this->pdo = $pdo;
        $this->modelClass = $modelClass;
        $this->table = $table;
    }

    // ==================== MÉTODOS DE CONSTRUCCIÓN ====================

    public function select($columns = ['*']): self {
        $this->type = 'select';
        $this->columns = is_array($columns) ? $columns : func_get_args();
        return $this;
    }

    public function where($column, $operator = null, $value = null, $boolean = 'AND'): self {
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

    public function orWhere($column, $operator = null, $value = null): self {
        return $this->where($column, $operator, $value, 'OR');
    }

    public function whereIn($column, array $values, $boolean = 'AND', $not = false): self {
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

    public function join($table, $first, $operator = null, $second = null, $type = 'INNER'): self {
        if (is_callable($first)) {
            $join = new JoinClause($table, $type);
            $first($join);
            $this->joins[] = $join;
        } else {
            $this->joins[] = [
                'table' => $table,
                'first' => $first,
                'operator' => $operator,
                'second' => $second,
                'type' => $type
            ];
        }
        return $this;
    }

    public function orderBy($column, $direction = 'ASC'): self {
        $this->orderBy[] = [
            'column' => $column,
            'direction' => strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC'
        ];
        return $this;
    }

    public function groupBy(...$groups): self {
        $this->groupBy = array_merge($this->groupBy, $groups);
        return $this;
    }

    public function having($column, $operator, $value, $boolean = 'AND'): self {
        $this->having[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ];
        $this->addBinding($value, 'having');
        return $this;
    }

    public function limit(int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self {
        $this->offset = $offset;
        return $this;
    }

    public function distinct(): self {
        $this->distinct = true;
        return $this;
    }

    // ==================== MÉTODOS DE EJECUCIÓN ====================

    public function get(): array {
        $sql = $this->buildSelect();
        $results = $this->run($sql, $this->bindings);
        
        return array_map(function($item) {
            return $this->modelClass::hydrate($item);
        }, $results);
    }

    public function first() {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function find($id) {
        return $this->where('id', $id)->first();
    }

    public function insert(array $data): bool {
        $this->type = 'insert';
        $sql = $this->buildInsert($data);
        return $this->run($sql, $this->bindings, false);
    }

    public function update(array $data): bool {
        $this->type = 'update';
        $sql = $this->buildUpdate($data);
        return $this->run($sql, $this->bindings, false);
    }

    public function delete(): bool {
        $this->type = 'delete';
        $sql = $this->buildDelete();
        return $this->run($sql, $this->bindings, false);
    }

    public function count(): int {
        $this->columns = ['COUNT(*) as count'];
        $result = $this->first();
        return $result->count ?? 0;
    }

    // ==================== MÉTODOS INTERNOS ====================

    protected function buildSelect(): string {
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

    protected function buildInsert(array $data): string {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($col) => ":{$col}", array_keys($data)));
        $this->addBinding($data);
        return "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
    }

    protected function buildUpdate(array $data): string {
        $setClause = implode(', ', array_map(
            fn($col) => "{$col} = :{$col}", 
            array_keys($data)
        ));
        
        $this->addBinding($data);
        return "UPDATE {$this->table} SET {$setClause} " . $this->buildWheres();
    }

    protected function buildDelete(): string {
        return "DELETE FROM {$this->table} " . $this->buildWheres();
    }

    protected function buildColumns(): string {
        if ($this->columns === ['*']) return '*';
        return implode(', ', $this->columns);
    }

    protected function buildWheres(): string {
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
            }
            
            $clauses[] = $clause;
        }
        
        return implode(' ', $clauses);
    }

    protected function addBinding($value, $type = 'where'): void {
        if (is_array($value)) {
            $this->bindings = array_merge($this->bindings, $value);
        } else {
            $this->bindings[] = $value;
        }
    }

    protected function run(string $sql, array $bindings, bool $fetch = true) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bindings);
            $this->reset();
            return $fetch ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : true;
        } catch (\PDOException $e) {
            throw new \Exception("Query error: " . $e->getMessage());
        }
    }

    protected function reset(): void {
        $this->type = 'select';
        $this->columns = '*';
        $this->wheres = [];
        $this->bindings = [];
        $this->joins = [];
        $this->orderBy = [];
        $this->groupBy = [];
        $this->having = [];
        $this->limit = null;
        $this->offset = null;
        $this->distinct = false;
    }
}
