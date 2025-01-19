<?php
namespace App\Repositories;
use App\SQL\QueryBuilder;
use App\Database\Connection;
use App\Models\PaisModel;
require_once __DIR__ . '/../vendor/autoload.php';

class PaisRepo{
    private $conn;
    public function __construct(){
        $this->conn = new Connection();
    }

    public function getAll(){
        $sql = queryBuilder::select()
                            ->table('paises')
                            ->columns(['codPais', 'nombrePais','estatus'])
                            ->toSQL();
       $datosPaises = $this->conn->fetchAll($sql['query'], $sql['params']);

       foreach ($datosPaises as $key => $value) {
           $paises[] = new PaisModel($value['codPais'], $value['nombrePais'], $value['estatus']);
       }    

       return $paises;
    }

    public function insert($nombrePais, $estatus){
        $sql = queryBuilder::insert()
                            ->table('paises')
                            ->columns(['nombrePais', 'estatus'])
                            ->values([$nombrePais, $estatus])
                            ->toSQL();
        $this->conn->execute($sql['query'], $sql['params']);
    }

    public function update($codPais, $nombrePais, $estatus){
        $sql = queryBuilder::update()
                            ->table('Paises')
                            ->set(['nombrePais' => $nombrePais, 'estatus' => $estatus])
                            ->where(["CodPais" => (int)$codPais], ["="])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
    }

    public function delete($codPais){
        $sql = queryBuilder::delete()
                            ->table('Paises')
                            ->where(["CodPais" => (int)$codPais], ["="])
                            ->toSQL();
        $this->conn->execute($sql['query'],$sql['params']);
    }
}


?>