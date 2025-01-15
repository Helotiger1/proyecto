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
}

$nose = new EstadoRepo();
$data = $nose->getAll();
print_r($data);


?>