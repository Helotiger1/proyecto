<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class ParroquiaModel extends Model {
    protected $primaryKey = 'codParroquia';
    protected $fillable = ['nombreParroquia', 'codMunicipio', 'nombreMunicipio', 'codEstado', 'nombreEstado', 'codPais', 'nombrePais'];
    protected static $table = 'parroquias';

    public function __construct() {
    }
}
?>
