<?php

namespace App\Models\Inscripciones;

class RepresentanteModel extends Model {
    protected static $primaryKey = 'idRepresentante';
    protected static $fk = '';
    protected static $table = 'maestros';
    protected static $joins = ['personas' => 'personas_idRepresentante', 'contacto' => 'contacto_idContacto'];
    protected static $nestedJoins = ['ciudades' => 'personas.ciudades_idCiudad'];
}

?>