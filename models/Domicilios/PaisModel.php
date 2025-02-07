<?php 
namespace App\Models\Domicilios;
use App\ORM\Model;
use JsonSerializable;
$composer = __DIR__ . '/../../vendor/autoload.php';

require_once $composer;

class PaisModel extends Model implements JsonSerializable{
    protected static $table = 'paises';
    protected static $primaryKey = 'codPais';
    protected static $fillable = ['nombrePais', 'estatus'];

    // ==================== LOGICA DE MODELO ====================

    public function jsonSerialize() : array{
        return $this->attributes;
    }

    // ==================== LOGICA DE BASE DE DATOS ====================
    public static function getAll(){
        return self::query()->get();
    }
    
    public static function getById($id){
        return self::query()->find(self::$primaryKey, (int)$id);
    }

    public static function verifyExistance($id){
        return self::getById($id) ? true : false;
    }

    public static function create($data){
        return self::query()->insert($data);
    }

    public static function update($id, $data){
        return self::query()->where(self::$primaryKey, (int)$id)->update($data);
    }

    public static function deleteByID($id){
        return self::query()->where(self::$primaryKey, (int)$id)->delete();
    }

}
?>