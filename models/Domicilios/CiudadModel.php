<?php
namespace App\Models\Domicilios;

class CiudadModel extends Model {
    protected static $table = 'ciudades';
    protected static $primaryKey = 'idCiudad';
    protected static $nameEntity = 'nombreCiudad';
    protected static $fk = 'parroquias_idParroquia';
    protected static $fillable = ['nombreCiudad', 'idParroquia'];
    protected static $cascadeJoins = ['parroquias' => 'parroquias_idParroquia', 'municipios' => 'municipios_idMunicipio', 'estados' => 'estados_idEstado', 'paises' => 'paises_idPais'];
}
?>
