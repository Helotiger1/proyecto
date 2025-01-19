<?php

if (isset($_SESSION['User']) == 1 and (isset($_GET['i']) == 1))
{ 
	$id = $_GET['i'];
	require_once('controllers/NoticiaController.php');	
	$controller= new NoticiaController();
	$result_noticia= $controller->DeleteNoticia1($id);
	
    if ($result_noticia == false) // la consulta no fue exitosa 
	{   ;?>
		<div class="alert alert-warning alert-dismissable">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	   			<span aria-hidden="true">&times;</span>
	   			</button>
				<label for="busqueda" align="right"> <strong>Mensaje de Advertencia</strong><br> 
	   			<p> Ocurrió un error mientras se intentaba eliminar el registro en la base de datos. Revise los datos e intente nuevamente. Asegúrese de que no esté intentando eliminar un registro inexistente. </p> </label> <br>
	   			
	   	</div>
	  			
	<?php 
    }else
	{    ?>
		 <div class="alert alert-success">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
                </button>
                <label for="busqueda" align="right"> <strong>Mensaje de Éxito</strong> <br> 
                <p> El registro del número identificado para la Noticia ha sido eliminado de la base de datos del Sistema de Telemedicina  de forma satisfactoria.</p> </label> <br>
               
          </div>
	<?php
	}
	
    require_once('../ejercicio/views/noticias/listnot.php');
}
else
{
	require_once('../ejercicio/views/noticias/listnot.php');
}

?>  

