<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class EstadoModel extends Model {
    protected $primaryKey = 'codEstado';
    protected $fillable = ['nombreEstado', 'nombrePais', 'codPais'];
    protected static $table = 'estados';

    public function __construct() {
        self::setConnection(Connection::connect());
    }
}
?>
