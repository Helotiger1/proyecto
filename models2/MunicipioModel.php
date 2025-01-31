<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class MunicipioModel extends Model {
    protected $primaryKey = 'codMunicipio';
    protected $fillable = ['nombreMunicipio', 'codEstado', 'nombreEstado', 'codPais', 'nombrePais'];
    protected static $table = 'municipios';

    public function __construct() {
    }
}
?>
