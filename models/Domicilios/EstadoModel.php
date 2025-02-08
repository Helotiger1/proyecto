<?php
namespace App\Models\Domicilios;

class EstadoModel extends ModelTerritorial {
    protected static $table = 'estados';
    protected static $primaryKey = 'codEstado';
    protected static $fillable = ['codEstado', 'nombreEstado', 'codPais'];
}
?>
