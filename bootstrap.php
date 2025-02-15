<?php 
use App\Routes\API;
use App\Helpers\Container;
require_once __DIR__ . "/vendor/autoload.php";
$container = Container::getInstance();


API::manejarSolicitud();





?>