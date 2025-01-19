<?php 

class NoticiaModel
{
	
	function __construct()
	{
	
	}

	// FUNCIONES GENERICAS PARA CONSULTAR Y ACTUALIZAR (INSERTAR, MODIFICAR Y ELIMINAR)

	public static function Get_Data($sql){
		include_once('core/Conectar.php');
		$conexion=Conectar::conexion();
		if(!$result = mysqli_query($conexion, $sql)) die();
		$conexion = Conectar::desconexion($conexion);
  		return $result;
	}

	public static function Update_Data($sql){
		include_once('core/Conectar.php');
		$conexion=Conectar::conexion();
		mysqli_autocommit($conexion, FALSE);
		$result = mysqli_query($conexion, $sql);

		if ($result == true) // la consulta fue exitosa 
		{   
			if (mysqli_affected_rows($conexion) == 0) // si no hizo la actualizacion
			{   mysqli_rollback($conexion);
				$result = false;
			}else   // si hizo la actualizacion
			{   mysqli_commit($conexion);
				$result = true;
		    }
		}

		$conexion = Conectar::desconexion($conexion);

	  	return $result;
	}

	
    // para el resto de las operaciones
	

	public static function ListarNoticia(){
		$sql_noticia = "SELECT id, trim(titular) as titular, trim(url_imagen) as url_imagen, trim(url_noticia) as url_noticia, fecha, visible, categoria FROM tbl_noticias ORDER BY id asc";
		$result_noticia = NoticiaModel::Get_Data($sql_noticia);
  		return $result_noticia;
	}

    // Para la insersión

	public static function BuscarUltimaNoticia(){

		$sql_noticia = "SELECT (max(id)) as identific FROM tbl_noticias order BY id asc";
		$result_noticia = NoticiaModel::Get_Data($sql_noticia);
  		return $result_noticia;
	}

	public static function IngresarNoticia2 ($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria){

		$sql_noticia = "INSERT INTO tbl_noticias (id, titular, visible, categoria, fecha, url_noticia, url_imagen) VALUES ($id, '$titular', '$visible', '$categoria', '$fecha', '$url_noticia', '$url_imagen')";
		$result_noticia = NoticiaModel::Update_Data($sql_noticia);
  		return $result_noticia;
	}

	// Para la actualización 

	public static function BuscarNoticiaById($id){
    	$sql_noticia = "SELECT * FROM tbl_noticias WHERE id = $id";
		$result_noticia = NoticiaModel::Get_Data($sql_noticia);
  		return $result_noticia;
	}

	public static function UpdateNoticia2 ($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria){

		$sql_noticia= "UPDATE tbl_noticias SET titular = '$titular', visible = '$visible', categoria = '$categoria', fecha = '$fecha', url_noticia = '$url_noticia', url_imagen = '$url_imagen' WHERE id = $id";
		$result_noticia = NoticiaModel::Update_Data($sql_noticia);
  		return $result_noticia;
	}

	
	// Para eliminar

	public static function DeleteNoticia ($id){
		$sql_noticia = "DELETE FROM tbl_noticias WHERE id = $id";
		$result_noticia = NoticiaModel::Update_Data($sql_noticia);
  		return $result_noticia;
	}
}

?>