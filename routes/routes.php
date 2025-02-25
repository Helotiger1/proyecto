<?php 
namespace App\Routes;

use App\Controllers\Domicilios\PaisController;
use App\Controllers\Domicilios\EstadoController;
use App\Controllers\Domicilios\MunicipioController;
use App\Controllers\Domicilios\ParroquiaController;
use App\Controllers\Domicilios\CiudadController;
use App\Controllers\Inscripciones\MaestroController;
use App\Controllers\Inscripciones\EstudianteController;
use App\Controllers\Inscripciones\RepresentanteController;
use App\Controllers\Inscripciones\InscripcionController;
use App\Controllers\Inscripciones\ContactoController;
use App\Controllers\Inscripciones\PersonaController;

$controladores = [
    'paises' => PaisController::class,
    'estados' => EstadoController::class,
    'municipios' => MunicipioController::class,
    'parroquias' => ParroquiaController::class,
    'ciudades' => CiudadController::class,
    'maestros' => MaestroController::class,
    'estudiantes' => EstudianteController::class,
    'representantes' => RepresentanteController::class,
    'inscripciones' => InscripcionController::class,
    'contactos' => ContactoController::class,
    'personas' => PersonaController::class
];

$acciones = [
    ['method' => 'GET', 'uri' => '', 'action' => 'index'],
    ['method' => 'GET', 'uri' => '/{id}', 'action' => 'showByIdParent'],
    ['method' => 'POST', 'uri' => '', 'action' => 'store'],
    ['method' => 'PUT', 'uri' => '/{id}', 'action' => 'update'],
    ['method' => 'DELETE', 'uri' => '/{id}', 'action' => 'destroy']
];

foreach ($controladores as $ruta => $controlador) {
    foreach ($acciones as $accion) {
        API::agregarRuta($accion['method'], "/$ruta" . $accion['uri'], [$controlador, $accion['action']]);
    }
}
?>
