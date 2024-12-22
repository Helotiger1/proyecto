<?php 
class Logger {
    public static function logError($message) {
        $direccion = __DIR__ . "/../logs/error.log";
        file_put_contents($direccion, date('Y-m-d H:i:s') . " - ERROR: " . $message . PHP_EOL, FILE_APPEND);
    }
}

class ErrorHandler {
    public static function handleException($exception) {
        Logger::logError($exception->getMessage());
        echo "Ocurrió un error. Por favor, intente más tarde.";
    }
}

set_exception_handler([ErrorHandler::class, 'handleException']);

?>