<?php 
//TO-DO | Hacer que cargue dinamicamente, segun se pidan los controladores.
require_once "../auxiliares/autoloader.php";
Autoloader("controllers","PaisController");
Autoloader("controllers","EstadoController");
Autoloader("controllers","MunicipiosController");
Autoloader("controllers","ParroquiasController");
Autoloader("controllers","CiudadesController");
Autoloader("controllers","BaseController");


function crearRutasGenericas($api, $entidad) {
    $controllerInstance = new BaseController();
    $api->agregarRuta('GET', "/$entidad", [$controllerInstance, 'index']);
    $api->agregarRuta('GET', "/$entidad/{id}", [$controllerInstance, 'show']);
    $api->agregarRuta('POST', "/$entidad", [$controllerInstance, 'store']);
    $api->agregarRuta('PUT', "/$entidad/{id}", [$controllerInstance, 'update']);
    $api->agregarRuta('DELETE', "/$entidad/{id}", [$controllerInstance, 'destroy']);
}

//Mas alla de ser reutilizable simplemente es un lugar donde almacenarlas ordenadamente.
function crearRutasEspecificas(){
    
}

//TO-DO | Hacer que reciba un array asociativo con los nombres de los recursos y sus respectivos controladores.
class API {
    private $routes = [];

    public function agregarRuta($method, $route, $callback) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'callback' => $callback
        ];
    }

    public function manejarSolicitud() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $table = [];
        //Lo siento dios por la cochinada que hare pero no hay tiempo, despues esto debera organizarse
        //Y hacer que acepte parametros dinamicos, dependiendo de si el modelo es Base, o es uno especifico
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->encontrarRuta($route['route'], $path, $params, $resource)) {
                if ($route['callback'][0] instanceof BaseController){
                    $table = ['tabla' => '$resource'];
                }
                return call_user_func_array($route['callback'], array_merge($table,$params));
            }
        }
        $this->enviarRespuesta(404, ['error' => 'Ruta no encontrada']);
    }

    private function encontrarRuta($routePattern, $path, &$params, &$resource) {

        preg_match('@^/(\w+)@', $routePattern, $resourceMatch);
        $resource = $resourceMatch[1] ?? null; // Obtener el recurso, si existe

        $pattern = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $routePattern);
        $pattern = "@^" . $pattern . "$@";
        
        if (preg_match($pattern, $path, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }

    public function enviarRespuesta($statusCode, $data) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
$api = new API();
crearRutasGenericas($api, 'Paises');
crearRutasGenericas($api, 'Estados');
crearRutasGenericas($api, 'Municipios');
crearRutasGenericas($api, 'Parroquias');
crearRutasGenericas($api, 'Ciudades');
$api->manejarSolicitud();

?>