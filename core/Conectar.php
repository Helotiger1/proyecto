<?php
class Conectar{
    public static $driver;
    public static $host, $user, $pass, $database, $charset;
    public static $conexion=NULL;

    function __construct($driver, $host, $user, $pass, $database, $charset) {
        

    }
     
    public static function conexion() {

        $database_cfg  = require 'config/database.php';
        self::$driver  =$database_cfg["driver"];
        self::$host    =$database_cfg["host"];
        self::$user    =$database_cfg["user"];
        self::$pass    =$database_cfg["pass"];
        self::$database=$database_cfg["database"];
        self::$charset =$database_cfg["charset"];
        
        if(self::$driver=="mysql" || self::$driver==null)
        {
             
            $conexion=new mysqli(self::$host, self::$user, self::$pass, self::$database);
             mysqli_set_charset($conexion, self::$charset);        
             if(mysqli_connect_errno()){
                   echo 'Conexion Fallida : ', mysqli_connect_error();
                   exit();
            }else{
                   return $conexion;  
             } 
         }
       
    }


    public static function desconexion($conexion){

        if(self::$driver=="mysql" || self::$driver==null){
            mysqli_close($conexion);
            return $conexion;
        }
       
    }


}
?>