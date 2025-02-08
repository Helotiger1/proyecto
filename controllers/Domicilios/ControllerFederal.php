<?php
namespace App\Controllers\Domicilios;

abstract class ControllerFederal{
    protected static $nombreEntidad = '';
    public function index() {
        $entidades = static::$nombreEntidad::getAll();
        return $entidades;
    }

    public function show($params){
        $id = intval($params["id"]);
       $entidad = static::$nombreEntidad::getById($id);
        return $entidad;
    }

    public function store($params){
        $body = $params["body"];
        $entidad = static::$nombreEntidad::create($body);
        return $entidad;
    }

    public function update($params){
        $id = intval($params["id"]);
        $body = $params["body"];
       $entidad = static::$nombreEntidad::update($id, $body);
        return $entidad;
    }

    public function destroy($params){
        $id = intval($params["id"]);
         $entidad = static::$nombreEntidad::deleteByID($id);
          return $entidad;
    }
}

?>