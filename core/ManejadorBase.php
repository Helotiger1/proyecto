<?php 
require_once "../auxiliares/autoloader.php";
Autoloader("core","Conexion");

class ManejadorBase{
    private $conector;

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
        $where = paresClaveValor(array_keys($condiciones));
        $sql = "SELECT * FROM $tabla $where";
        $params = array_values($condiciones);
        $this->consultarDB($sql, $params);
    }

    public function insertarRegistro($tabla, $registro){
        $campos = implode(",", array_keys($registro));
        $placeholders = array_map(fn() => '?', $registro);
        $sql = "INSERT INTO $tabla ($campos) VALUES ($placeholders)";
        $params = array_values($registro);
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

//Aqui ira una opcion para poder usar joins.



//y aqui una para usar joins y filtrado con having



//TO-DO | Hacer que reciba un parametro "Tipo" para especificar si se usara AND o OR en el SQL
function paresClaveValor($condiciones = [],$registro = []){
    $registroConstruido = "";
    $whereConstruido = "";

    if(!empty($registros)){
        $registroConstruido = ' SET ' . implode(" , ",array_map(fn($col) => "$col = ?", $registro));
    }

    if (!empty($condiciones)){
        $whereConstruido = ' WHERE ' . implode(" AND ",array_map(fn($col) => "$col = ?", $condiciones));
    }

    return ($registroConstruido . $whereConstruido);
}
?>