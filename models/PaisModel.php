<?php 
namespace App\Models;
class PaisModel implements \JsonSerializable{
    public $codPais, $nombrePais, $estatus;

    public function __construct($codPais, $nombrePais, $estatus){
        $this->codPais = $codPais;
        $this->nombrePais = $nombrePais;
        $this->estatus = $estatus;
    }

    public function jsonSerialize(): array {
        return [
            'codPais' => $this->codPais,
            'nombrePais' => $this->nombrePais,
            'estatus' => $this->estatus
        ];
    }
}
