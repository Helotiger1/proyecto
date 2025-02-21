<?php
namespace App\Models\Domicilios;

class ParroquiaModel extends ModelTerritorial {
    protected static $table = 'parroquias';
    protected static $primaryKey = 'codParroquia';
    protected static $fk = 'codMunicipio';
    protected static $nameEntity = 'nombreParroquia';
    protected static $fillable = ['nombreParroquia', 'codMunicipio'];
    protected static $cascadeJoins = ['municipios' => 'codMunicipio', 'estados' => 'codEstado', 'paises' => 'codPais'];
}
?>
