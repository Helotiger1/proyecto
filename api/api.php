<?php 
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
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
        foreach (self::$routes as $route) {
            $params = [];
    
            if ($route['method'] === $method && self::encontrarRuta($route['route'], $path, $params)) {
                $data = call_user_func_array($route['callback'], [$params]);
                self::enviarRespuesta(200, $data);
                
            }
        }
        self::enviarRespuesta(404, ['error' => 'Ruta no encontrada']);
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

    /**
     * Envía una respuesta JSON con el código de estado especificado.
     *
     * @param int $statusCode
     * @param array $data
     */
    public static function enviarRespuesta($statusCode, $data) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>