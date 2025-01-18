<?php 
namespace App\Repositories;
use App\SQL\QueryBuilder;
use App\Database\Connection;
use App\Models\EstadoModel;
require_once __DIR__ . '/../vendor/autoload.php';

class EstadoRepo{
    private $conn;
    public function __construct(){
        $this->conn = new Connection();
    }

    public function getAll(){
        $sql = queryBuilder::select()
                            ->table('estados')
                            ->columns(['CodEdo', 'Descripcion'])
                            ->toSQL();
       $datosEstados = $this->conn->fetchAll($sql['query'], $sql['params']);

       foreach ($datosEstados as $key => $value) {
           $estados[] = new EstadoModel($value['CodEdo'], $value['Descripcion']);
       }    

       return $estados;
    }

    public function getOne($id){
        $sql = queryBuilder::select()
                            ->table('estados')
                            ->columns(['CodEdo', 'Descripcion'])
                            ->where(["CodEdo" => (int)$id], ["="])
                            ->toSQL();
        $datosEstados = $this->conn->fetchOne($sql['query'], $sql['params']);
        return new EstadoModel($datosEstados['CodEdo'], $datosEstados['Descripcion']);
    }

    public function insert($codPais, $descripcion){
        $sql = queryBuilder::insert()
                            ->table('estados')
                            ->columns(['CodPais', 'Descripcion'])
                            ->values([$codPais, $descripcion])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);

    }

    public function update($id, $codPais, $descripcion){
        $sql = queryBuilder::update()
                            ->table('estados')
                            ->set(['CodPais' => $codPais, 'Descripcion' => $descripcion])
                            ->where(["CodEdo" => (int)$id], ["="])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
        return $sql;
    }
}


?>