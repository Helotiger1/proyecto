<?php

namespace App\Models\Inscripciones;

class PersonaModel extends Model {
    protected static $primaryKey = 'idPersona';
    protected static $fk = '';
    protected static $table = 'personas';
    protected static $nestedJoins = ['ciudades' => 'personas.ciudades_idCiudad'];
}

?>