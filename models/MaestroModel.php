<?php

namespace App\Models;
use App\Helpers\Container;
use App\ORM\QueryBuilder;
use JsonSerializable;
require "../vendor/autoload.php";

class MaestroModel implements JsonSerializable
{
    protected static $attributes = [];

    protected static $primaryKey = 'idMaestro';
    protected static $fk = '';
    protected static $table = 'maestros';
    protected static $nameEntity = '';

    protected static $ORM = null;
    
    public static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function jsonSerialize() : array{
        return $this->attributes;
    }
    
    public static function query(): QueryBuilder {
        if (!static::$ORM) {
            static::$ORM = Container::getInstance()->make('QueryBuilder');
        }
        return static::$ORM->table(static::$table);
    }

    public static function getAll(){
        $nose = static::query()->get();
        return self::hydrate($nose);
    }
    
    public static function getById($id){
        $data = static::query()->find(static::$primaryKey, $id);
        return self::hydrate($data);
    }
    
    public static function getByParent($parentId){

        $data = static::query()->select([static::$nameEntity,static::$fk])->where(static::$fk, $parentId)->get();
        return self::hydrate($data);
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
        return static::query()->where(static::$primaryKey, intval($id))->delete();
    }
   
    public static function hydrate($data) {
        if (isset($data[0]) && is_array($data[0])) {
            return array_map(function ($item) {
                $model = new static();
                $model->attributes = $item;
                return $model;
            }, $data);
        }
        
        $model = new static();
        $model->attributes = $data;
        return $model;
    }
    
}


?>