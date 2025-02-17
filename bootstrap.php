<?php 
use App\Routes\API;
use App\Helpers\Container;
use App\Database\Connection;
use App\ORM\QueryBuilder;

require_once __DIR__ . "/vendor/autoload.php";
$container = Container::getInstance();

$container->bind('Connection', function() { return Connection::connect(); }, true);
$container->bind('QueryBuilder', function() use ($container) { 
    return new QueryBuilder($container->make('Connection')); 
}, true);



API::manejarSolicitud();





?>