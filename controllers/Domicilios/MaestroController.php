<?php 
namespace App\Controllers\Domicilios;
use App\Models\Domicilios\MaestroModel;


class MaestroController{
    protected static $nombreEntidad = MaestroModel::class;
    public static $instance;
    

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