
async function loadData(section) {
    try {
        showLoading(true);
        const data = await fetchRequest(section);
        renderTable(data.data, section);
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('mainContent').innerHTML = `
            <div class="alert alert-danger">Error cargando los datos</div>
        `;
    } finally {
        showLoading(false);
    }
}

/******************************
 * RENDERIZADO DE TABLA
 ******************************/
function renderTable(data, section) {
    const table = document.getElementById('dataTable');
    const [thead, tbody] = [table.querySelector('thead'), table.querySelector('tbody')];
    const title = document.getElementById('tableTitle');

    // Configuración inicial
    thead.innerHTML = '';
    tbody.innerHTML = '';
    
    // Configurar título
    title.innerHTML = `
        Tabla de ${capitalize(section)}
        <button class="btn btn-sm btn-success ms-3" onclick="showAddForm('${section}')">
            Agregar
        </button>
    `;

    // Crear encabezados
    const headers = Object.keys(data[0]);
    const headerRow = document.createElement('tr');
    
    headers.forEach(header => {
        const th = document.createElement('th');
        th.textContent = FIELD_NAMES[header] || header;
        headerRow.appendChild(th);
    });
    
    headerRow.innerHTML += '<th>Acciones</th>';
    thead.appendChild(headerRow);

    // Llenar filas
    data.forEach(item => {
        const row = document.createElement('tr');
        headers.forEach(header => {
            const td = document.createElement('td');
            td.textContent = item[header];
            row.appendChild(td);
        });
        
        // Botones de acciones
        const actionCell = document.createElement('td');
        const itemId = item[getSectionId(section)];
        
        actionCell.innerHTML = `
            <button class="btn btn-sm btn-danger me-2" 
                onclick="deleteItem('${section}', ${itemId})">
                Eliminar
            </button>
            <button class="btn btn-sm btn-warning" 
                onclick="showEditForm('${section}', ${JSON.stringify(item)})">
                Editar
            </button>
        `;
        
        row.appendChild(actionCell);
        tbody.appendChild(row);
    });
}

/******************************
 * FORMULARIOS MODALES
 ******************************/
let currentSection = null;
let currentItemId = null;

function showForm(section, item = null) {
    currentSection = section;
    currentItemId = item ? item[getSectionId(section)] : null;
    
    const fields = FIELDS_CONFIG[section];
    const formContent = fields.map(field => `
        <div class="mb-3">
            <label class="form-label">${FIELD_NAMES[field]}</label>
            <input type="text" class="form-control" 
                id="${field}" 
                value="${item ? item[field] : ''}">
        </div>
    `).join('');
    
    // Configurar modal
    document.getElementById('modalTitle').textContent = `
        ${item ? 'Editar' : 'Agregar'} ${capitalize(section.replace(/s$/, ''))}
    `;
    
    document.getElementById('modalBody').innerHTML = formContent + `
        <button class="btn btn-primary mt-3" onclick="saveItem()">
            ${item ? 'Actualizar' : 'Guardar'}
        </button>
    `;
    
    new bootstrap.Modal(document.getElementById('formModal')).show();
}

/******************************
 * CRUD OPERATIONS
 ******************************/
async function saveItem() {
    const fields = FIELDS_CONFIG[currentSection];
    const body = {};
    
    fields.forEach(field => {
        body[field] = document.getElementById(field).value;
    });

    try {
        const endpoint = currentItemId ? 
            `${currentSection}/${currentItemId}` : 
            currentSection;
            
        await fetchRequest(endpoint, currentItemId ? 'PUT' : 'POST', body);
        await loadData(currentSection);
        bootstrap.Modal.getInstance(document.getElementById('formModal')).hide();
    } catch (error) {
        alert('Error guardando los datos');
    }
}

async function deleteItem(section, id) {
    if (!confirm('¿Estás seguro de eliminar este registro?')) return;
    
    try {
        await fetchRequest(`${section}/${id}`, 'DELETE');
        await loadData(section);
    } catch (error) {
        alert('Error eliminando el registro');
    }
}

/******************************
 * INICIALIZACIÓN
 ******************************/
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        loadData(e.target.dataset.section);
    });
});

// Cargar datos iniciales si es necesario
// loadData('paises');