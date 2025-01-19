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
                            ->columns(['parroquias.codParroquia', 'parroquias.nombreParroquia', 'municipios.nombreMunicipio', 'estados.nombreEstado', 'paises.nombrePais'])
                            ->join('Municipios', 'parroquias.codMunicipio', '=', 'municipios.codMunicipio')
                            ->join('Estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->toSQL();
       $datosparroquias = $this->conn->fetchAll($sql['query'], $sql['params']);
       foreach ($datosparroquias as $key => $value) {
           $parroquias[] = new ParroquiaModel($value['codParroquia'], $value['nombreParroquia'], $value['nombreMunicipio'], $value['nombreEstado'], $value['nombrePais']);
       }
       return $parroquias;
    }

    public function getByMunicipio($id){
        $sql = queryBuilder::select()
                            ->table('parroquias')
                            ->columns(['parroquias.codParroquia', 'parroquias.nombreParroquia','municipios.nombreMunicipio','estados.nombreEstado', 'paises.nombrePais'])
                            ->join('Municipios', 'parroquias.codMunicipio', '=', 'municipios.codMunicipio')
                            ->join('Estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->where(["parroquias.codMunicipio" => (int)$id], ["="])
                            ->toSQL();

        $datosparroquias = $this->conn->fetchAll($sql['query'], $sql['params']);
        foreach ($datosparroquias as $key => $value) {
            $parroquias[] = new parroquiaModel($value['codParroquia'], $value['nombreParroquia'], $value['nombreMunicipio'], $value['nombreEstado'], $value['nombrePais']);
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
