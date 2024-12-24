<?php 
class InsertBuilder
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
    
    // INSERT INTO users (name, email, age) VALUES ('Anghelo', 'anghelo@example.com', 30);
    public function create() {
        $query = "INSERT INTO $this->table ($this->select) VALUES ()";
    }
    }

?>