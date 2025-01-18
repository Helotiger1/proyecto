<?php 
namespace App\HTTP;
use App\Controllers\EstadoController;
use App\Controllers\PaisController;
use App\Controllers\MunicipioController;
use App\Controllers\ParroquiaController;
use App\Controllers\CiudadController;

//Endpoints para Paises
API::agregarRuta('GET', '/paises', [new PaisController(), 'index']);
API::agregarRuta('POST', '/paises', [new PaisController(), 'store']);
API::agregarRuta('PUT', '/paises/{id}', [new PaisController(), 'update']);
API::agregarRuta('DELETE', '/paises/{id}', [new PaisController(), 'destroy']);

//Endpoints para Estados
API::agregarRuta('GET', '/estados', [new EstadoController(), 'index']);
API::agregarRuta('GET', '/paises/{id}/estados', [new EstadoController(), 'showByPais']);
API::agregarRuta('POST', '/estados', [new EstadoController(), 'store']);
API::agregarRuta('PUT', '/estados/{id}', [new EstadoController(), 'update']);
api::agregarRuta('DELETE', '/estados/{id}', [new EstadoController(), 'destroy']);

//Endpoints para Municipios
API::agregarRuta('GET', '/municipios', [new MunicipioController(), 'index']);
API::agregarRuta('GET', '/estados/{id}/municipios', [new MunicipioController(), 'showByEstado']);
API::agregarRuta('POST', '/municipios', [new MunicipioController(), 'store']);
API::agregarRuta('PUT', '/municipios/{id}', [new MunicipioController(), 'update']);
API::agregarRuta('DELETE', '/municipios/{id}', [new MunicipioController(), 'destroy']);


//Endpoints para Parroquias
API::agregarRuta('GET', '/parroquias', [new ParroquiaController(), 'index']);
API::agregarRuta('GET', '/municipios/{id}/parroquias', [new ParroquiaController(), 'showByMunicipio']);
API::agregarRuta('POST', '/municipios/{id}/parroquias', [new ParroquiaController(), 'store']);
API::agregarRuta('PUT', '/parroquias/{id}', [new ParroquiaController(), 'update']);
API::agregarRuta('DELETE', '/parroquias/{id}', [new ParroquiaController(), 'destroy']);

//Endpoints para Ciudades
API::agregarRuta('GET', '/ciudades', [new CiudadController(), 'index']);
API::agregarRuta('GET', '/parroquias/{id}/ciudades', [new CiudadController(), 'showByParroquia']);
API::agregarRuta('POST', '/parroquias/{id}/ciudades', [new CiudadController(), 'store']);
API::agregarRuta('PUT', '/ciudades/{id}', [new CiudadController(), 'update']);
API::agregarRuta('DELETE', '/ciudades/{id}', [new CiudadController(), 'destroy']);

?>