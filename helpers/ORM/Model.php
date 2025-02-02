<?php 
namespace App\ORM;
abstract class Model {
    protected static $pdo;
    protected static $table;
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $attributes = [];

 // ==================== LOGICA DE BASE DE DATOS ====================
    protected static function getTable(): string {
        if (!static::$table) {
            throw new \Exception('Table name not defined for model: ' . static::class);
        }
        return static::$table;
    }

    public static function query(): QueryBuilder {
        return new QueryBuilder(
            static::class,
            static::getTable()
        );
    }

    public function save(): bool {
        if ($this->exists()) {
            return $this->performUpdate();
        }
        return $this->performInsert();
    }

    public function delete(): bool {
        if (!$this->exists()) return false;
        
        return static::query()
            ->where(static::getPrimaryKey(), $this->getKey())
            ->delete();
    }

    public function exists(): bool {
        return isset($this->attributes[$this->primaryKey]);
    }

    public function __get($name) {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value) {
        if (in_array($name, $this->fillable)) {
            $this->attributes[$name] = $value;
        }
    }

    public function getKey() {
        return $this->attributes[$this->primaryKey] ?? null;
    }
    protected static function getPrimaryKey(): string {
        return (new static())->primaryKey;
    }

    protected function performInsert(): bool {
        $data = $this->getDirtyAttributes();
        
        $success = static::query()->insert($data);
        
        if ($success && $autoIncrement = static::$pdo->lastInsertId()) {
            $this->attributes[$this->primaryKey] = $autoIncrement;
        }
        
        return $success;
    }

    protected function performUpdate(): bool {
        $data = $this->getDirtyAttributes();
        return static::query()
            ->where(static::getPrimaryKey(), $this->getKey())
            ->update($data);
    }

    protected function getDirtyAttributes(): array {
        return array_intersect_key(
            $this->attributes,
            array_flip($this->fillable)
        );
    }

    // ==================== LOGICA DE MODELO ====================

    public function __construct(array $attributes = []) {
        $this->fill($attributes);
    }

    public function fill(array $attributes): self {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->attributes[$key] = $value;
            }
        }
        return $this;
    }

    public static function hydrate(array $data): self {
        $model = new static();
        $model->attributes = $data;
        return $model;
    }

}
?>