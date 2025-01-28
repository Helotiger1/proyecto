<?php 
namespace App\Models;
class EstadoModel implements \JsonSerializable{
    public $codEstado, $nombrePais, $nombreEstado, $codPais;

    public function __construct($codEstado, $nombreEstado, $nombrePais, $codPais){
        $this->codEstado = $codEstado;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
        $this->codPais = $codPais;
    }

    public function jsonSerialize(): array {
        return [
            'codEstado' => $this->codEstado,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais,
            'codPais' => $this->codPais
        ];
    }
}



?>