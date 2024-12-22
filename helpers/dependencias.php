<?php 
class DependencyContainer
{
    private $services = [];

    // Registrar un servicio en el contenedor
    public function register($name, $service)
    {
        $this->services[$name] = $service;
    }

    // Obtener un servicio del contenedor
    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new Exception("Service not found: " . $name);
        }

        // Resolver la dependencia automáticamente si es un objeto
        return $this->resolve($this->services[$name]);
    }

    // Resolver la dependencia utilizando reflexión
    private function resolve($class)
    {
        $reflection = new ReflectionClass($class);

        // Verificar si la clase tiene un constructor
        if ($constructor = $reflection->getConstructor()) {
            $parameters = $constructor->getParameters();
            $dependencies = [];

            // Resolver todas las dependencias del constructor
            foreach ($parameters as $parameter) {
                $dependency = $parameter->getType();
                if ($dependency) {
                    $dependencyName = $dependency->getName();
                    $dependencies[] = $this->get($dependencyName);
                }
            }

            // Crear la instancia con las dependencias resueltas
            return $reflection->newInstanceArgs($dependencies);
        }

        return new $class();
    }
}
?>