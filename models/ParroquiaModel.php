<?php
namespace App\Models;

class ParroquiaModel implements \JsonSerializable {
    public $codParroquia, $nombreParroquia, $codMunicipio, $nombreMunicipio, $codEstado, $nombreEstado, $codPais, $nombrePais;

    public function __construct($codParroquia, $nombreParroquia, $codMunicipio, $nombreMunicipio, $codEstado, $nombreEstado, $codPais, $nombrePais) {
        $this->codParroquia = $codParroquia;
        $this->nombreParroquia = $nombreParroquia;
        $this->codMunicipio = $codMunicipio;
        $this->nombreMunicipio = $nombreMunicipio;
        $this->codEstado = $codEstado;
        $this->nombreEstado = $nombreEstado;
        $this->codPais = $codPais;
        $this->nombrePais = $nombrePais;
    }

    public function jsonSerialize(): array {
        return [
            'codParroquia' => $this->codParroquia,
            'nombreParroquia' => $this->nombreParroquia,
            'codMunicipio' => $this->codMunicipio,
            'nombreMunicipio' => $this->nombreMunicipio,
            'codEstado' => $this->codEstado,
            'nombreEstado' => $this->nombreEstado,
            'codPais' => $this->codPais,
            'nombrePais' => $this->nombrePais
        ];
    }
}
?>