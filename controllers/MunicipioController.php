<?php 
namespace App\Controllers;
use App\Repositories\MunicipioRepo;
use App\Controllers\EstadoController;

class MunicipioController{
    private $MunicipioRepo, $EstadoController;

    public function __construct(){
        $this->MunicipioRepo = new MunicipioRepo();
        $this->EstadoController = new EstadoController;
    }

    public function index(){
        $Municipios = $this->MunicipioRepo->getAll();
        return $Municipios;
    }

    public function store($params, $body){
        if($this->verifyExistance($body['nombreMunicipio'])){
            return ['message' => 'Municipio ya existente.'];
        }
        $body['codEstado'] = $this->matchNameAndID($body['nombreEstado']);

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


    public function verifyExistance($nombreMunicipio) {
        $Municipios = $this->index(); 
        foreach ($Municipios as $Municipio) { 
            if ($Municipio->nombreMunicipio == $nombreMunicipio) { 
                return true; 
            }
        }
        return false;
    }
    

    public function matchNameAndID($nombreEstado){
        $estados = $this->EstadoController->index(); 
        foreach ($estados as $estado) { 
            if ($nombreEstado == $estado->nombreEstado) { 
                return $estado->codEstado; 
            }
        }
        return;
    }
}
?>