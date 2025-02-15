import { FIELDS_CONVERSION, FIELDS_CONFIG, FIELD_NAMES } from "./configs.js";
import { saveItem } from "./fetch.js";


export function showAddForm(section) {
    const fields = FIELDS_CONFIG[section];
    const modalTitle = document.getElementById("modalTitle");
    modalTitle.textContent = `Agregar ${section}`;
    const modalBody = document.getElementById("modalBody");
    modalBody.innerHTML = "";

    
    const fragment = document.createDocumentFragment();

    fields.forEach((field) => {
        const div = document.createElement("div");
        div.className = "mb-3";

        const label = document.createElement("label");
        label.className = "form-label";
        label.textContent = FIELD_NAMES[field];

        const input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.id = field;

        div.appendChild(label);
        div.appendChild(input);
        fragment.appendChild(div);
    });

    modalBody.appendChild(fragment);

    const button = document.createElement("button");
    button.className = "btn btn-primary";
    button.textContent = "Guardar";

    button.addEventListener("click", () => saveItem(section));

    modalBody.appendChild(button);

    new bootstrap.Modal(document.getElementById("formModal")).show();
}


export function showEditForm(section, item) {
    let currentId = item[FIELDS_CONVERSION[section]];
    const fields = FIELDS_CONFIG[section];

    const fragment = document.createDocumentFragment();

    fields.forEach((field) => {
        const div = document.createElement("div");
        div.className = "mb-3";

        const label = document.createElement("label");
        label.className = "form-label";
        label.textContent = FIELD_NAMES[field] || field;

        const input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.id = field;
        input.value = item[field];

        div.appendChild(label);
        div.appendChild(input);
        fragment.appendChild(div);
    });

    document.getElementById("form-container").appendChild(fragment);

    document.getElementById("modalTitle").textContent = "Editar " + section;

    const saveButton = document.createElement("button");
    saveButton.className = "btn btn-primary";
    saveButton.textContent = "Guardar";
    saveButton.onclick = function () {
        saveItem(section, item, item[FIELDS_CONVERSION[section]]);
    };

    const modalBody = document.getElementById("modalBody");
    modalBody.innerHTML = formHtml;
    modalBody.appendChild(saveButton);

    new bootstrap.Modal(document.getElementById("formModal")).show();
}
