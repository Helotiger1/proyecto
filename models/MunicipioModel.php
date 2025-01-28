<?php
namespace App\Models;

class MunicipioModel implements \JsonSerializable {
    public $codMunicipio, $nombreMunicipio, $codEstado, $nombreEstado, $codPais, $nombrePais;

    public function __construct($codMunicipio, $nombreMunicipio, $codEstado, $nombreEstado, $codPais, $nombrePais) {
        $this->codMunicipio = $codMunicipio;
        $this->nombreMunicipio = $nombreMunicipio;
        $this->codEstado = $codEstado;
        $this->nombreEstado = $nombreEstado;
        $this->codPais = $codPais;
        $this->nombrePais = $nombrePais;
    }

    public function jsonSerialize(): array {
        return [
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