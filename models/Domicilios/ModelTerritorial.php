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
    protected static $table = '';

    protected static $ORM = null;
    
    public function jsonSerialize() : array{
        return $this->attributes;
    }

    public static function query(): QueryBuilder {

        if (!static::$ORM) {
            static::$ORM = new QueryBuilder(
                static::class,
                static::$table
            );
        }

        return static::$ORM;
    }

    public static function getAll(){
        return static::query()->joinNested(static::$cascadeJoins)->get();
    }
    
    public static function getById($id){
        return static::query()->find(static::$primaryKey, $id);
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

    public static function hydrate(array $data): self {
        $model = new static();
        $model->attributes = $data;
        return $model;
    }
}
?>