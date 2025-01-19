<?php
namespace App\Models;
class CiudadModel implements \JsonSerializable{
    private $codCiudad, $nombreCiudad, $nombreParroquia, $nombreMunicipio, $nombreEstado, $nombrePais;

    public function __construct($codCiudad, $nombreCiudad, $nombreParroquia, $nombreMunicipio, $nombreEstado, $nombrePais){
        $this->codCiudad = $codCiudad;
        $this->nombreCiudad = $nombreCiudad;
        $this->nombreParroquia = $nombreParroquia;
        $this->nombreEstado = $nombreEstado;
        $this->nombrePais = $nombrePais;
        $this->nombreMunicipio = $nombreMunicipio;
    }

    public function jsonSerialize(): array {
        return [
            'codCiudad' => $this->codCiudad,
            'nombreCiudad' => $this->nombreCiudad,
            'nombreParroquia' => $this->nombreParroquia,
            'nombreMunicipio' => $this->nombreMunicipio,
            'nombreEstado' => $this->nombreEstado,
            'nombrePais' => $this->nombrePais
        ];
    }
}
?>