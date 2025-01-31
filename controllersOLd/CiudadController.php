<?php 
namespace App\Controllers;
use App\Controllers\ParroquiaController;
use App\Repositories\ciudadRepo;
class CiudadController{
    private $ciudadRepo, $parroquiaController;

    public function __construct(){
        $this->ciudadRepo = new CiudadRepo();
        $this->parroquiaController = new ParroquiaController;
    }

    public function index(){
        $ciudades = $this->ciudadRepo->getAll();
        return $ciudades;
    }

    public function store($params, $body){
        if($this->verifyExistance($body['nombreCiudad'])){
            return ['message' => 'Ciudad ya existente.'];
        }
        $body['codParroquia'] = $this->matchNameAndID($body['nombreParroquia']);

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


    public function verifyExistance($nombreCiudad) {
        $Ciudades = $this->index(); 
        foreach ($Ciudades as $Ciudad) { 
            if ($Ciudad->nombreCiudad == $nombreCiudad) { 
                return true; 
            }
        }
        return false;
    }

    public function matchNameAndID($nombreParroquia){
        $Parroquias = $this->parroquiaController->index(); 
        foreach ($Parroquias as $Parroquia) { 
            if ($nombreParroquia == $Parroquia->nombreParroquia) { 
                return $Parroquia->codParroquia;
            }
        }
        return;
    }
    

  

}
?>