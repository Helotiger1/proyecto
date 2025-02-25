<?php
namespace App\Models\Domicilios;

class MunicipioModel extends Model {
    protected static $table = 'municipios';
    protected static $primaryKey = 'idMunicipio';
    protected static $fk = 'estados_idEstado';
    protected static $fillable = ['nombreMunicipio', 'idEstado'];
    protected static $cascadeJoins = ['estados' => 'estados_idEstado', 'paises' => 'paises_idPais'];
    protected static $nameEntity = 'nombreMunicipio';
}
?>
