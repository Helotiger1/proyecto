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

    public function showByPais($params){
        $estados = $this->estadoRepo->getByPais($params['id']);
        return $estados;
    }

    public function store($params, $body){
        $this->estadoRepo->insert($body['codPais'], $body['nombreEstado']);
        return ['message' => 'Estado creado exitosamente'];
    }

    public function update($params, $body){
        $this->estadoRepo->update($params['id'], $body['codPais'], $body['nombreEstado']);
        return ['message' => 'Estado actualizado exitosamente'];
    }

    public function destroy($params){
        $this->estadoRepo->delete($params['id']);
        return ['message' => 'Estado eliminado exitosamente'];  
    }

}
?>