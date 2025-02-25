<?php
namespace App\Models\Domicilios;

class ParroquiaModel extends Model {
    protected static $table = 'parroquias';
    protected static $primaryKey = 'idParroquia';
    protected static $fk = 'municipios_idMunicipio';
    protected static $nameEntity = 'nombreParroquia';
    protected static $fillable = ['nombreParroquia', 'idMunicipio'];
    protected static $cascadeJoins = ['municipios' => 'municipios_idMunicipio', 'estados' => 'estados_idEstado', 'paises' => 'paises_idPais'];
}
?>
