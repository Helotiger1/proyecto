
const API_BASE_URL = 'http://localhost/proyecto/';
const API_ENDPOINTS = { 
    paises: 'paises',
    estados: 'estados',
    municipios: 'municipios',
    parroquias: 'parroquias',
    ciudades: 'ciudades'
};

const FIELDS_ALLOW = {
    paises: ['codPais', 'nombrePais', 'estatus'],
    estados: ['codEstado', 'nombreEstado', 'nombrePais'],
    municipios: ['codMunicipio','nombreMunicipio', 'nombreEstado', 'nombrePais'],
    parroquias: ['codParroquia', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais'],
    ciudades: ['codCiudad', 'nombreCiudad', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais']
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
    estados: ['nombreEstado', 'nombrePais'],
    municipios: ['nombreMunicipio', 'nombreEstado', 'nombrePais'],
    parroquias: ['nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais'],
    ciudades: ['nombreCiudad', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais']
};

// Función auxiliar para obtener el nombre del ID principal

const FIELDS_CONVERSION = {
    "paises": 'codPais',
    "estados": 'codEstado',
    "municipios": 'codMunicipio',
    "parroquias": 'codParroquia',
    "ciudades": 'codCiudad'
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
    
    // Obtener campos permitidos para la sección
    const allowedFields = FIELDS_ALLOW[section] || [];
    
    // Crear headers basados en campos permitidos
    const headerRow = document.createElement('tr');
    
    allowedFields.forEach(header => {
        const th = document.createElement('th');
        th.textContent = FIELD_NAMES[header] || header;
        headerRow.appendChild(th);
    });
    
    // Agregar columna de acciones
    const thActions = document.createElement('th');
    thActions.textContent = 'Acciones';
    headerRow.appendChild(thActions);
    thead.appendChild(headerRow);
    
    // Llenar datos usando campos permitidos
    data.forEach(item => {
        const row = document.createElement('tr');
        allowedFields.forEach(header => {
            const td = document.createElement('td');
            td.textContent = item[header];
            row.appendChild(td);
        });
        
        // Botones de acciones
        const tdActions = document.createElement('td');
        const mainId = FIELDS_CONVERSION[section];
        const itemId = item[mainId];
  
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn btn-sm btn-danger me-2';
        deleteBtn.innerHTML = 'Eliminar';
        deleteBtn.onclick = () => deleteItem(section, itemId);
  
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

let currentSection = null;
let currentId = null;

// Mostrar formulario de agregar
function showAddForm(section) {
currentSection = section;
currentId = null;
const fields = FIELDS_CONFIG[section];

const formHtml = fields.map(field => `
    <div class="mb-3">
        <label class="form-label">${FIELD_NAMES[field]}</label>
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

currentId = item[FIELDS_CONVERSION[section]];
const fields = FIELDS_CONFIG[section];

const formHtml = fields.map(field => `
    <div class="mb-3">
        <label class="form-label">${FIELD_NAMES[field] || field}</label>
        <input type="text" class="form-control" id="${field}" value="${item[field]}">
    </div>
`).join('');

document.getElementById('modalTitle').textContent = `Editar ${section.slice(0, -1)}`;
document.getElementById('modalBody').innerHTML = formHtml + `
    <button class="btn btn-primary" onclick="saveItem(${JSON.stringify(item).replace(/"/g, '&quot;')})">Guardar</button>
`;

new bootstrap.Modal(document.getElementById('formModal')).show();
}

// Guardar ítem (crear o actualizar)
async function saveItem(item = null) {
const fields = FIELDS_CONFIG[currentSection];
const body = {};


fields.forEach(field => {
    body[field] = document.getElementById(field).value;
});

console.log(body)

const method = currentId ? 'PUT' : 'POST';
const endpoint = currentId ? 
    `${API_ENDPOINTS[currentSection]}/${currentId}` : 
    API_ENDPOINTS[currentSection];
try {
    await fetchMultiple(item, method, currentSection, body);
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


// Event listeners para los enlaces
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', (e) => {
      e.preventDefault();
      const section = e.target.dataset.section;
      loadData(section);
  });
});