<?php 
use App\Routes\API;
use App\Helpers\Container;
require_once __DIR__ . "/vendor/autoload.php";
API::manejarSolicitud();
$container = new Container();

$app = new App($container);


?>