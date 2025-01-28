<?php 
namespace App\Repositories;
use App\SQL\QueryBuilder;
use App\Database\Connection;
use App\Models\MunicipioModel;
class MunicipioRepo{
    private $conn;
    public function __construct(){
        $this->conn = new Connection();
    }

    public function getAll(){
        $sql = queryBuilder::select()
                            ->table('municipios')
                            ->columns(['municipios.codMunicipio', 'municipios.nombreMunicipio','estados.nombreEstado','estados.codEstado', 'paises.nombrePais','paises.codPais'])
                            ->join('estados', 'municipios.codEstado', '=', 'estados.codEstado')
                            ->join('paises', 'estados.codPais', '=', 'paises.codPais')
                            ->toSQL();

       $datosMunicipios = $this->conn->fetchAll($sql['query'], $sql['params']);
       foreach ($datosMunicipios as $key => $value) {
           $Municipios[] = new MunicipioModel($value['codMunicipio'], $value['nombreMunicipio'], $value['codEstado'], $value['nombreEstado'], $value['codPais'], $value['nombrePais']);
       }
           
       return $Municipios;
    }


    public function insert($codEstado, $nombreMunicipio){
        $sql = queryBuilder::insert()
                            ->table('municipios')
                            ->columns(['codEstado', 'nombreMunicipio'])
                            ->values([$codEstado, $nombreMunicipio])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }

    public function update($codMunicipio, $codEstado,  $nombreMunicipio){
        $sql = queryBuilder::update()
                            ->table('municipios')
                            ->set(['codEstado' => $codEstado, 'nombreMunicipio' => $nombreMunicipio])
                            ->where(["codMunicipio" => (int)$codMunicipio], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
        return $sql;
    }

    public function delete($codMunicipio){
        $sql = queryBuilder::delete()
                            ->table('municipios')
                            ->where(["codMunicipio" => (int)$codMunicipio], ["="])
                            ->toSQL();

        $this->conn->execute($sql['query'],$sql['params']);
    }
}


?>