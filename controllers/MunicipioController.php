<?php 
namespace App\Controllers;
use App\Repositories\MunicipioRepo;

class MunicipioController{
    private $MunicipioRepo;

    public function __construct(){
        $this->MunicipioRepo = new MunicipioRepo();
    }

    public function index(){
        $Municipios = $this->MunicipioRepo->getAll();
        return $Municipios;
    }

    public function showByEstado($params){
        $Municipios = $this->MunicipioRepo->getByEstado($params['id']);
        return $Municipios;
    }

    public function store($params, $body){
        $this->MunicipioRepo->insert($body['codEstado'], $body['nombreMunicipio']);
        return ['message' => 'Municipio creado exitosamente'];
    }

    public function update($params, $body){
        $this->MunicipioRepo->update($params['id'], $body['codEstado'], $body['nombreMunicipio']);
        return ['message' => 'Municipio actualizado exitosamente'];
    }

    public function destroy($params){
        $this->MunicipioRepo->delete($params['id']);
        return ['message' => 'Municipio eliminado exitosamente'];  
    }

}
?>