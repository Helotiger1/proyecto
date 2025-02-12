import { fetchRequest, deleteItem, saveItem } from "./fetch.js";
import { showAddForm, showEditForm } from "./modalForms.js";
import { FIELDS_ALLOW, FIELD_NAMES, FIELDS_CONVERSION } from './configs.js';



function showLoading(show) {
    document.getElementById("loading").classList.toggle("d-none", !show);
}

export async function loadData(section) {
    try {
        showLoading(true);
        const response = await fetchRequest(section);
        renderTable(response.data, section);
    } catch (error) {
        console.error("Error:", error);
        document.getElementById("mainContent").innerHTML = `
            <div class="alert alert-danger">Error cargando los datos</div>
        `;
    } finally {
        showLoading(false);
    }
}

function renderTable(data, section) {
    const table = document.getElementById("dataTable");
    const thead = table.querySelector("thead");
    const tbody = table.querySelector("tbody");
    const title = document.getElementById("tableTitle");

    // Limpiar tabla
    thead.innerHTML = "";
    tbody.innerHTML = "";

    // Configurar título y botón de agregar
    title.innerHTML = `
          Tabla de ${section}
          <button class="btn btn-sm btn-success ms-3" onclick="showAddForm('${section}')">
              Agregar
          </button>
      `;

    // Obtener campos permitidos para la sección
    const allowedFields = FIELDS_ALLOW[section] || [];

    // Crear headers basados en campos permitidos
    const headerRow = document.createElement("tr");

    allowedFields.forEach((header) => {
        const th = document.createElement("th");
        th.textContent = FIELD_NAMES[header] || header;
        headerRow.appendChild(th);
    });

    // Agregar columna de acciones
    const thActions = document.createElement("th");
    thActions.textContent = "Acciones";
    headerRow.appendChild(thActions);
    thead.appendChild(headerRow);

    // Llenar datos usando campos permitidos
    data.forEach((item) => {
        const row = document.createElement("tr");
        allowedFields.forEach((header) => {
            const td = document.createElement("td");
            td.textContent = item[header];
            row.appendChild(td);
        });

        // Botones de acciones
        const tdActions = document.createElement("td");
        const mainId = FIELDS_CONVERSION[section];
        const itemId = item[mainId];

        const deleteBtn = document.createElement("button");
        deleteBtn.className = "btn btn-sm btn-danger me-2";
        deleteBtn.innerHTML = "Eliminar";
        deleteBtn.onclick = () => deleteItem(section, itemId);

        const editBtn = document.createElement("button");
        editBtn.className = "btn btn-sm btn-warning";
        editBtn.innerHTML = "Editar";
        console.log(section, item);
        editBtn.onclick = () => showEditForm(section, item);

        tdActions.appendChild(deleteBtn);
        tdActions.appendChild(editBtn);
        row.appendChild(tdActions);

        tbody.appendChild(row);
    });
}
