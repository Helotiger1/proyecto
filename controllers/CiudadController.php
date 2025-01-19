<?php 
namespace App\Controllers;
use App\Repositories\ciudadRepo;
class CiudadController{
    private $ciudadRepo;

    public function __construct(){
        $this->ciudadRepo = new CiudadRepo();
    }

    public function index(){
        $ciudades = $this->ciudadRepo->getAll();
        return $ciudades;
    }

    public function showByParroquia($params){
        $ciudades = $this->ciudadRepo->getByParroquia($params['id']);
        return $ciudades;
    }

    public function store($params, $body){
        $this->ciudadRepo->insert($body['codParroquia'], $body['nombreCiudad']);
        return ['message' => 'Ciudad creada exitosamente'];
    }

    public function update($params, $body){
        $this->ciudadRepo->update($params['id'], $body['codParroquia'], $body['nombreCiudad']);
        return ['message' => 'Ciudad actualizada exitosamente'];
    }

    public function destroy($params){
        $this->ciudadRepo->delete($params['id']);
        return ['message' => 'Ciudad eliminada exitosamente'];  
    }

}
?>