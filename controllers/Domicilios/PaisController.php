<?php 
namespace App\Controllers\Domicilios;
use App\Models\Domicilios\PaisModel;

class PaisController {
    public static $nombreEntidad = PaisModel::class;

    public function index() {
        $entidades = static::$nombreEntidad::getAll();
        return $entidades;
    }

    public function show($params){
        $id = $params["id"];
       $entidad = static::$nombreEntidad::getById($id);
        return $entidad;
    }

    public function store($params){
        $body = $params["body"];
       $entidad = static::$nombreEntidad::create($body);
        return $entidad;
    }

    public function update($params){
        $id = $params["id"];
        $body = $params["body"];
       $entidad = static::$nombreEntidad::update($id, $body);
        return $entidad;
    }

    public function destroy($params){
        $id = $params["id"];
         $entidad = static::$nombreEntidad::deleteByID($id);
          return $entidad;
    }
}

?>