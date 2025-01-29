<?php

class Container
{
    protected $services = [];
    protected $instances = [];

    public function set(string $name, Closure $closure): void
    {
        $this->services[$name] = $closure;
    }

    public function get(string $name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        if (isset($this->services[$name])) {
            $this->instances[$name] = $this->services[$name]($this);
            return $this->instances[$name];
        }

        throw new Exception("El servicio $name no está registrado en el contenedor");
    }

    public function has(string $name): bool
    {
        return isset($this->services[$name]);
    }
}

