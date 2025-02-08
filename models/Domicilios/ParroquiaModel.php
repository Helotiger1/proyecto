<?php
namespace App\Models\Domicilios;

class ParroquiaModel extends ModelTerritorial {
    protected static $table = 'parroquias';
    protected static $primaryKey = 'codParroquia';
    protected static $fillable = ['nombreParroquia', 'codMunicipio'];
}
?>
