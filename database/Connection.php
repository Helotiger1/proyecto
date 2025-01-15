<?php 
namespace App\Database;
use PDO;
use PDOException;
require_once "configs.php";


class Connection {
    private $driver, $host, $user, $pass, $database, $charset;
    private $pdo;
    
    public function __construct() {
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

    public function execute($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll();
    }

    public function fetchOne($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetch();
    }
}
?>