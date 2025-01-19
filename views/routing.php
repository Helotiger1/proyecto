
<?php 


$controllers=array(
	
	'Noticia'=>['ListarNoticia', 'IngresarNoticia', 'IngresarNoticia1', 'UpdateNoticia', 'UpdateNoticia1', 'DeleteNoticia']
	// este arreglo ira creciendo a la medida que va creciendo las opciones de menu me mi sistema
);

if (@array_key_exists($controller, $controllers)) {
	
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	}
	else{
		call('Noticia','ListarNoticia');
	}		
}else{
	
		call('Noticia','ListarNoticia');
}

function call($controller, $action){
	

	require_once('controllers/'.$controller.'Controller.php');

	switch ($controller) {
		 
		case 'Noticia': 
			  $controller= new NoticiaController();
			  break;
			 // en este switche habran tantos case como listas del menu se tengan
	}
	
	$controller->{$action}();
}

?>

