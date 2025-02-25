<?php

namespace App\Models\Inscripciones;

class MaestroModel extends Model {
    protected static $primaryKey = 'idMaestro';
    protected static $fk = '';
    protected static $table = 'maestros';
    protected static $joins = ['personas' => 'personas_idPersona', 'contacto' => 'contacto_idContacto'];
    protected static $nestedJoins = ['ciudades' => 'personas.ciudades_idCiudad'];
}

?>