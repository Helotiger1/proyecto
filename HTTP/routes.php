<?php 
namespace App\HTTP;
use App\Controllers\EstadoController;

//Endpoints para Paises

//Endpoints para Estados
API::agregarRuta('GET', '/estados', [new EstadoController(), 'index']);
API::agregarRuta('GET', '/estados/{id}', [new EstadoController(), 'show']);
API::agregarRuta('POST', '/estados', [new EstadoController(), 'store']);
API::agregarRuta('PUT', '/estados/{id}', [new EstadoController(), 'update']);
API::agregarRuta('DELETE', '/estados/{id}', [new EstadoController(), 'destroy']);

//Endpoints para Municipios

//Endpoints para Parroquias

//Endpoints para Ciudades

?>