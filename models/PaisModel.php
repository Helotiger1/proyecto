<?php 
namespace App\Models;
class PaisModel implements \JsonSerializable{
    private $codPais, $descripcion, $estatus;

    public function __construct($codPais, $descripcion, $estatus){
        $this->codPais = $codPais;
        $this->descripcion = $descripcion;
        $this->estatus = $estatus;
    }

    public function jsonSerialize(): array {
        return [
            'codPais' => $this->codPais,
            'nombrePais' => $this->descripcion,
            'estatus' => $this->estatus
        ];
    }
}
