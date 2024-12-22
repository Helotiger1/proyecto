<?php 
namespace Proyecto\Core;
require "configs.php";
class Conexion{
    private $driver, $host, $user, $pass, $database, $charset;
    
    public function __construct(){
        $database_cfg = getConfigs();
        $this->driver  = $database_cfg["driver"];
        $this->host    = $database_cfg["host"];
        $this->user    = $database_cfg["user"];
        $this->pass    = $database_cfg["pass"];
        $this->database= $database_cfg["database"];
        $this->charset = $database_cfg["charset"];
    }

    public function conectar(){
        try{
            $dsn = $this->driver . ":host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $usuario = $this->user;
            $contraseña = $this->pass;
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false];
                
            $pdo = new PDO($dsn,$usuario,$contraseña,$opciones);
            return $pdo;
        }

        catch(PDOException $e){
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}


?>