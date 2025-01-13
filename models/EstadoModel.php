<?php 
class EstadoModel{
    private $CodEdo, $Descripcion;

    public function __construct($CodEdo, $Descripcion){
        $this->CodEdo = $CodEdo;
        $this->Descripcion = $Descripcion;
    }
}



?>