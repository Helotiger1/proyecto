<?php 
namespace App\Controllers;
use App\Repositories\ParroquiaRepo;
use App\Controllers\MunicipioController;
class ParroquiaController{
    private $ParroquiaRepo,$MunicipioController;

    public function __construct(){
        $this->ParroquiaRepo = new ParroquiaRepo();
        $this->MunicipioController = new MunicipioController;
    }

    public function index(){
        $parroquias = $this->ParroquiaRepo->getAll();
        return $parroquias;
    }


    public function store($params, $body){
        if($this->verifyExistance($body['nombreParroquia'])){
            return ['message' => 'Parroquia ya existente.'];
        }
        $body['codMunicipio'] = $this->matchNameAndID($body['nombreMunicipio']);


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

    public function verifyExistance($nombreParroquia) {
        $Parroquias = $this->index(); 
        foreach ($Parroquias as $Parroquia) { 
            if ($Parroquia->nombreParroquia == $nombreParroquia) { 
                return true; 
            }
        }
        return false;
    }

    public function matchNameAndID($nombreMunicipio){
        $Municipios = $this->MunicipioController->index(); 
        foreach ($Municipios as $Municipio) { 
            if ($nombreMunicipio == $Municipio->nombreMunicipio) { 
                return $Municipio->codMunicipio;
            }
        }
        return;
    }
}
?>