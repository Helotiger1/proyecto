<?php 
namespace App\Database;
use PDO;
use PDOException;

class Connection {
    private $driver, $host, $user, $pass, $database, $charset;
    private $pdo;
    
    public function __construct($database_cfg) {
        $database_cfg = getConfigs();
        $this->driver  = $database_cfg["driver"];
        $this->host    = $database_cfg["host"];
        $this->user    = $database_cfg["user"];
        $this->pass    = $database_cfg["pass"];
        $this->database= $database_cfg["database"];
        $this->charset = $database_cfg["charset"];
        $this->pdo = $this->connect();
    }

    public function connect() {
        try {
            $dsn = $this->driver . ":host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $username = $this->user;
            $password = $this->pass;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
                
            $pdo = new PDO($dsn, $username, $password, $options);
            return $pdo;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
//deberia separarlo, pero estoy mamao de hacer 100 clases, si tuviera un orm hecho quizas, pero esto va pa largo.
    public function save($query, $params) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function get($query, $params) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

}

?>