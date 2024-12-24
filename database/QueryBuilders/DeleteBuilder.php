<?php 
class DeleteBuilder
{
    private $table;
    private $select = '*';
    private $where = [];
    private $values = [];
    
    public function table(string $table): self {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): self {
        $this->select = implode(', ', $columns);
        return $this;
    }
    
    public function where(array $columns, array $operators): self {
        $this->where = array_map(fn($col, $op) => "$col $op ?", array_keys($columns), $operators);
        $this->values = [...$this->values,...array_values($columns)];
        return $this;
    }
    
    // DELETE FROM users WHERE id = 10 AND Country = "USA";
    public function delete() {
        $query = "DELETE FROM $this->table";
        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }
    }

}
?>