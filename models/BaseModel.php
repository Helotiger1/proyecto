<?php 
require_once "../auxiliares/autoloader.php";
Autoloader("core","ManejadorBase");

class BaseModel{
    private $manejadorBase;
    
    public function __construct(){
        $this->manejadorBase = new ManejadorBase();
    }

    public function listar($tabla){
        return $this->manejadorBase->consultarRegistro($tabla);
    }

    public function obtenerPorID($tabla, $id){
        return $this->manejadorBase->consultarRegistro($tabla, "ID", $id);
    }

    public function eliminar($tabla, $id){
        $this->manejadorBase->eliminarRegistro($tabla, $id);
    }

    public function actualizar($tabla, $id, $nuevoRegistro){
        $this->manejadorBase->actualizarRegistro($tabla, $id, $nuevoRegistro);
    }

    public function crear($tabla, $nuevoRegistro){
        $this->manejadorBase->insertarRegistro($tabla, $nuevoRegistro);
    }
}

?>