<?php

namespace App\Models\Inscripciones;

class EstudianteModel extends Model {
    protected static $primaryKey = 'idEstudiante';
    protected static $fk = '';
    protected static $table = 'estudiantes';
    protected static $joins = ['personas' => 'personas_idPersona', 'contacto' => 'contacto_idContacto'];
}


?>