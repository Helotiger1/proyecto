function loadLocationData(endpoint, option) {
    fetchRequest(endpoint, 'GET')
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

async function fetchRequest(endpoint, method = 'GET', body = null) {
  url = `http://localhost/proyecto${endpoint}`;
  const options = {
    method,
    headers: {
      'Content-Type': 'application/json', 
    },
  };

  if (body) {
    options.body = JSON.stringify(body);
  }

  try {
    const response = await fetch(url, options);

    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`);
    }

    return await response.json(); 
  } catch (error) {
    console.error('Fetch Error:', error.message);
    throw error; // Lanza el error para que el catch lo maneje en la llamada
  }
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
