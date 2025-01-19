<?php 
namespace App\HTTP;
use App\Controllers\EstadoController;
use App\Controllers\PaisController;
use App\Controllers\MunicipioController;
use App\Controllers\ParroquiaController;
use App\Controllers\CiudadController;



API::agregarRuta('GET', '/paises', [new PaisController(), 'index']);                                    //Regresa todos los paises
API::agregarRuta('POST', '/paises', [new PaisController(), 'store']);                                   // Ingresa un pais, espera un body json con nombrePais y estatus
API::agregarRuta('PUT', '/paises/{id}', [new PaisController(), 'update']);                              // Actualiza un pais, espera un url con id, y un body json con nombrePais y estatus
API::agregarRuta('DELETE', '/paises/{id}', [new PaisController(), 'destroy']);                          // Elimina un pais, con el id en la url basta.



API::agregarRuta('GET', '/estados', [new EstadoController(), 'index']);                                 //Regresa todos los estados
API::agregarRuta('GET', '/paises/{id}/estados', [new EstadoController(), 'showByPais']);                //Regresa los estados de un pais, segun el id del pais en la url
API::agregarRuta('POST', '/estados', [new EstadoController(), 'store']);                                // Ingresa un estado, espera un body json con nombreEstado y codPais  
API::agregarRuta('PUT', '/estados/{id}', [new EstadoController(), 'update']);                           // Actualiza un estado, espera un url con el id, y un body json con nombreEstado y codPais
API::agregarRuta('DELETE', '/estados/{id}', [new EstadoController(), 'destroy']);                       // Elimina un estado, con el id en la url basta.



API::agregarRuta('GET', '/municipios', [new MunicipioController(), 'index']);                           //Regresa todos los municipios
API::agregarRuta('GET', '/estados/{id}/municipios', [new MunicipioController(), 'showByEstado']);       //Regresa los municipios de un estado, segun el id del Estado en la url
API::agregarRuta('POST', '/municipios', [new MunicipioController(), 'store']);                          // Ingresa un municipio, espera un body json con nombreMunicipio y codEstado
API::agregarRuta('PUT', '/municipios/{id}', [new MunicipioController(), 'update']);                     // Actualiza un municipio, espera un url con el id, y un body json con nombreMunicipio y codEstado
API::agregarRuta('DELETE', '/municipios/{id}', [new MunicipioController(), 'destroy']);                 // Elimina un municipio, con el id en la url basta.



API::agregarRuta('GET', '/parroquias', [new ParroquiaController(), 'index']);                           //Regresa todas las parroquias
API::agregarRuta('GET', '/municipios/{id}/parroquias', [new ParroquiaController(), 'showByMunicipio']); //Regresa las parroquias de un municipio, segun el id del municipio en la url
API::agregarRuta('POST', '/municipios/{id}/parroquias', [new ParroquiaController(), 'store']);          // Ingresa una parroquia, espera un body json con nombreParroquia y codMunicipio
API::agregarRuta('PUT', '/parroquias/{id}', [new ParroquiaController(), 'update']);                     // Actualiza una parroquia, espera un url con el id, y un body json con nombreParroquia y codMunicipio
API::agregarRuta('DELETE', '/parroquias/{id}', [new ParroquiaController(), 'destroy']);                 // Elimina una parroquia, con el id en la url basta.



API::agregarRuta('GET', '/ciudades', [new CiudadController(), 'index']);                                //Regresa todas las ciudades
API::agregarRuta('GET', '/parroquias/{id}/ciudades', [new CiudadController(), 'showByParroquia']);      //Regresa las ciudades de una parroquia, segun el id de la parroquia en la url
API::agregarRuta('POST', '/parroquias/{id}/ciudades', [new CiudadController(), 'store']);               // Ingresa una ciudad, espera un body json con nombreCiudad y codParroquia
API::agregarRuta('PUT', '/ciudades/{id}', [new CiudadController(), 'update']);                          // Actualiza una ciudad, espera un url con el id, y un body json con nombreCiudad y codParroquia
API::agregarRuta('DELETE', '/ciudades/{id}', [new CiudadController(), 'destroy']);                      // Elimina una ciudad, con el id en la url basta.

?>