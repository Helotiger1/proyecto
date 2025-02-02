<?php
namespace App\Models;
use App\ORM\Model;
require_once 'vendor/autoload.php';

class MunicipioModel extends Model {
    protected static $table = 'municipios';
    protected $primaryKey = 'codMunicipio';
    protected $fillable = ['nombreMunicipio', 'codEstado'];


}
?>
