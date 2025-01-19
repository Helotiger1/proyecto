<?php

if ((isset($_SESSION['User']) == 1) and (isset($_POST['id']) == 1))
{ 
	$id = $_POST['id'];
	$titular = $_POST['titular'];
	$visible = $_POST['visible'];
	$categoria = $_POST['categoria'];
	$fecha = $_POST['fecha'];
	$url_noticia = $_POST['url_noticia'];
	$url_imagen = $_POST['url_imagen'];

	require_once('controllers/NoticiaController.php');
    $controller= new NoticiaController();
    $result_noticia= $controller->IngresarNoticia2($id, $titular, $url_imagen, $url_noticia, $fecha, $visible, $categoria);


	if ($result_noticia == false) // la consulta no fue exitosa 
	{   ?>
		<div class="alert alert-warning alert-dismissable">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	   			<span aria-hidden="true">&times;</span>
	   			</button>
				<label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br> 
	   			<p> Ocurrió un error mientras se intentaba ingresar el registro en la base de datos. Revise los datos e intente nuevamente. Asegúrese de que no esté intentando ingresar un registro repetido. </p> </label> <br>
	   			
	   	</div>
  	  			
	<?php 
    }else
	{    
		?>
		 <div class="alert alert-success">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
                </button>
                <label for="busqueda" align="right"> <strong>Mensaje de Éxito</strong> <br> 
                <p> El registro de la Noticia a publicar en el Sistema de Telemedicina ha sido insertado en la base de datos de forma satisfactoria.</p> </label> <br>
                
          </div>
	<?php
    }

    require_once('../ejercicio/views/noticias/insertnot.php');
}else
{
	require_once('../ejercicio/views/noticias/insertnot.php');
}

?>  

