<?php 
class QueryBuilder {
    protected $table;
    protected $select = '*';
    protected $where = [];
    protected $orderBy = [];
    protected $limit = null;
    
    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select($columns = '*') {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function where($column, $operator, $value) {
        $this->where[] = "$column $operator ?";
        $this->values[] = $value;
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function getQuery() {
        $query = "SELECT $this->select FROM $this->table";
        
        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }
        
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . implode(', ', $this->orderBy);
        }

        if ($this->limit) {
            $query .= " LIMIT $this->limit";
        }

        return $query;
    }

    public function getValues() {
        return $this->values ?? [];
    }
}
?>