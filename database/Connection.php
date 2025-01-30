<?php 
namespace App\Database;
use PDO;
use PDOException;
require_once "configs.php";

class Connection {
    public static function connect() {
        $database_cfg = getConfigs();
        try {
            $dsn = $database_cfg["driver"] . ":host=" . $database_cfg["host"] . ";dbname=" . $database_cfg["database"] . ";charset=" . $database_cfg["charset"];
            $username = $database_cfg["user"];
            $password = $database_cfg["pass"];;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
                
            $pdo = new PDO($dsn, $username, $password, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Handle the error gracefully
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
            exit;
        }
    }
}
?>