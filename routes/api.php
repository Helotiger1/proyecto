<?php 
namespace App\Routes;
require_once __DIR__ . '/../vendor/autoload.php';

class API {
    private static $routes = [];

    /**
     * Agrega una ruta de controlador.
     *
     * @param string $method
     * @param string $route
     * @param callable $callback
     */
    public static function agregarRuta($method, $route, $callback) {
        self::$routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'callback' => $callback
        ];
    }

    /**
     * Maneja la solicitud HTTP entrante.
     */
    public static function manejarSolicitud() {
        $method = $_SERVER['REQUEST_METHOD'];
        $baseUrl = str_replace('/proyecto', '', $_SERVER['REQUEST_URI']);
        $path = parse_url($baseUrl, PHP_URL_PATH);
        $body = self::leerBody();

        foreach (self::$routes as $route) {
            $params = [];
            if ($route['method'] === $method && self::encontrarRuta($route['route'], $path, $params)) {
                $params["body"] = $body;
                $data = call_user_func_array($route['callback'], [$params]);
                return self::enviarRespuesta(200, $data);
            }
        }
        return self::enviarRespuesta(404, ['error' => 'Ruta no encontrada']);
    }
    
    /**
     * Encuentra una coincidencia entre la ruta registrada y la solicitada.
     *
     * @param string $routePattern
     * @param string $path
     * @param array &$params
     * @return bool
     */
    private static function encontrarRuta($routePattern, $path, &$params) {
        // Crear un patrón para las rutas dinámicas.
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $routePattern);
        $pattern = "@^" . $pattern . "$@";
        
        if (preg_match($pattern, $path, $matches)) {
            // Extraer solo los parámetros nombrados.
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }
    
        return false;
    }

    public static function leerBody(){
        $body = [];
        $request = $_SERVER['REQUEST_METHOD'];
        $methods = ['POST', 'PUT', 'PATCH'];


        if (in_array($request, $methods)) {
            $rawData = file_get_contents("php://input");
            $body = json_decode($rawData, true);
        }
        return $body;
    }

    /**
     * Envía una respuesta JSON con el código de estado especificado.
     *
     * @param int $statusCode
     * @param array $data
     */
    public static function enviarRespuesta($statusCode, $data) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(["data" => $data]); // Wrap data in an object
    }
}
require_once "routes.php";
?>