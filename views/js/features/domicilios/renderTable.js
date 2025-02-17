import { fetchRequest, deleteItem } from "../fetch.js";
import { showAddForm, showEditForm } from "./modalForms.js";
import { FIELDS_ALLOW, FIELD_NAMES, FIELDS_CONVERSION } from "../../configs.js";

function showLoading(show) {
    document.getElementById("loading").classList.toggle("d-none", !show);
}

export async function loadData(section) {

    try {
        showLoading(true);
        const response = await fetchRequest(section);
        renderTable(response.data, section);
    } 
    catch (error) {
        let errorHtml = `<div class="alert alert-danger">Error cargando los datos</div>`
        console.error("Error:", error);
        document.getElementById("mainContent").innerHTML = errorHtml;
    } 
    finally {
        showLoading(false);
    }
    
}

function renderTable(data, section) {
    const table = document.getElementById("dataTable");
    const title = document.getElementById("tableTitle");
    const thead = table.querySelector("thead");
    const tbody = table.querySelector("tbody");

    thead.innerHTML = "";
    tbody.innerHTML = "";
    title.innerHTML = ""; 

    const titleText = document.createTextNode(`Tabla de ${section}`);

    const button = document.createElement("button");
    button.className = "btn btn-sm btn-success ms-3";
    button.textContent = "Agregar";
    button.onclick = () => showAddForm(section);

    title.appendChild(titleText);
    title.appendChild(button);

    const allowedFields = FIELDS_ALLOW[section] || [];
    const headerRow = document.createElement("tr");

    allowedFields.forEach((header) => {
        const th = document.createElement("th");
        th.textContent = FIELD_NAMES[header] || header;
        headerRow.appendChild(th);
    });

    const thActions = document.createElement("th");
    thActions.textContent = "Acciones";
    headerRow.appendChild(thActions);

    thead.appendChild(headerRow);


    data.forEach((item) => {
        const row = document.createElement("tr");
        allowedFields.forEach((header) => {
            const td = document.createElement("td");
            td.textContent = item[header];
            row.appendChild(td);
        });

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
        editBtn.onclick = () => showEditForm(section, item);

        tdActions.appendChild(deleteBtn);
        tdActions.appendChild(editBtn);
        row.appendChild(tdActions);
        tbody.appendChild(row);
    });
}
