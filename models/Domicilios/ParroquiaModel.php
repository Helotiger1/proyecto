<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class ParroquiaModel extends Model {
    protected static $table = 'parroquias';
    protected $primaryKey = 'codParroquia';
    protected $fillable = ['nombreParroquia', 'codMunicipio'];

    public function jsonSerialize() : array{
        return $this->attributes;
    }

    public function __construct() {
    }
}
?>
