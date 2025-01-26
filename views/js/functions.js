async function fetchRequest(endpoint, method = 'GET', body = null) {
  let url = `http://localhost/proyecto/${endpoint}`;
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
    throw error; 
  }
}

// Mapeo de campos para los títulos de las tablas
const FIELD_NAMES = {
  codPais: 'Código',
  nombrePais: 'País',
  estatus: 'Estatus',
  codEstado: 'Código',
  nombreEstado: 'Estado',
  codMunicipio: 'Código',
  nombreMunicipio: 'Municipio',
  codParroquia: 'Código',
  nombreParroquia: 'Parroquia',
  codCiudad: 'Código',
  nombreCiudad: 'Ciudad'
};




async function loadData(section) {
  try {
      showLoading(true);
  endpoint = section;
  method = "GET";
  let datos = await fetchRequest(endpoint, method);
  entidades = {[section] : datos}
  const data = entidades[section].data;
  renderTable(data, section);
  } catch (error) {
      console.error('Error:', error);
      mainContent.innerHTML = `<div class="alert alert-danger">Error cargando los datos</div>`;
  } finally {
      showLoading(false);
  }
}

function renderTable(data, section) {
const table = document.getElementById('dataTable');
const thead = table.querySelector('thead');
const tbody = table.querySelector('tbody');
const title = document.getElementById('tableTitle');

// Limpiar tabla
thead.innerHTML = '';
tbody.innerHTML = '';

// Configurar título y botón de agregar
title.innerHTML = `
    Tabla de ${section.charAt(0).toUpperCase() + section.slice(1)}
    <button class="btn btn-sm btn-success ms-3" onclick="showAddForm('${section}')">
        Agregar
    </button>
`;

// Crear headers + acciones
const headers = Object.keys(data[0]);
const headerRow = document.createElement('tr');

headers.forEach(header => {
    const th = document.createElement('th');
    th.textContent = FIELD_NAMES[header] || header;
    headerRow.appendChild(th);
});

// Agregar columna de acciones
const thActions = document.createElement('th');
thActions.textContent = 'Acciones';
headerRow.appendChild(thActions);
thead.appendChild(headerRow);

// Llenar datos
data.forEach(item => {
    const row = document.createElement('tr');
    headers.forEach(header => {
        const td = document.createElement('td');
        td.textContent = item[header];
        row.appendChild(td);
    });
    
    // Botones de acciones
    const tdActions = document.createElement('td');
    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'btn btn-sm btn-danger me-2';
    deleteBtn.innerHTML = 'Eliminar';
    deleteBtn.onclick = () => deleteItem(section, item[`cod${capitalize(section.slice(0, -1))}`]);
    
    const editBtn = document.createElement('button');
    editBtn.className = 'btn btn-sm btn-warning';
    editBtn.innerHTML = 'Editar';
    editBtn.onclick = () => showEditForm(section, item);
    
    tdActions.appendChild(deleteBtn);
    tdActions.appendChild(editBtn);
    row.appendChild(tdActions);
    
    tbody.appendChild(row);
});
}


function showLoading(show) {
  document.getElementById('loading').classList.toggle('d-none', !show);
}

// Event listeners para los enlaces
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', (e) => {
      e.preventDefault();
      const section = e.target.dataset.section;
      loadData(section);
  });
});


const FIELDS_CONFIG = {
paises: ['nombrePais', 'estatus'],
estados: ['nombreEstado', 'nombrePais'],
municipios: ['nombreMunicipio', 'nombreEstado'],
parroquias: ['nombreParroquia', 'nombreMunicipio'],
ciudades: ['nombreCiudad', 'nombreParroquia']
};

let currentSection = null;
let currentId = null;

// Funciones auxiliares
function capitalize(str) {
return str.charAt(0).toUpperCase() + str.slice(1);
}

// Mostrar formulario de agregar
function showAddForm(section) {
currentSection = section;
currentId = null;
const fields = FIELDS_CONFIG[section];

const formHtml = fields.map(field => `
    <div class="mb-3">
        <label class="form-label">${FIELD_NAMES[field] || field}</label>
        <input type="text" class="form-control" id="${field}">
    </div>
`).join('');

document.getElementById('modalTitle').textContent = `Agregar ${section.slice(0, -1)}`;
document.getElementById('modalBody').innerHTML = formHtml + `
    <button class="btn btn-primary" onclick="saveItem()">Guardar</button>
`;

new bootstrap.Modal(document.getElementById('formModal')).show();
}

// Mostrar formulario de editar
function showEditForm(section, item) {
currentSection = section;
currentId = item[`cod${capitalize(section.slice(0, -1))}`];
const fields = FIELDS_CONFIG[section];

const formHtml = fields.map(field => `
    <div class="mb-3">
        <label class="form-label">${FIELD_NAMES[field] || field}</label>
        <input type="text" class="form-control" id="${field}" value="${item[field]}">
    </div>
`).join('');

document.getElementById('modalTitle').textContent = `Editar ${section.slice(0, -1)}`;
document.getElementById('modalBody').innerHTML = formHtml + `
    <button class="btn btn-primary" onclick="saveItem()">Guardar</button>
`;

new bootstrap.Modal(document.getElementById('formModal')).show();
}

// Guardar ítem (crear o actualizar)
async function saveItem() {
const fields = FIELDS_CONFIG[currentSection];
const body = {};

fields.forEach(field => {
    body[field] = document.getElementById(field).value;
});

const method = currentId ? 'PUT' : 'POST';
const endpoint = currentId ? 
    `${API_ENDPOINTS[currentSection]}/${currentId}` : 
    API_ENDPOINTS[currentSection];

try {
    await FetchRequest(endpoint, method, body);
    await loadData(currentSection);
    new bootstrap.Modal(document.getElementById('formModal')).hide();
} catch (error) {
    alert('Error guardando los datos');
}
}

// Eliminar ítem
async function deleteItem(section, id) {
if (confirm('¿Estás seguro de eliminar este registro?')) {
    try {
        await fetchRequest(`${section}/${id}`, 'DELETE');
        await loadData(section);
    } catch (error) {
        alert('Error eliminando el registro');
    }
}
}

// Actualizar FIELD_NAMES con todos los campos
FIELD_NAMES.codCiudad = 'Código Ciudad';