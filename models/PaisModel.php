<?php 
namespace App\Models;
use App\ORM\Model;
require_once 'vendor/autoload.php';

class PaisModel extends Model {
    protected $primaryKey = 'codPais';
    protected $fillable = ['nombrePais', 'estatus', 'codPais'];
    protected static $table = 'paises';

    // ==================== LOGICA DE MODELO ====================
    public function __construct()
    {
    }

    









    // ==================== LOGICA DE BASE DE DATOS ====================
    public static function getAll(){
        return self::query()->get();
    }
}
var_dump(PaisModel::getAll());

?>