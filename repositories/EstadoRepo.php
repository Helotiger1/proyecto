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
                            ->columns(['paises.nombrePais', 'estados.codEdo', 'estados.nombreEstado'])
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->toSQL();

       $datosEstados = $this->conn->fetchAll($sql['query'], $sql['params']);
       foreach ($datosEstados as $key => $value) {
           $estados[] = new EstadoModel($value['codEdo'], $value['nombreEstado'], $value['nombrePais']);
       }
           
       return $estados;
    }

    public function getByPais($id){
        $sql = queryBuilder::select()
                            ->table('estados')
                            ->columns(['estados.codEdo', 'estados.nombreEstado','paises.nombrePais'])
                            ->join('paises', 'estados.codPais','=', 'paises.codPais')
                            ->where(["estados.codPais" => (int)$id], ["="])
                            ->toSQL();
        $datosEstados = $this->conn->fetchAll($sql['query'], $sql['params']);
        foreach ($datosEstados as $key => $value) {
            $estados[] = new EstadoModel($value['codEdo'], $value['nombreEstado'], $value['nombrePais']);
        }    
        return $estados;
    }

    public function insert($codPais, $nombreEstado){
        $sql = queryBuilder::insert()
                            ->table('estados')
                            ->columns(['CodPais', 'nombreEstado'])
                            ->values([$codPais, $nombreEstado])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
    }

    public function update($codEdo, $codPais, $nombreEstado){
        $sql = queryBuilder::update()
                            ->table('estados')
                            ->set(['CodPais' => $codPais, 'nombreEstado' => $nombreEstado])
                            ->where(["codEdo" => (int)$codEdo], ["="])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
        return $sql;
    }

    public function delete($codEdo){
        $sql = queryBuilder::delete()
                            ->table('estados')
                            ->where(["codEdo" => (int)$codEdo], ["="])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
    }
}


?>