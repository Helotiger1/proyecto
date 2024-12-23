<?php 
class DependencyContainer
{
    private $services = [];

    public function register($name, $service){
        $this->services[$name] = $service;
    }

    public function get($name){
        if (!isset($this->services[$name])) {
            throw new Exception("Service not found: " . $name);
        }
        return $this->resolve($this->services[$name]);
    }

    private function resolve($class){
        $reflection = new ReflectionClass($class);

        if ($constructor = $reflection->getConstructor()) {
            $parameters = $constructor->getParameters();
            $dependencies = [];
            foreach ($parameters as $parameter) {
                $dependency = $parameter->getType();
                if ($dependency) {
                    $dependencyName = $dependency->getName();
                    $dependencies[] = $this->get($dependencyName);
                }
            }
            return $reflection->newInstanceArgs($dependencies);
        }
        return new $class();
    }
}
?>