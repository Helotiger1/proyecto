<?php

namespace App\Models\Inscripciones;

class InscripcionModel extends Model {
    protected static $primaryKey = 'idInscripcion';
    protected static $fk = '';
    protected static $table = 'inscripciones';
    protected static $nestedJoins = ['personas' => 'estudiantes_idEstudiante'];
}


?>