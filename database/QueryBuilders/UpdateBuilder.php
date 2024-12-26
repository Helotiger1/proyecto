<?php 
namespace App\Database\QueryBuilders;
class UpdateBuilder 
{
    private $table;
    private $select = '*';
    private $where = [];
    private $values = [];
    private $set = "";
    
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
    
    public function set($registro): self {
        $this->set = ' SET ' . implode(" , ",array_map(fn($col) => "$col = ?", array_keys($registro)));
        $this->values = [...$this->values,...array_values($registro)];
        return $this;
    }

    // UPDATE users SET name = 'Nuevo Nombre', age = 25 WHERE id = 10;
    public function toSQL() {

    if (!empty($this->set)) {
        $query .= $this->set;
    }
    
    if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }
    }
}


?>