<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/bootstrap.min.css";>   
	<title>Sistema</title>
	<link rel="stylesheet" href="../../css/navbar.css";>  
  <link rel="stylesheet" href="../../css/menu_submenu.css";>
  <link rel="stylesheet" type="text/css" href="../../css/datatables.min.css" />
  <link rel="icon" type="image/png" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
  <link rel="shortcut icon" href="..\..\imagenes\LogoPaginaTelemedicina.gif">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script type="text/javascript" src="../../js/datatables.min.js"></script>
  <script type="text/javascript" src="../../js/datatable.js"></script>
  <script src="../../js/jquery.min.js"></script>
  </head>

<body>
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
			    fetch(`http://localhost/proyecto${endpoint}`, {
			        method: 'GET',
			    })
			    .then(response => {
			        if (!response.ok) {
			            throw new Error(`Error fetching data from ${endpoint}: ${response.statusText}`);
			        }
			        return response.json();
			    })
			    .then(response => {
			        if (response.data && Array.isArray(response.data)) {
			            updateTable(response.data, option);
			            updateHeading(option);
			        } else {
			            console.error('Expected an array in response.data but got:', response);
			        }
			    })
			    .catch(error => {
			        console.error('Fetch error:', error);
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

<footer>
	<?php 
		require_once('./Layouts/footer.php');
	?>
</footer>
</body>

</html>









