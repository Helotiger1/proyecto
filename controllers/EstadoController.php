<?php
namespace App\Controllers;
use App\Repositories\EstadoRepo;
require_once __DIR__ . '/../vendor/autoload.php';
class EstadoController{
    private $estadoRepo;

    public function __construct(){
        $this->estadoRepo = new EstadoRepo();
    }

    public function index(){
        $estados = $this->estadoRepo->getAll();
        return $estados;
    }
}
?>