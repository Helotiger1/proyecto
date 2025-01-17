<?php 
namespace App\Models;
class EstadoModel implements \JsonSerializable{
    private $CodEdo, $Descripcion;

    public function __construct($CodEdo, $Descripcion){
        $this->CodEdo = $CodEdo;
        $this->Descripcion = $Descripcion;
    }

    public function jsonSerialize(): array {
        return [
            'codEdo' => $this->CodEdo,
            'Descripcion' => $this->Descripcion
        ];
    }
}



?>