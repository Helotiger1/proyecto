<?php 
namespace App\Database\QueryBuilders;
class InsertBuilder
{
    private $table = "";
    private $placeholders = "";
    private $columns = "";
    private $values = [];

    public function table(string $table): self {
        $this->table = $table;
        return $this;
    }

    public function values(array $values = []){
        $this->placeholders = str_repeat('?, ', count($values) - 1) . '?';
        $this->values[] = array_merge($this->values, $values);
        return $this;
    }

    public function columns(array $columns){
        $this->columns = implode(", ", $columns);
        return $this;
    }

    
    // INSERT INTO users (name, email, age) VALUES ('Anghelo', 'anghelo@example.com', 30);
    public function toSQL() {
        $query = "INSERT INTO $this->table ($this->columns)";

        if (!empty($this->values)) {
            $query .= implode(', ', $this->values);
        }
    
        return[
            'query' => $query,
            'values' => $this->values ?? []
        ];
    }
}

?>