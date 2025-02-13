import { FIELDS_CONVERSION, FIELDS_CONFIG, FIELD_NAMES } from "./configs.js";
import { saveItem } from "./fetch.js";
export function showAddForm(section) {
    const fields = FIELDS_CONFIG[section];

    const modalTitle = document.getElementById("modalTitle");
    modalTitle.textContent = `Agregar ${section}`;  // Única interpolación necesaria
    
    const modalBody = document.getElementById("modalBody");
    modalBody.innerHTML = "";
    
    // Crear fragmento para mejor rendimiento
    const fragment = document.createDocumentFragment();
    
    fields.forEach((field) => {
        const div = document.createElement('div');
        div.className = 'mb-3';
    
        const label = document.createElement('label');
        label.className = 'form-label';
        label.textContent = FIELD_NAMES[field];
    
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.id = field;
    
        div.appendChild(label);
        div.appendChild(input);
        fragment.appendChild(div);
    });
    
    modalBody.appendChild(fragment);
    
    // Configurar botón de guardado
    const button = document.createElement("button");
    button.className = "btn btn-primary";
    button.textContent = "Guardar";
    
    // Corregido el event listener para que no se ejecute inmediatamente
    button.addEventListener("click", () => saveItem(item, section));
    
    modalBody.appendChild(button);
    
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

    // 1. Actualizar el título del modal
    document.getElementById("modalTitle").textContent = "Editar " + section;

    // 2. Crear el botón
    const saveButton = document.createElement("button");
    saveButton.className = "btn btn-primary";
    saveButton.textContent = "Guardar";
    // 3. Asignar el evento `onclick` al botón
    saveButton.onclick = function () {
        saveItem(item, section, item[FIELDS_CONVERSION[section]]); // Llamar a la función `saveItem` con el objeto `item`
    };

    // 4. Insertar el formulario y el botón en el cuerpo del modal
    const modalBody = document.getElementById("modalBody");
    modalBody.innerHTML = formHtml; // Insertar el formulario
    modalBody.appendChild(saveButton); // Agregar el botón al final

    new bootstrap.Modal(document.getElementById("formModal")).show();
}
