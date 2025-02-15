<?php
namespace App\Helpers;
use Exception;
use ReflectionClass;
class Container
{
    protected $bindings = [];
    protected $instances = [];
    protected static $instance;

    /**
     * Registra un binding en el contenedor.
     *
     * @param string   $abstract  Identificador de la dependencia.
     * @param callable $concrete  Función que crea la instancia.
     * @param bool     $singleton Indica si se debe almacenar la instancia para uso único.
     */


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bind(string $abstract, callable $concrete, bool $singleton = false)
    {
        $this->bindings[$abstract] = [
            'concrete'  => $concrete,
            'singleton' => $singleton,
        ];
    }

    /**
     * Registra un binding como singleton. Es decir, se crea una única instancia.
     *
     * @param string   $abstract Identificador de la dependencia.
     * @param callable $concrete Función que crea la instancia.
     */
    public function singleton(string $abstract, callable $concrete)
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * Registra una instancia ya creada en el contenedor.
     *
     * @param string $abstract Identificador de la dependencia.
     * @param mixed  $instance La instancia ya creada.
     */
    public function instance(string $abstract, $instance)
    {
        $this->instances[$abstract] = $instance;
    }

    /**
     * Obtiene (o crea) la instancia correspondiente al identificador proporcionado.
     * Si no existe binding y la clase existe, se intentará el autowiring.
     *
     * @param string $abstract   Identificador de la dependencia o nombre de la clase.
     * @param array  $parameters Parámetros opcionales para la creación.
     * @return mixed
     * @throws Exception Si no se puede resolver la dependencia.
     */
    public function make(string $abstract, array $parameters = [])
    {
        // Si ya se tiene una instancia, se retorna
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        // Si se definió un binding, se utiliza para crear la instancia
        if (isset($this->bindings[$abstract])) {
            $binding = $this->bindings[$abstract];
            $object = call_user_func_array($binding['concrete'], $parameters);
            
            // Si es singleton, se guarda la instancia
            if ($binding['singleton']) {
                $this->instances[$abstract] = $object;
            }
            return $object;
        }

        // Si no hay binding, intentamos hacer autowiring siempre que la clase exista
        if (class_exists($abstract)) {
            return $this->build($abstract, $parameters);
        }

        throw new Exception("No se ha definido un binding para '{$abstract}' y no es posible autowiring.");
    }

    /**
     * Crea una instancia de la clase usando Reflection para resolver sus dependencias.
     *
     * @param string $concrete   Nombre completo de la clase.
     * @param array  $parameters Parámetros opcionales.
     * @return mixed
     * @throws Exception Si la clase no es instanciable o no se pueden resolver algunas dependencias.
     */
    protected function build(string $concrete, array $parameters = [])
    {
        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("La clase {$concrete} no es instanciable.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            // No hay constructor, se crea la instancia sin parámetros
            return new $concrete;
        }

        // Se obtienen los parámetros del constructor
        $dependencies = $constructor->getParameters();
        $instances = [];

        foreach ($dependencies as $dependency) {
            // Si se pasa un valor explícito en $parameters (por nombre)
            if (isset($parameters[$dependency->getName()])) {
                $instances[] = $parameters[$dependency->getName()];
                continue;
            }

            // Obtener el tipo de la dependencia
            $type = $dependency->getType();

            // Si el parámetro no tiene un tipo (o es un tipo primitivo), se verifica si tiene valor por defecto
            if (!$type || $type->isBuiltin()) {
                if ($dependency->isDefaultValueAvailable()) {
                    $instances[] = $dependency->getDefaultValue();
                    continue;
                }
                throw new Exception("No se puede resolver la dependencia '{$dependency->getName()}' de {$concrete}");
            }

            // Se asume que el tipo es el nombre de una clase, se obtiene y se crea (o resuelve) recursivamente
            $dependencyClass = $type->getName();
            $instances[] = $this->make($dependencyClass);
        }

        // Se crea la instancia pasando los parámetros resueltos
        return $reflector->newInstanceArgs($instances);
    }
}

?>