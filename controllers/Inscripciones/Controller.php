<?php
namespace App\Controllers\Inscripciones;

abstract class Controller{
    protected static $nombreEntidad = '';
    public static  $instance;

    public static  function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public static function index() {
        $entidades = static::$nombreEntidad::getAll();

        return $entidades;
    }

    public static function showByIdParent($params){
        $id = $params["id"];
        return static::$nombreEntidad::getByParent($id);
    }

    public static function store($params){
        $body = $params["body"];
        
        $entidad = static::$nombreEntidad::create($body);
        return $entidad;
    }

    public static function update($params){
        $id = $params["id"];

        $body = $params["body"];
       $entidad = static::$nombreEntidad::update($id, $body);
        return $entidad;
    }

    public static function destroy($params){
        $id = $params["id"];

         $entidad = static::$nombreEntidad::deleteByID($id);
          return $entidad;
    }
}
?>