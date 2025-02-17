<?php
namespace App\Controllers\Domicilios;

abstract class ControllerFederal{
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
/*
Estoy cansado de esto, lo voy a hacer a mi manera.
Necesito un flujo tal, que tenga un desplegable con el pais al que pertenece el estado que voy a meter, esto
matara dos pajaros de un tiro, ya que evito insconscistencias y de una vez tengo el id de su predecesor
entonces, con esta lista desplegada y que sea seleccionada, podria evitar todo el procedimiento y solo
verificar que si existan.

Bueno, ya implementando esto necesito que mi BD retorne unicamente todos los paises, y id, al igual con 
estados, pero seria solo en vista de un solo pais, si me entiendes?

y asi proseguiria la cadena hasta llegar al final, luego seria un foreach que revise las columnas.

para introducir solo enviaria el ultimo de la cadena, y su nombre, con ello bastaria.
*/
?>