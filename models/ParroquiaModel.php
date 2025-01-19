<?php
namespace App\Models;
class ParroquiaModel implements \JsonSerializable{
    private $codParroquia, $nombreParroquia, $nombreMunicipio, $nombreEstado, $nombrePais;

    public function __construct($codParroquia, $nombreParroquia, $nombreMunicipio, $nombreEstado, $nombrePais){
        $this->codParroquia = $codParroquia;
        $this->nombreParroquia = $nombreParroquia;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
        $this->nombreMunicipio = $nombreMunicipio;
    }

    public function jsonSerialize(): array {
        return [
            'codParroquia' => $this->codParroquia,
            'nombreParroquia' => $this->nombreParroquia,
            'nombreMunicipio' => $this->nombreMunicipio,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais
        ];
    }
}
?>