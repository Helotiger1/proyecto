<?php

namespace App\Models\Domicilios;

class MunicipioModel extends Model {
    protected static $table = 'municipios';
    protected static $primaryKey = 'codMunicipio';
    protected static $fk = 'estados_codEstado';
    protected static $fillable = ['nombreMunicipio', 'codEstado'];
    protected static $cascadeJoins = ['estados' => 'estados_codEstado', 'paises' => 'paises_codPais'];
    protected static $nameEntity = 'nombreMunicipio';
}

?>