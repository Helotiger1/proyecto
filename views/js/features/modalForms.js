import {
    FIELDS_CONVERSION,
    FIELDS_CONFIG,
    FIELD_NAMES,
    FIELDS_TO_SELECT,
    FIELDS_TO_FILL,
    FIELDS_ALLOW,
} from "../../configs.js";
import { fetchRequest } from "../../api.js";


export function showAddForm(section) {
    const modalTitle = document.getElementById("modalTitle");
    modalTitle.textContent = `Agregar ${section}`;
    const modalBody = document.getElementById("modalBody");

    modalBody.innerHTML = "";

    const select_options = FIELDS_TO_SELECT?.[section] ?? [];
    const fragment = document.createDocumentFragment();

    select_options.forEach((option) => {
        const wrapper = document.createElement("div");
        const label = document.createElement("label");
        label.className = "form-label";
        label.textContent = option;

        const selectElem = document.createElement("select");
        selectElem.id = `select${option}`;
        selectElem.className = "form-select";

        const optionElem = document.createElement("option");
        optionElem.textContent = "No disponible";
        optionElem.disabled = true;

        selectElem.appendChild(optionElem);
        wrapper.appendChild(label);
        wrapper.appendChild(selectElem);
        fragment.appendChild(wrapper);
    });



    select_options && setTimeout(options('paises'), 0);

    select_options && document.body.addEventListener("change", (e) => {
        if (e.target.tagName === "SELECT") {
            handleSelectChange(e);
        }
    });

    let fields = FIELDS_TO_FILL[section];

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

    modalBody.appendChild(button);

    new bootstrap.Modal(document.getElementById("formModal")).show();
}


async function handleSelectChange(event) {
    let replacer = {
        selectpaises: 'estados',
        selectestados: 'municipios',
        selectmunicipios: 'parroquias',
    }

    const select = event.target.id;
    const selectId = event.target.value;

    const nextEndpoint = replacer[select];

    setTimeout(options(nextEndpoint, selectId));
}


const CONVERSION_KEYS = {
    paises: ['codPais', 'nombrePais'],
    estados: ['codEstado', 'nombreEstado'],
    municipios: ['codMunicipio', 'nombreMunicipio'],
    parroquias: ['codParroquia', 'nombreParroquia'],
    ciudades: ['codCiudad', 'nombreCiudad'],
};



async function options(endpoint, id = null) {
    id ? (endpoint = `${endpoint}/${id}`) : endpoint;
    const data = await fetchRequest(endpoint);
    const select = `select${endpoint}`;

    const Select = document.getElementById(select);
    if (!Select) {
        console.warn("Elemento 'select' no encontrado.");
        return;
    }

    Select.innerHTML = '';
    const fragment = document.createDocumentFragment();

    const conversion = CONVERSION_KEYS[endpoint.replace(/\/\d+$/, '')]; 

    if (!conversion) {
        console.warn(`No se encontraron claves de conversión para el endpoint: ${endpoint}`);
        return;
    }

    const [keyValue, keyText] = conversion;
    data.data.forEach(item => {
        const option = document.createElement("option");
        option.value = item[keyValue];
        option.textContent = item[keyText];
        fragment.appendChild(option);
    });

    Select.appendChild(fragment);
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

export async function saveItem(currentSection, item = null, currentId = null) {
    const fields = FIELDS_CONFIG[currentSection];
    const body = {};

    fields.forEach((field) => {
        body[field] = document.getElementById(field).value;
    });

    const method = currentId ? "PUT" : "POST";
    const endpoint = currentId
        ? `${API_ENDPOINTS[currentSection]}/${currentId}`
        : API_ENDPOINTS[currentSection];
    try {
        await fetchRequest(endpoint, method, body);
        await loadData(currentSection);
        new bootstrap.Modal(document.getElementById("formModal")).hide();
    } catch (error) {
        alert("Error guardando los datos");
    }
}

export async function deleteItem(section, id) {
    if (confirm("¿Estás seguro de eliminar este registro?")) {
        try {
            await fetchRequest(`${section}/${id}`, "DELETE");
            await loadData(section);
        } catch (error) {
            alert("Error eliminando el registro");
        }
    }
}
