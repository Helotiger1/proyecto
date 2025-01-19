<?php 
namespace App\Models;
class EstadoModel implements \JsonSerializable{
    private $codEdo, $nombrePais, $nombreEstado;

    public function __construct($codEdo, $nombreEstado, $nombrePais){
        $this->codEdo = $codEdo;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
    }

    public function jsonSerialize(): array {
        return [
            'codEdo' => $this->codEdo,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais
        ];
    }
}



?>