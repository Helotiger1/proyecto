<?php 
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
        $resource = $resourceMatch[1] ?? null; 

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
?>