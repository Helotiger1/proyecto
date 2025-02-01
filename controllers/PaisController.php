<?php 
namespace App\Controllers;
use App\Models\PaisModel;

class PaisController {
    public function index() {
        $paises = PaisModel::getAll();
        return $paises;
    }
}

?>