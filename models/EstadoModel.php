<?php 
namespace App\Models;
class EstadoModel implements \JsonSerializable{
    private $codEstado, $nombrePais, $nombreEstado;

    public function __construct($codEstado, $nombreEstado, $nombrePais){
        $this->codEstado = $codEstado;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
    }

    public function jsonSerialize(): array {
        return [
            'codEstado' => $this->codEstado,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais
        ];
    }
}



?>