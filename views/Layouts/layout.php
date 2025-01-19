<!doctype html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- , shrink-to-fit=no este pedazo lo quite cuando introduje el colapse de los divs-->
    <title>Sistema de Telemedicina </title>
    <link rel="icon" type="image/png" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
    <link rel="shortcut icon" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
    
    <!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="../../css/bootstrap.min.css";>   <!-- Bootstrap carga los componentes del css desde directorio-->
	<link rel="stylesheet" href="../../css/navbar.css";>   <!-- Bootstrap carga los componentes del css desde directorio-->
	<link rel="stylesheet" href="../../css/menu_submenu.css";>
	
	<!-- jQuery library -->

	<script src="../../js/jquery.min.js"></script>

	<!--datatables-->
  	<link rel="stylesheet" type="text/css" href="../../css/datatables.min.css" />
  	<script type="text/javascript" src="../../js/datatables.min.js"></script>
  	<script type="text/javascript" src="../../js/datatable.js"></script>
  	<!--datatables-->

	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

<body>
<style>
	table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #f2f2f2;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #ffffff;
    color: black;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #ddd;
}
.table-options{
	width: 15%;
}

.input-numbers{
	width: 80px;
}
.input-options{
	margin-bottom: 20px;
	display: flex
;
    justify-content: space-between;
}
.input-options div{
	display: flex
;
    gap: 11px;
}
.identificator{
	display: flex
;
    background: #00b8ff;
    align-items: center;
    margin-bottom: 7rem;
    padding: 12px;
    width: 70vw;
    justify-content: space-between;
    border-radius: 9px;
    font-weight: 600;
    font-size: 19px;
}
.agg a{
	color: white !important;
    font-weight: 700;
}
</style>
<header class="col-2">
	<?php 
	   	require_once('./navbaroptions.php');
	?>	
</header>


<section class="col-10 master-table">	

	<div class="container" id="tabla1">
        <div class="identificator">
            <div class="text">
                <span id="tableTitle">Domicilio / Estados Registrados</span>
            </div>
            <div class="agg">
                <a class="btn btn-primary">Agregar</a>
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



			<script>
				function fetchData(endpoint, option) {
					$.ajax({
						url: `http://localhost/proyecto${endpoint}`,
						method: 'GET',
						success: function(response) {
							console.log('Response data:', response); // Debugging line
							if (response.data && Array.isArray(response.data)) {
								updateTable(response.data, option);
								updateHeading(option);
							} else {
								console.error('Expected an array but got:', response);
							}
						},
						error: function() {
							console.error(`Error fetching data from ${endpoint}`);
						}
					});
				}

				function updateTable(data, option) {
					const tableBody = $('#tabla1 tbody');
					const tableHead = $('#tabla1 thead');
					tableBody.empty();
					tableHead.empty();

					let headers = [];
					let rows = [];

					if (option === 'Paises') {
						headers = ['ID', 'Nombre País', 'Estatus'];
						rows = data.map(item => `
							<tr>
								<td>${item.codPais}</td>
								<td>${item.nombrePais}</td>
								<td>${item.estatus}</td>
							</tr>
						`);
					} else if (option === 'Estados') {
						headers = ['ID', 'Nombre Estado', 'Nombre País'];
						rows = data.map(item => `
							<tr>
								<td>${item.codEstado}</td>
								<td>${item.nombreEstado}</td>
								<td>${item.nombrePais}</td>
							</tr>
						`);
					} else if (option === 'Municipios') {
						headers = ['ID', 'Nombre Municipio', 'Nombre Estado', 'Nombre País'];
						rows = data.map(item => `
							<tr>
								<td>${item.codMunicipio}</td>
								<td>${item.nombreMunicipio}</td>
								<td>${item.nombreEstado}</td>
								<td>${item.nombrePais}</td>
							</tr>
						`);
					} else if (option === 'Parroquias') {
						headers = ['ID', 'Nombre Parroquia', 'Nombre Municipio', 'Nombre Estado', 'Nombre País'];
						rows = data.map(item => `
							<tr>
								<td>${item.codParroquia}</td>
								<td>${item.nombreParroquia}</td>
								<td>${item.nombreMunicipio}</td>
								<td>${item.nombreEstado}</td>
								<td>${item.nombrePais}</td>
							</tr>
						`);
					} else if (option === 'Ciudades') {
						headers = ['ID', 'Nombre Ciudad', 'Nombre Parroquia', 'Nombre Municipio', 'Nombre Estado', 'Nombre País'];
						rows = data.map(item => `
							<tr>
								<td>${item.codCiudad}</td>
								<td>${item.nombreCiudad}</td>
								<td>${item.nombreParroquia}</td>
								<td>${item.nombreMunicipio}</td>
								<td>${item.nombreEstado}</td>
								<td>${item.nombrePais}</td>
							</tr>
						`);
					}

					tableHead.append(`
						<tr>
							${headers.map(header => `<th>${header}</th>`).join('')}
						</tr>
					`);

					tableBody.append(rows.join(''));
				}

				function updateHeading(option) {
					$('#selectedOption').text(option);
					$('#tableTitle').text(`Domicilio / ${option} Registrados`);
				}


			</script>
		    <!-- Optional JavaScript -->
		    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		    <script src="../../js/jquery-3.3.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		    <script src="../../js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		    <script src="../../js/bootstrap.js"></script>

<footer>
	<?php 
		require_once('./Layouts/footer.php');
	?>
</footer>
</body>

</html>









