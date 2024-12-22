<?php 
class BaseController{
    private $BaseModel;

    public function __construct(){
        $this->BaseModel = New BaseModel();
    }

    public function index($tabla){
        $Base = $this->BaseModel->listarBase();
        echo json_encode($Base);
    }

    public function show($tabla, $id){
        $estado = $this->BaseModel->obtenerPorID($id);
        echo json_encode($estado);
    }

    public function store($tabla, $data){
        $this->BaseModel->crear($data);
        echo json_encode(["message" => "Estado creado con éxito"]);
    }

    public function update($tabla, $id, $data){
        $this->BaseModel->actualizar($id, $data);
        echo json_encode(["message" => "Estado actualizado con éxito"]);
    }

    public function destroy($tabla, $id){
        $this->BaseModel->eliminar($id);
        echo json_encode(["message" => "Estado eliminado con éxito"]);
    }

}
?>