<?php
namespace App\Models;
use App\ORM\Model;
use App\Database\Connection;
require_once 'vendor/autoload.php';

class CiudadModel extends Model {
    protected static $table = 'ciudades';
    protected $primaryKey = 'codCiudad';
    protected $fillable = ['nombreCiudad', 'codParroquia'];


}
?>
