/******************************
 * CONSTANTES Y CONFIGURACIONES
 ******************************/
const API_BASE_URL = 'http://localhost/proyecto/';
const API_ENDPOINTS = { // Agregado para claridad
    paises: 'paises',
    estados: 'estados',
    municipios: 'municipios',
    parroquias: 'parroquias',
    ciudades: 'ciudades'
};

const FIELD_NAMES = {
    codPais: 'Código País',
    nombrePais: 'País',
    estatus: 'Estatus',
    codEstado: 'Código Estado',
    nombreEstado: 'Estado',
    codMunicipio: 'Código Municipio',
    nombreMunicipio: 'Municipio',
    codParroquia: 'Código Parroquia',
    nombreParroquia: 'Parroquia',
    codCiudad: 'Código Ciudad',
    nombreCiudad: 'Ciudad'
};

const FIELDS_CONFIG = {
    paises: ['nombrePais', 'estatus'],
    estados: ['nombreEstado', 'codPais'],
    municipios: ['nombreMunicipio', 'codEstado'],
    parroquias: ['nombreParroquia', 'codMunicipio'],
    ciudades: ['nombreCiudad', 'codParroquia']
};

/******************************
 * FUNCIONES DE API
 ******************************/
async function fetchRequest(endpoint, method = 'GET', body = null) {
    const url = API_BASE_URL + endpoint;
    const options = {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: body ? JSON.stringify(body) : null
    };

    try {
        const response = await fetch(url, options);
        if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
        return await response.json();
    } catch (error) {
        console.error('Fetch Error:', error.message);
        throw error;
    }
}

/******************************
 * FUNCIONES DE INTERFAZ
 ******************************/
function showLoading(show) {
  document.getElementById('loading').classList.toggle('d-none', !show);
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function getSectionId(section) {
  return `cod${capitalize(section.replace(/s$/, ''))}`; // Corregido para singular correcto
}






















async function loadData(section) {
  try {
      showLoading(true);
      const response = await fetchRequest(section);
      renderTable(response.data, section);
  } catch (error) {
      console.error('Error:', error);
      document.getElementById('mainContent').innerHTML = `
          <div class="alert alert-danger">Error cargando los datos</div>
      `;
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


// Event listeners para los enlaces
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', (e) => {
      e.preventDefault();
      const section = e.target.dataset.section;
      loadData(section);
  });
});

let currentSection = null;
let currentId = null;

// Funciones auxiliares


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

document.getElementById('modalTitle').textContent = `Agregar ${section}`;
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