<?php
namespace App\Models\Domicilios;

class MunicipioModel extends ModelTerritorial {
    protected static $table = 'municipios';
    protected static $primaryKey = 'codMunicipio';
    protected static $fillable = ['nombreMunicipio', 'codEstado'];
    protected static $cascadeJoins = ['estados' => 'codEstado', 'paises' => 'codPais'];
}
?>
