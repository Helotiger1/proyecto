<?php
namespace App\Models\Domicilios;

class EstadoModel extends Model {
    protected static $table = 'estados';
    protected static $primaryKey = 'idEstado';
    protected static $fk = 'paises_idPais';
    protected static $nameEntity = 'nombreEstado';
    protected static $fillable = ['idEstado', 'nombreEstado', 'idPais'];
    protected static $cascadeJoins = ['paises' => 'paises_idPais'];
}
?>
