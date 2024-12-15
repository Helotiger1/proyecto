<?php 
function Autoloader($nombreCarpeta="",$nombreDependencia="") {
    $direccion = __DIR__;
    $ruta = "{$direccion}/../{$nombreCarpeta}/{$nombreDependencia}.php";
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        echo "El modulo $nombreDependencia no se pudo encontrar.";
    }
}
?>