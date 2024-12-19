<?php 
require_once "../auxiliares/autoloader.php";
Autoloader("core","Conexion");
Autoloader("core","QueryBuilder");

class ManejadorBase{
    private $conector;
    private $QueryBuilder;

    public function __construct(){
        $this->conector = new Conexion();
    }
    
    public function modificarDB($sql, $params): void{
        try{
            $stmt = $this->conector->prepare($sql);
            $stmt->execute($params);
        }

        //TO-DO | Mejorar estos logs, hacerlos mas especificos.
        catch(Exception $e){
            error_log("Error al actualizar usuario: " . $e->getMessage() . "\n", 3, __DIR__ . "/logs/error.log");
            throw new Exception("Hubo un problema al actualizar la base de datos.");
        }
    }

    public function consultarDB($sql, $params){
        try{
            $stmt = $this->conector->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        catch(Exception $e){
            error_log("Error al actualizar usuario: " . $e->getMessage() . "\n", 3, __DIR__ . "/../logs/error.log");
            throw new Exception("Hubo un problema al consultar la base de datos.");
        }
    }
    
    public function consultarRegistro($tabla, $condiciones = [], $params = []){
        
        $this->consultarDB($sql, $params);
    }

    public function insertarRegistro($tabla, $registro){
        $QueryBuilder = New QueryBuilder();
        $this->modificarDB($sql, $pamams);
    }

    public function actualizarRegistro($tabla, $registro = [], $condiciones = []){
        $claveValor = paresClaveValor(array_keys($condiciones), array_keys($registro));
        $sql = "UPDATE $tabla $claveValor";
        $params = array_merge(array_values($registro), $array_values($condiciones));
        this->modificarDB($sql, $params);
    }

    public function eliminarRegistro($tabla, $condicion){
        $where = paresClaveValor(array_keys($condicion));
        $sql = "DELETE FROM $tabla $where";
        $params = array_values($condicion);
        this->modificarDB($sql, $params);
    }
}
?>