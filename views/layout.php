<!doctype html>
<html lang="en">
  	<head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sistema</title>
		<link rel="stylesheet" href="../css/navbar.css";>
		<link rel="stylesheet" href="styles/styles.css";> 
		<link rel="stylesheet" href="../css/bootstrap.min.css";>   
  		<link rel="stylesheet" type="text/css" href="../css/datatables.min.css" />
  		<link rel="icon" type="image/png" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
  		<link rel="shortcut icon" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  		<script type="text/javascript" src="../js/datatables.min.js"></script>
  		<script type="text/javascript" src="../js/datatable.js"></script>
  		<script src="../js/jquery.min.js"></script>
		<script src="js/functions.js"></script>
	</head>
<body>

<header class="col-2">
	<?php 
	   	require_once('navbaroptions.php');
	?>	
</header>

<section class="col-10 master-table">	

	<div class="container" id="tabla1">
        <div class="identificator">
            <div class="text">
                <span id="tableTitle">Domicilio / Estados Registrados</span>
            </div>
            <div class="agg">
                <a class="btn btn-primary bttn-agregar"  onclick="window.location.href='formulario.php';">Agregar</a>
                <a class="btn btn-primary bttn-eliminar" onclick="window.location.href='eliminar.php';">Eliminar</a>
                <a class="btn btn-primary bttn-actualizar" onclick="window.location.href='actualizar.php';">Actualizar</a>
            </div>
        </div>
        <div class="input-options">
            <div>
                <span>Mostrar</span>
                <input type="number" class="input-numbers">
                <span>resultados</span>
            </div>
            <div>
                <span>Buscar :</span>
                <input type="text" class="input-text">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pais</th>
                    <th>Estado</th>
					<th>Ciudad</th>
                    <th>Municipio</th>
                    <th>Parroquia</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
  	</div>

</section>

<footer>
	<?php 
		require_once('footer.php');
	?>
</footer>
</body>

</html>









