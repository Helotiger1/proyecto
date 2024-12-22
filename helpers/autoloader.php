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

// Registrar el autoloader
spl_autoload_register(function ($class) {
    // Definir las carpetas base para diferentes espacios de nombres
    $direccion = __DIR__;
    $baseDirs = [
        'BaseController' => __DIR__ . '/src/Controllers/',
        'App\\Models'      => __DIR__ . '/src/Models/',
        'App\\Services'    => __DIR__ . '/src/Services/'
    ];

    // Iterar sobre las rutas base y tratar de cargar la clase
    foreach ($baseDirs as $namespace => $dir) {
        // Si la clase pertenece al espacio de nombres, intenta cargarla
        if (strpos($class, $namespace) === 0) {
            // Elimina el prefijo del espacio de nombres para obtener la ruta de la clase
            $relativeClass = str_replace($namespace . '\\', '', $class);
            $file = $dir . str_replace('\\', '/', $relativeClass) . '.php';
            
            // Si el archivo existe, inclúyelo
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }

    // Si la clase no se encuentra, puedes manejar el error de alguna manera.
    throw new Exception("Class $class not found.");
});
?>



?>