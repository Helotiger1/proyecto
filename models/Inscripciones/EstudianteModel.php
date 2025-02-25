<?php

namespace App\Models\Inscripciones;

class EstudianteModel extends Model {
    protected static $primaryKey = 'idEstudiante';
    protected static $fk = '';
    protected static $table = 'estudiantes';
    protected static $joins = ['personas' => 'personas_idPersona', 'contacto' => 'contacto_idContacto'];
    protected static $nestedJoins = ['ciudades' => 'personas.ciudades_idCiudad'];
    protected static $subquerie = '(SELECT personas.nombrePersona
                                FROM personas 
                                WHERE personas.idPersona = (
                                    SELECT representantes.personas_idPersona 
                                    FROM representantes 
                                    WHERE estudiantes.representantes_idRepresentante = representantes.idRepresentante
                                )) as nombreRepresentante';
}


?>