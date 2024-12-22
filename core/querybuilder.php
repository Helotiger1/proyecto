<?php 
namespace Proyecto\Core;
class QueryBuilder {
    private $table;
    private $select = '*';
    private $where = [];
    private $orderBy = [];
    private $limit = null;
    private $values = [];
    
    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select($columns = '*') {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function where($columns, $operators) {
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

    public function createQuery() {
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

        return[
            'query' => $query,
            'values' => $this->values ?? []
        ];
    }

    public function getQuery($table, $columns = '*', $where = [], $orderBy = '', $limit = '') {
        return $this->table($table)
                    ->select($columns)
                    ->where($where)
                    ->orderBy($orderBy)
                    ->limit($limit)
                    ->crearQuery();
    }

    public function getValues() {
        return $this->values ?? [];
    }
}

























function paresClaveValor($condiciones = [],$registro = []){
    $registroConstruido = "";
    $whereConstruido = "";

    if(!empty($registros)){
        $registroConstruido = ' SET ' . implode(" , ",array_map(fn($col) => "$col = ?", $registro));
    }

    if (!empty($condiciones)){
        $whereConstruido = ' WHERE ' . implode(" AND ",array_map(fn($col) => "$col = ?", $condiciones));
    }

    return ($registroConstruido . $whereConstruido);
}


?>