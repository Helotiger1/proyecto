<?php 
use App\Database\QueryBuilders\QueryBuilder;
use App\Database\Connection;
use App\Models;

class EstadoRepo{
    private $db;
    private $queryBuilder;
    public function __construct(){
        $this->db = new Connection();
        $this->queryBuilder = new QueryBuilder();
    }

    public function getAll(){
        $query = queryBuilder::select()
                            ->table('estados')
                            ->columns(['CodEdo', 'Descripcion'])
                            ->toSQL();
       $datosEstados = $this->db->fetchAll($query['query'], $query['values']);

       foreach ($datosEstados as $key => $value) {
           $estados[] = new EstadoModel($value['CodEdo'], $value['Descripcion']);
       }    

       return $estados;
    }


}


?>