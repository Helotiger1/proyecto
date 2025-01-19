<?php 

namespace App\Repositories;
use App\SQL\QueryBuilder;
use App\Database\Connection;
use App\Models\CiudadModel;

class CiudadRepo{
    private $conn;

    public function __construct(){
        $this->conn = new Connection();
    }

    public function getAll(){
        $sql = queryBuilder::select()
                            ->table('ciudades')
                            ->columns(['ciudades.codCiudad', 'ciudades.nombreCiudad', 'parroquias.nombreParroquia', 'municipios.nombreMunicipio', 'estados.nombreEstado', 'paises.nombrePais'])
                            ->join('Parroquias', 'ciudades.codParroquia', '=', 'Parroquias.codParroquia')
                            ->join('Municipios', 'Parroquias.codMunicipio', '=', 'municipios.codMunicipio')
                            ->join('Estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->toSQL();
       $datosciudades = $this->conn->fetchAll($sql['query'], $sql['params']);
       foreach ($datosciudades as $key => $value) {
           $ciudades[] = new CiudadModel($value['codCiudad'], $value['nombreCiudad'], $value['nombreParroquia'], $value['nombreMunicipio'], $value['nombreEstado'], $value['nombrePais']);
       }
       return $ciudades;
    }

    public function getByParroquia($id){
        $sql = queryBuilder::select()
                            ->table('ciudades')
                            ->columns(['ciudades.codCiudad', 'ciudades.nombreCiudad', 'parroquias.nombreParroquia', 'municipios.nombreMunicipio', 'estados.nombreEstado', 'paises.nombrePais'])
                            ->join('Parroquias', 'ciudades.codParroquia', '=', 'Parroquias.codParroquia')
                            ->join('Municipios', 'Parroquias.codMunicipio', '=', 'municipios.codMunicipio')
                            ->join('Estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->where(["parroquias.codParroquia" => (int)$id], ["="])
                            ->toSQL();

        $datosciudades = $this->conn->fetchAll($sql['query'], $sql['params']);
        foreach ($datosciudades as $key => $value) {
            $ciudades[] = new CiudadModel($value['codCiudad'], $value['nombreCiudad'], $value['nombreParroquia'], $value['nombreMunicipio'], $value['nombreEstado'], $value['nombrePais']);
        }    
        return $ciudades;
    }

    public function insert($codParroquia, $nombreCiudad){
        $sql = queryBuilder::insert()
                            ->table('ciudades')
                            ->columns(['codParroquia', 'nombreCiudad'])
                            ->values([$codParroquia, $nombreCiudad])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }

    public function update($codCiudad, $codParroquia,  $nombreCiudad){
        $sql = queryBuilder::update()
                            ->table('ciudades')
                            ->set(['codParroquia' => $codParroquia, 'nombreCiudad' => $nombreCiudad])
                            ->where(["codCiudad" => (int)$codCiudad], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
        return $sql;
    }

    public function delete($codCiudad){
        $sql = queryBuilder::delete()
                            ->table('ciudades')
                            ->where(["codCiudad" => (int)$codCiudad], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }
}

?>