<?php 
namespace App\Models\Domicilios;
use App\ORM\Model;
use JsonSerializable;

require_once 'vendor/autoload.php';

class PaisModel extends Model implements JsonSerializable{
    protected static $table = 'paises';
    protected $primaryKey = 'codPais';
    protected $fillable = ['nombrePais', 'estatus'];

    // ==================== LOGICA DE MODELO ====================

    public function jsonSerialize() : array{
        return $this->attributes;
    }

    // ==================== LOGICA DE BASE DE DATOS ====================
    public static function getAll(){
        return self::query()->get();
    }

    


}

?>