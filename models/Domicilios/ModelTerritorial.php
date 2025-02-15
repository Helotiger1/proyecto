<?php
namespace App\Models\Domicilios;
use App\ORM\QueryBuilder;
use JsonSerializable;

abstract class ModelTerritorial implements JsonSerializable
{
    protected static $cascadeJoins = [];
    protected static $fillable = [];
    public $attributes = [];

    protected static $primaryKey = '';
    protected static $fk = '';
    protected static $table = '';

    protected static $ORM = null;
    
    public function jsonSerialize() : array{
        return $this->attributes;
    }

    public static function query(): QueryBuilder {

        if (!static::$ORM) {
            static::$ORM = new QueryBuilder(
                static::$table
            );
        }

        return static::$ORM;
    }

    public static function getAll(){
        $nose = static::query()->joinNested(static::$cascadeJoins)->get();
        return self::hydrate($nose);
    }
    
    public static function getById($id){
        return static::query()->find(static::$primaryKey, $id);
    }
    
    public static function getByParent($parentId){
        return static::query()->where(self::$fk,$parentId)->get();
    }

    public static function verifyExistance($id){
        return static::getById($id) ? true : false;
    }

    public static function create($data){
        return static::query()->insert($data);
    }

    public static function update($id, $data){
        return static::query()->where(static::$primaryKey, $id)->update($data);
    }

    public static function deleteByID($id){
        return static::query()->where(static::$primaryKey, $id)->delete();
    }
   
    public static function hydrate($data) {
        // Si $data es un arreglo de arreglos (varios registros)
        if (isset($data[0]) && is_array($data[0])) {
            return array_map(function ($item) {
                $model = new static();
                $model->attributes = $item;
                return $model;
            }, $data);
        }
        
        // Si $data es un arreglo simple (un único registro)
        $model = new static();
        $model->attributes = $data;
        return $model;
    }
    
}
?>