<?php 
namespace Proyecto\Core;
class QueryBuilder {
    private $table;
    private $select = '*';
    private $where = [];
    private $orderBy = [];
    private $limit = null;
    private $values = [];
    
    public function table(string $table): QueryBuilder {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): QueryBuilder {
        $this->select = implode(', ', $columns);
        return $this;
    }

    public function where(array $columns, array $operators): QueryBuilder {
        $this->where = array_map(fn($col, $op) => "$col $op ?",array_keys($columns), $operators);
        $this->values = [...$this->values,...array_values($columns)];
        return $this;
    }

    public function orderBy(string $columns, string $directions = 'ASC') {
        $this->orderBy[] = array_map(fn($col, $dir) => "$col $dir ",$columns, $directions);
        return $this;
    }

    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function join(string $table, string $first, string $operator, string $second, string $type = 'INNER'): self
    {
        $this->joins[] = "$type JOIN $table ON $first $operator $second";
        return $this;
    }

    public function delete(){

    }

    public function update(){

    }

    public function create(){
        
    }

    public function get() {
        $query = "SELECT $this->select FROM $this->table";
        
        if (!empty($this->where)) {
            $query .= " WHERE " . (is_array($this->where) ? implode(' AND ', $this->where) : $this->where);
        }
        
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . implode(', ', $this->orderBy);
        }

        if ($this->limit) {
            $query .= " LIMIT $this->limit";
        }

        return[
            'query' => $query,
            'values' => $this->values ?? []
        ];
    }
}

$aux = new QueryBuilder();
$query = $aux->table("Usuarios")
            ->select("Nombre")
            ->where(["ID" => 5],["="])
            ->createQuery();
print_r($query);





?>