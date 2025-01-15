<?php 
namespace App\SQL;
class DeleteBuilder
{
    private $table;
    private $where = [];
    private $values = [];
    private $query = "";

    public function table(string $table): self {
        $this->table = $table;
        return $this;
    }
    
    public function where(array $columns, array $operators): self {
        $this->where = array_map(fn($col, $op) => "$col $op ?", array_keys($columns), $operators);
        $this->values = [...$this->values,...array_values($columns)];
        return $this;
    }
    
    public function toSQL() {
        $query = "DELETE FROM $this->table";

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }

        $this->query = $query;

        return[
            'query' => $query,
            'values' => $this->values ?? []
        ];
    }

}
?>