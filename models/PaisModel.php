<?php 
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class PaisModel extends Model {
    protected $primaryKey = 'codPais';
    protected $fillable = ['nombrePais','Estatus'];
    protected static $table = 'paises';

    public function __construct()
    {
        self::setConnection(Connection::connect());
    }



    
}
?>