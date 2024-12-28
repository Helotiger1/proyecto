<?php 
namespace App\Database\QueryBuilders;
class SelectBuilder 
{
    private $table = "";
    private $select = '*';
    private $where = [];
    private $orderBy = [];
    private $limit = null;
    private $values = [];
    private $joins = [];
    
    public function table(string $table): self {
        $this->table = $table;
        return $this;
    }

    public function columns(array $columns = ['*']): self {
        $this->select = implode(', ', $columns);
        return $this;
    }
    public function join(string $table, string $first, string $operator, string $second, string $type = 'INNER'): self {
        $this->joins[] = " $type JOIN $table ON $first $operator $second";
        return $this;
    }
    
    public function where(array $columns, array $operators): self {
        $this->where = array_map(fn($col, $op) => "$col $op ?", array_keys($columns), $operators);
        $this->values = [...$this->values,...array_values($columns)];
        return $this;
    }
    
    public function orderBy(array $columns, array $directions = []): self {
        $this->orderBy[] = array_map(fn($col, $dir) => "$col $dir", $columns, $directions);
        return $this;
    }
    
    public function limit($limit): self {
        $this->limit = $limit;
        return $this;
    }
    
    public function toSQL(): array {
        $query = "SELECT $this->select FROM $this->table";
        
        if (!empty($this->joins)) {
            $query .=  implode("\n", $this->joins);
        }
        
        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }
        
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . implode(', ', $this->orderBy);
        }
    
        if (!empty($this->limit)) {
            $query .= " LIMIT $this->limit";
        }
        
        
        return[
            'query' => $query,
            'values' => $this->values ?? []
        ];
    }
}
?>