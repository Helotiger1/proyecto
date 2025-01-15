<?php
use App\Repositories\EstadoRepo;
class EstadoController{
    private $estadoRepo;
    public function __construct(){
        $this->estadoRepo = new EstadoRepo();
    }

    public function index(){
        $estados = $this->estadoRepo->getAll();
        return json_encode($estados);
    }
}


?>