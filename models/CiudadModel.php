<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class CiudadModel extends Model {
    protected $primaryKey = 'codCiudad';
    protected $fillable = ['nombreCiudad', 'codParroquia', 'nombreParroquia', 'codMunicipio', 'nombreMunicipio', 'codEstado', 'nombreEstado', 'codPais', 'nombrePais'];
    protected static $table = 'ciudades';

    public function __construct() {
        self::setConnection(Connection::connect());
    }
}
?>
