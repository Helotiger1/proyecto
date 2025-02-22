<?php
namespace App\Models\Domicilios;

class CiudadModel extends Model {
    protected static $table = 'ciudades';
    protected static $primaryKey = 'codCiudad';
    protected static $nameEntity = 'nombreCiudad';
    protected static $fk = 'parroquias_codParroquia';
    protected static $fillable = ['nombreCiudad', 'codParroquia'];
    protected static $cascadeJoins = ['parroquias' => 'parroquias_codParroquia', 'municipios' => 'municipios_codMunicipio', 'estados' => 'estados_codEstado', 'paises' => 'paises_codPais'];
}
?>
