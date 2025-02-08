<?php
namespace App\Models\Domicilios;
use App\ORM\Model;
use JsonSerializable;

abstract class ModelTerritorial extends Model implements JsonSerializable
{
    protected static $table = '';
    protected static $primaryKey = '';
    protected static $fillable = [];
    public function jsonSerialize() : array{
        return $this->attributes;
    }

    // ==================== LOGICA DE BASE DE DATOS ====================
    public static function getAll(){
        return self::query()->get();
    }
    
    public static function getById($id){
        return self::query()->find(self::$primaryKey, $id);
    }

    public static function verifyExistance($id){
        return self::getById($id) ? true : false;
    }

    public static function create($data){
        return self::query()->insert($data);
    }

    public static function update($id, $data){
        var_dump($id);
        return self::query()->where(self::$primaryKey, $id)->update($data);
    }

    public static function deleteByID($id){
        return self::query()->where(self::$primaryKey, $id)->delete();
    }
}
?>