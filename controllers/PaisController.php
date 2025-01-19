<?php 
namespace App\Controllers;
use App\Repositories\PaisRepo;
require_once __DIR__ . '/../vendor/autoload.php';
class PaisController{
    private $paisRepo;

    public function __construct(){
        $this->paisRepo = new PaisRepo();
    }

    public function index(){
        $paises = $this->paisRepo->getAll();
        return $paises;
    }

    public function store($params, $body){
        $this->paisRepo->insert($body['nombrePais'], $body['estatus']);
        return ['message' => 'Pais creado exitosamente'];
    }

    public function update($params, $body){
        $this->paisRepo->update($params['id'], $body['nombrePais'], $body['estatus']);
        return ['message' => 'Pais actualizado exitosamente'];
    }

    public function destroy($params, $body){
        $this->paisRepo->delete($params['id']);
        return ['message' => 'Pais eliminado exitosamente'];
    }
}
?>