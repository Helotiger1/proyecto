<?php
namespace App\Models\Domicilios;

class ParroquiaModel extends Model {
    protected static $table = 'parroquias';
    protected static $primaryKey = 'codParroquia';
    protected static $fk = 'municipios_codMunicipio';
    protected static $nameEntity = 'nombreParroquia';
    protected static $fillable = ['nombreParroquia', 'codMunicipio'];
    protected static $cascadeJoins = ['municipios' => 'municipios_codMunicipio', 'estados' => 'estados_codEstado', 'paises' => 'paises_codPais'];
}
?>
