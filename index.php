<?php 
use App\HTTP\API;
use App\Controllers\EstadoController;
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/HTTP/routes.php";

API::manejarSolicitud();
?>