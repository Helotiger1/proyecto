<?php 
namespace Proyecto\Core;

class ManejadorBase{
    private $Conexion;
    private $QueryBuilder;

    public function __construct(){
        $this->Conexion = new Conexion();
        $this->QueryBuilder = new QueryBuilder();
    }
    
    public function modificarDB($sql, $params): void{
        try{
            $stmt = $this->Conexion->prepare($sql);
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
            $stmt = $this->Conexion->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        catch(Exception $e){
            error_log("Error al actualizar usuario: " . $e->getMessage() . "\n", 3, __DIR__ . "/../logs/error.log");
            throw new Exception("Hubo un problema al consultar la base de datos.");
        }
    }
    
}
?>