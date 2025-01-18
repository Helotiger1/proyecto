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

    public function show($id){
        $estado = $this->estadoRepo->getOne($id);
        return $estado;
    }

    public function store($codPais, $descripcion){
  
    }

    public function update($id, $codPais, $descripcion){
      
    }

    public function destroy($id){
        
    }

}
?>