<?php
namespace App\Models;
class MunicipioModel implements \JsonSerializable{
    private $codMunicipio, $nombreMunicipio, $nombreEstado, $nombrePais;

    public function __construct($codMunicipio, $nombreMunicipio, $nombreEstado, $nombrePais){
        $this->codMunicipio = $codMunicipio;
        $this->nombreMunicipio = $nombreMunicipio;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
    }

    public function jsonSerialize(): array {
        return [
            'codMunicipio' => $this->codMunicipio,
            'nombreMunicipio' => $this->nombreMunicipio,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais
        ];
    }
}
?>