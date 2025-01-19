<?php 
namespace App\Controllers;
use App\Repositories\ParroquiaRepo;
class ParroquiaController{
    private $ParroquiaRepo;

    public function __construct(){
        $this->ParroquiaRepo = new ParroquiaRepo();
    }

    public function index(){
        $parroquias = $this->ParroquiaRepo->getAll();
        return $parroquias;
    }

    public function showByMunicipio($params){
        $parroquias = $this->ParroquiaRepo->getByMunicipio($params['id']);
        return $parroquias;
    }

    public function store($params, $body){
        $this->ParroquiaRepo->insert($body['codMunicipio'], $body['nombreParroquia']);
        return ['message' => 'Parroquia creado exitosamente'];
    }

    public function update($params, $body){
        $this->ParroquiaRepo->update($params['id'], $body['codMunicipio'], $body['nombreParroquia']);
        return ['message' => 'Parroquia actualizado exitosamente'];
    }

    public function destroy($params){
        $this->ParroquiaRepo->delete($params['id']);
        return ['message' => 'Parroquia eliminado exitosamente'];  
    }

}
?>