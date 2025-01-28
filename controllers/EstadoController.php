<?php
namespace App\Controllers;
use App\Repositories\EstadoRepo;
use App\Controllers\PaisController;

require_once __DIR__ . '/../vendor/autoload.php';
class EstadoController{
    private $estadoRepo, $paisController;

    public function __construct(){
        $this->estadoRepo = new EstadoRepo();
        $this->paisController = new PaisController();
    }

    public function index(){
        $estados = $this->estadoRepo->getAll();
        return $estados;
    }

    public function store($params, $body){
        if($this->verifyExistance($body['nombreEstado'])){
            return ['message' => 'Estado ya existente.'];
        }
        $body['codPais'] = $this->matchNameAndID($body['nombrePais']);
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

    public function verifyExistance($nombreEstado) {
        $estados = $this->index(); 
        foreach ($estados as $estado) { 
            if ($estado->nombreEstado == $nombreEstado) { 
                return true; 
            }
        }
        return false;
    }

    public function matchNameAndID($nombrePais){
        $paises = $this->paisController->index(); 
        foreach ($paises as $pais) { 
            if ($nombrePais == $pais->nombrePais) { 
                return $pais->codPais; 
            }
        }
        return;
    }

}


?>