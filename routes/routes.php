<?php 
namespace App\Routes;
use App\Controllers\Domicilios\PaisController;
use App\Controllers\Domicilios\EstadoController;
use App\Controllers\Domicilios\MunicipioController;
use App\Controllers\Domicilios\ParroquiaController;
use App\Controllers\Domicilios\CiudadController;
use App\Controllers\Inscripciones\MaestroController;
use App\Controllers\Inscripciones\PersonaController;
use App\Controllers\Inscripciones\ContactoController;
use App\Controllers\Inscripciones\EstudiantesController;
use App\Controllers\Inscripciones\RepresentanteController;
use App\Controllers\Inscripciones\InscripcionController;

$rutas = [

    [
        'method' => 'GET',
        'uri'    => '/paises',
        'action' => [PaisController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/paises',
        'action' => [PaisController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/paises/{id}',
        'action' => [PaisController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/paises/{id}',
        'action' => [PaisController::class, 'destroy']
    ],

    [
        'method' => 'GET',
        'uri'    => '/estados',
        'action' => [EstadoController::class, 'index']
    ],
    [
        'method' => 'GET',
        'uri'    => '/estados/{id}',
        'action' => [EstadoController::class, 'showByIdParent']
    ],
    [
        'method' => 'POST',
        'uri'    => '/estados',
        'action' => [EstadoController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/estados/{id}',
        'action' => [EstadoController::class, 'update']
    ],

    [
        'method' => 'DELETE',
        'uri'    => '/estados/{id}',
        'action' => [EstadoController::class, 'destroy']
    ],

    [
        'method' => 'GET',
        'uri'    => '/municipios',
        'action' => [MunicipioController::class, 'index']
    ],
    [
        'method' => 'GET',
        'uri'    => '/municipios/{id}',
        'action' => [MunicipioController::class, 'showByIdParent']
    ],
    [
        'method' => 'POST',
        'uri'    => '/municipios',
        'action' => [MunicipioController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/municipios/{id}',
        'action' => [MunicipioController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/municipios/{id}',
        'action' => [MunicipioController::class, 'destroy']
    ],


    [
        'method' => 'GET',
        'uri'    => '/parroquias',
        'action' => [ParroquiaController::class, 'index']
    ],
    [
        'method' => 'GET',
        'uri'    => '/parroquias/{id}',
        'action' => [ParroquiaController::class, 'showByIdParent']
    ],
    [
        'method' => 'POST',
        'uri'    => '/parroquias',
        'action' => [ParroquiaController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/parroquias/{id}',
        'action' => [ParroquiaController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/parroquias/{id}',
        'action' => [ParroquiaController::class, 'destroy']
    ],


    [
        'method' => 'GET',
        'uri'    => '/ciudades',
        'action' => [CiudadController::class, 'index']
    ],
    [
        'method' => 'GET',
        'uri'    => '/ciudades/{id}',
        'action' => [CiudadController::class, 'showByIdParent']
    ],
    [
        'method' => 'POST',
        'uri'    => '/ciudades',
        'action' => [CiudadController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/ciudades/{id}',
        'action' => [CiudadController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/ciudades/{id}',
        'action' => [CiudadController::class, 'destroy']
    ],

    [
        'method' => 'GET',
        'uri'    => '/maestros',
        'action' => [MaestroController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/maestros',
        'action' => [MaestroController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/maestros/{id}',
        'action' => [MaestroController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/maestros/{id}',
        'action' => [MaestroController::class, 'destroy']
    ],
    
    [
        'method' => 'GET',
        'uri'    => '/personas',
        'action' => [PersonaController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/personas',
        'action' => [PersonaController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/personas/{id}',
        'action' => [PersonaController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/personas/{id}',
        'action' => [PersonaController::class, 'destroy']
    ],

    [
        'method' => 'GET',
        'uri'    => '/contactos',
        'action' => [ContactoController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/contactos',
        'action' => [ContactoController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/contactos/{id}',
        'action' => [ContactoController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/contactos/{id}',
        'action' => [ContactoController::class, 'destroy']
    ],
    
    [
        'method' => 'GET',
        'uri'    => '/estudiantes',
        'action' => [EstudiantesController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/estudiantes',
        'action' => [EstudiantesController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/estudiantes/{id}',
        'action' => [EstudiantesController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/estudiantes/{id}',
        'action' => [EstudiantesController::class, 'destroy']
    ],


    [
        'method' => 'GET',
        'uri'    => '/representantes',
        'action' => [RepresentanteController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/representantes',
        'action' => [RepresentanteController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/representantes/{id}',
        'action' => [RepresentanteController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/representantes/{id}',
        'action' => [RepresentanteController::class, 'destroy']
    ],

    [
        'method' => 'GET',
        'uri'    => '/inscripciones',
        'action' => [InscripcionController::class, 'index']
    ],
    [
        'method' => 'POST',
        'uri'    => '/inscripciones',
        'action' => [InscripcionController::class, 'store']
    ],
    [
        'method' => 'PUT',
        'uri'    => '/inscripciones/{id}',
        'action' => [InscripcionController::class, 'update']
    ],
    [
        'method' => 'DELETE',
        'uri'    => '/inscripciones/{id}',
        'action' => [InscripcionController::class, 'destroy']
    ],




];

foreach ($rutas as $ruta) {
    API::agregarRuta($ruta['method'], $ruta['uri'], $ruta['action']);
}
                
?>