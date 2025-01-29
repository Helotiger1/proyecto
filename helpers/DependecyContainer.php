<?php

class DependencyContainer {
    private $bindings = [];
    private $instances = [];
    private $singletons = [];

    public function register(string $key, callable $resolver, bool $singleton = false): void {
        $this->bindings[$key] = $resolver;
        if ($singleton) {
            $this->singletons[$key] = true;
        } else {
            unset($this->singletons[$key]);
        }
    }

    public function singleton(string $key, callable $resolver): void {
        $this->register($key, $resolver, true);
    }

    public function resolve(string $key) {
        // Retorna la instancia si ya existe
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        // Usa el resolver registrado si existe
        if (isset($this->bindings[$key])) {
            $resolved = $this->bindings[$key]($this);
            
            // Almacena la instancia si es singleton
            if (isset($this->singletons[$key])) {
                $this->instances[$key] = $resolved;
            }
            
            return $resolved;
        }

        // Intenta auto-resolver la dependencia
        return $this->autoResolve($key);
    }

    private function autoResolve(string $class) {
        $reflector = new ReflectionClass($class);
        
        // Verifica si la clase es instanciable
        if (!$reflector->isInstantiable()) {
            throw new Exception("La clase $class no puede ser instanciada");
        }

        // Obtiene el constructor
        $constructor = $reflector->getConstructor();
        
        // Si no hay constructor, crea una instancia directamente
        if ($constructor === null) {
            return new $class();
        }

        // Resuelve los parámetros del constructor
        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            
            // Verifica si el parámetro es una clase
            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->resolve($type->getName());
            } else {
                // Intenta resolver parámetros primitivos con valores por defecto
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("No se puede resolver el parámetro: {$parameter->getName()}");
                }
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}
?>