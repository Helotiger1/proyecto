import { FIELDS_CONVERSION, FIELDS_CONFIG,FIELD_NAMES } from "./configs.js";

export function showAddForm(section) {
    currentSection = section;
    const fields = FIELDS_CONFIG[section];

    const formHtml = fields
        .map(
            (field) => `
        <div class="mb-3">
            <label class="form-label">${FIELD_NAMES[field]}</label>
            <input type="text" class="form-control" id="${field}">
        </div>
    `
        )
        .join("");

    document.getElementById("modalTitle").textContent = `Agregar ${section}`;
    document.getElementById("modalBody").innerHTML =
        formHtml +
        `
        <button class="btn btn-primary" onclick="saveItem()">Guardar</button>
    `;

    new bootstrap.Modal(document.getElementById("formModal")).show();
}

// Mostrar formulario de editar
export function showEditForm(section, item) {
    console.log("showEditForm", section, item);
    let currentId = item[FIELDS_CONVERSION[section]];
    const fields = FIELDS_CONFIG[section];

    const formHtml = fields
        .map(
            (field) => `
        <div class="mb-3">
            <label class="form-label">${FIELD_NAMES[field] || field}</label>
            <input type="text" class="form-control" id="${field}" value="${
                item[field]
            }">
        </div>
    `
        )
        .join("");

    document.getElementById("modalTitle").textContent = `Editar ${section}`;
    document.getElementById("modalBody").innerHTML =
        formHtml +
        `
        <button class="btn btn-primary" onclick="saveItem(${JSON.stringify(
            item
        ).replace(/"/g, "&quot;")})">Guardar</button>
    `;

    new bootstrap.Modal(document.getElementById("formModal")).show();
}
