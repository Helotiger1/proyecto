<?php
namespace App\Models\Domicilios;

class EstadoModel extends ModelTerritorial {
    protected static $table = 'estados';
    protected static $primaryKey = 'codEstado';
    protected static $fk = 'paises_codPais';
    protected static $nameEntity = 'nombreEstado';
    protected static $fillable = ['codEstado', 'nombreEstado', 'codPais'];
    protected static $cascadeJoins = ['paises' => 'paises_codPais'];
}
?>
