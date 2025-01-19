<?php

class NoticiaController
{

	function __construct()
	{
		
	}

 	function ListarNoticia(){
		 require_once('../ejercicio/views/noticias/listnot.php');
	}

	static public function ListarNoticia1(){
	   	 require_once('models/NoticiaModel.php');
         $result_Listar= NoticiaModel::ListarNoticia();
         return $result_Listar;
	}
  
  // Para insertar

    static public function BuscarUltimaNoticia(){
    	 require_once('models/NoticiaModel.php');
         $result_Listar = NoticiaModel::BuscarUltimaNoticia();
         return $result_Listar;
	}

	function IngresarNoticia(){
		 require_once('../ejercicio/views/noticias/insertnot.php');
	}

	function IngresarNoticia1(){
		 require_once('../ejercicio/views/noticias/insertnot1.php');
	}

	static public function IngresarNoticia2($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria){
	  	 require_once('models/NoticiaModel.php');
         $result_Listar= NoticiaModel::IngresarNoticia2($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria);
         return $result_Listar;
	}

	// Para actualizar 

    static public function BuscarNoticiaById($id){
    	 require_once('models/NoticiaModel.php');
         $result_Listar = NoticiaModel::BuscarNoticiaById($id);
         return $result_Listar;
	}

	function UpdateNoticia(){
		 require_once('../ejercicio/views/noticias/updatenot.php');
	}

	function UpdateNoticia1(){
		 require_once('../ejercicio/views/noticias/updatenot1.php');
	}

	static public function UpdateNoticia2($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria){
	  	 require_once('models/NoticiaModel.php');
         $result_Listar= NoticiaModel::UpdateNoticia2($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria);
         return $result_Listar;
	}
  
  // Para eliminar

	function DeleteNoticia(){
		 require_once('../ejercicio/views/noticias/deletednot.php');
	}

	static public function DeleteNoticia1($id){
		require_once('models/NoticiaModel.php');
        $result_Listar= NoticiaModel::DeleteNoticia($id);
        return $result_Listar;

		 
	}

}

?>