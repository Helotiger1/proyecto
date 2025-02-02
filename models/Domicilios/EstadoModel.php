<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class EstadoModel extends Model {
    protected static $table = 'estados';
    protected $primaryKey = 'codEstado';
    protected $fillable = ['nombreEstado', 'codPais'];


}
?>
