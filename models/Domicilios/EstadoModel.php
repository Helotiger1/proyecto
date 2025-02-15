<?php
namespace App\Models\Domicilios;

class EstadoModel extends ModelTerritorial {
    protected static $table = 'estados';
    protected static $primaryKey = 'codEstado';
    protected static $fk = 'codPais';
    protected static $fillable = ['codEstado', 'nombreEstado', 'codPais'];
    protected static $cascadeJoins = ['paises' => 'codPais'];
}
?>
