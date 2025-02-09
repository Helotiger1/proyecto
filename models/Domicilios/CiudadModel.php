<?php
namespace App\Models\Domicilios;

class CiudadModel extends ModelTerritorial {
    protected static $table = 'ciudades';
    protected static $primaryKey = 'codCiudad';
    protected static $fillable = ['nombreCiudad', 'codParroquia'];
    protected static $cascadeJoins = ['parroquias' => 'codParroquia', 'municipios' => 'codMunicipio', 'estados' => 'codEstado', 'paises' => 'codPais'];
}
?>
