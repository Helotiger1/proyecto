<?php 

namespace App\Repositories;
use App\SQL\QueryBuilder;
use App\Database\Connection;
use App\Models\ParroquiaModel;

class ParroquiaRepo{
    private $conn;

    public function __construct(){
        $this->conn = new Connection();
    }

    public function getAll(){
        $sql = queryBuilder::select()
                            ->table('parroquias')
                            ->columns(['parroquias.codParroquia', 'parroquias.nombreParroquia', 'municipios.nombreMunicipio', 'municipios.codMunicipio', 'estados.nombreEstado','estados.codEstado', 'paises.nombrePais','paises.codPais'])
                            ->join('Municipios', 'parroquias.codMunicipio', '=', 'municipios.codMunicipio')
                            ->join('Estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->toSQL();
       $datosparroquias = $this->conn->fetchAll($sql['query'], $sql['params']);
       foreach ($datosparroquias as $key => $value) {
           $parroquias[] = new ParroquiaModel($value['codParroquia'], $value['nombreParroquia'], $value['codMunicipio'], $value['nombreMunicipio'], $value['codEstado'], $value['nombreEstado'],$value['codPais'], $value['nombrePais']);
       }
       return $parroquias;
    }

   

    public function insert($codMunicipio, $nombreParroquia){
        $sql = queryBuilder::insert()
                            ->table('parroquias')
                            ->columns(['codMunicipio', 'nombreParroquia'])
                            ->values([$codMunicipio, $nombreParroquia])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }

    public function update($codParroquia, $codMunicipio,  $nombreParroquia){
        $sql = queryBuilder::update()
                            ->table('parroquias')
                            ->set(['codMunicipio' => $codMunicipio, 'nombreParroquia' => $nombreParroquia])
                            ->where(["codParroquia" => (int)$codParroquia], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
        return $sql;
    }

    public function delete($codParroquia){
        $sql = queryBuilder::delete()
                            ->table('parroquias')
                            ->where(["codParroquia" => (int)$codParroquia], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }
}
