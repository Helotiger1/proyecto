import { fetchRequest } from "./api.js";
import { FIELD_PRIMARY_KEY, SELECT_CONFIG} from "./configs.js";

export class ModalForm {
    /**
     * @param {Object} config - Configuración del modal.
     * @param {string} config.title - Título del modal.
     * @param {Array} config.fields - Array de campos del formulario. Cada campo puede tener:
     *        { label, name, type, options, fetch, placeholder, cascade }.
     *        - "cascade": para selects en cascada. Ejemplo:
     *            { target: 'estado', apiUrl: '/api/estados?pais=', placeholder: 'Seleccione un estado' }
     *        - "fetch": para selects que se llenan desde la API. Su valor es el endpoint.
     * @param {Function} config.onSubmit - Función a ejecutar al enviar el formulario.
     * @param {Function} config.onCancel - Función a ejecutar al cancelar.
     */
    constructor({
        title = "Formulario",
        fields = [],
        onSubmit = () => {},
        onCancel = () => {},
        section = "",
    } = {}) {
        this.title = title;
        this.fields = fields;
        this.onCancel = onCancel;
        this.section = section;
        this.modal = null;
        this.form = null;
    }

    /**
     * Abre el modal, renderizándolo y luego poblándolo con selects que requieren datos de la API.
     * @param {Object} data - Datos para prellenar el formulario (opcional).
     */
    async open(data = {}) {
        this.render(data);
        document.body.appendChild(this.modal);
        // Poblamos los selects que vienen de la API (no en cascada)
        await this.populateFetchSelects(this.form);
    }

    /**
     * Renderiza la estructura del modal y crea el formulario.
     * @param {Object} data - Datos para prellenar el formulario.
     */
    render(data) {
        // Contenedor principal del modal
        this.modal = document.createElement("div");
        this.modal.className = "modal fade show";
        this.modal.style.display = "block";
        this.modal.style.backgroundColor = "rgba(0,0,0,0.5)";

        const dialog = document.createElement("div");
        dialog.className = "modal-dialog";

        const content = document.createElement("div");
        content.className = "modal-content";

        // Cabecera
        const header = document.createElement("div");
        header.className = "modal-header";
        const title = document.createElement("h5");
        title.className = "modal-title";
        title.textContent = this.title;
        const btnClose = document.createElement("button");
        btnClose.type = "button";
        btnClose.className = "btn-close";
        btnClose.addEventListener("click", () => this.close());
        header.appendChild(title);
        header.appendChild(btnClose);
        content.appendChild(header);

        // Cuerpo y formulario
        const body = document.createElement("div");
        body.className = "modal-body";
        const form = document.createElement("form");
        form.id = "modalForm";

        // Para cada campo, creamos el input/select
        this.fields.forEach((field) => {
            const formGroup = document.createElement("div");
            formGroup.className = "mb-3";

            const label = document.createElement("label");
            label.className = "form-label";
            label.textContent = field.label;
            label.setAttribute("for", field.name);

            let input;
            if (field.type === "select") {
                input = document.createElement("select");
                input.className = "form-select";
                // Si se pasan opciones fijas, se agregan
                if (field.options && Array.isArray(field.options)) {
                    field.options.forEach((opt) => {
                        const option = document.createElement("option");
                        option.value = opt;
                        option.textContent = opt;
                        input.appendChild(option);
                    });
                }
                // Si se define "fetch", se usará para llenar el select desde la API
                if (field.fetch) {
                    input.dataset.fetch = field.fetch;
                    if (field.placeholder) {
                        input.dataset.fetchPlaceholder = field.placeholder;
                    }
                }
            } else {
                input = document.createElement("input");
                input.type = field.type || "text";
                input.className = "form-control";
            }
            input.name = field.name;
            input.id = field.name;
            if (data[field.name] !== undefined) {
                input.value = data[field.name];
            }
            // Si el campo requiere funcionalidad en cascada, se guarda la configuración
            if (field.cascade) {
                input.dataset.cascade = JSON.stringify(field.cascade);
            }
            formGroup.appendChild(label);
            formGroup.appendChild(input);
            form.appendChild(formGroup);
        });
        body.appendChild(form);
        content.appendChild(body);

        // Pie: botones de cancelar y guardar
        const footer = document.createElement("div");
        footer.className = "modal-footer";
        const btnCancel = document.createElement("button");
        btnCancel.type = "button";
        btnCancel.className = "btn btn-secondary";
        btnCancel.textContent = "Cancelar";
        btnCancel.addEventListener("click", () => {
            if (typeof this.onCancel === "function") this.onCancel();
            this.close();
        });
        const btnSubmit = document.createElement("button");
        btnSubmit.type = "button";
        btnSubmit.className = "btn btn-primary";
        btnSubmit.textContent = "Guardar";
        btnSubmit.addEventListener("click", () => {
            const formData = {};
            new FormData(form).forEach((value, key) => {
                formData[key] = value;
            });
            this.onSubmit(formData, data[FIELD_PRIMARY_KEY[this.section]]);
            this.close();
        });
        footer.appendChild(btnCancel);
        footer.appendChild(btnSubmit);
        content.appendChild(footer);

        dialog.appendChild(content);
        this.modal.appendChild(dialog);

        // Guardamos una referencia al formulario para usarla en otros métodos
        this.form = form;
        // Adjuntamos listeners para los selects en cascada
        this.attachCascadeListeners(form);
    }

    /**
     * Función genérica para poblar un select a partir de un endpoint.
     * @param {HTMLSelectElement} select - El elemento select a actualizar.
     * @param {string} endpoint - La URL desde donde obtener los datos.
     * @param {string} [placeholder] - (Opcional) Texto para la opción placeholder.
     */
    async updateSelect(select, endpoint, placeholder) {
        try {
            const response = await fetchRequest(endpoint);
            // Limpiamos el contenido previo
            select.innerHTML = "";
            // Agregamos opción placeholder si se ha definido
            if (placeholder) {
                const placeholderOption = document.createElement("option");
                placeholderOption.value = "";
                placeholderOption.textContent = placeholder;
                select.appendChild(placeholderOption);
            }

            let section = endpoint.split("/")[0];
            let [value, text] = SELECT_CONFIG[section];
            response.data.forEach((item) => {
                const option = document.createElement("option");
                option.value = item[value];
                option.textContent = item[text];
                select.appendChild(option);
            });
        } catch (error) {
            console.error("Error al poblar el select:", error);
        }
    }

    /**
     * Adjunta listeners a los selects que tengan configuración en cascada.
     * Al cambiar el valor del select "origen", se actualiza el select "destino" usando updateSelect.
     * @param {HTMLElement} formElement - Elemento del formulario.
     */
    attachCascadeListeners(formElement) {
        const selects = formElement.querySelectorAll("select[data-cascade]");
        selects.forEach((select) => {
            const cascadeConfig = select.dataset.cascade;
            if (cascadeConfig) {
                const config = JSON.parse(cascadeConfig);
                select.addEventListener("change", async (event) => {
                    const targetName = config.target;
                    const targetSelect = formElement.querySelector(
                        `select[name="${targetName}"]`
                    );
                    if (targetSelect) {
                        const selectedValue = event.target.value;
                        // Construimos la URL usando el valor seleccionado
                        const apiUrl = `${config.apiUrl}${selectedValue}`;
                        await this.updateSelect(
                            targetSelect,
                            apiUrl,
                            config.placeholder
                        );
                    }
                });
            }
        });
    }

    /**
     * Población de selects que se llenan desde la API (no en cascada).
     * Busca en el formulario selects con el atributo data-fetch y los actualiza.
     * @param {HTMLElement} formElement - Elemento del formulario.
     */
    async populateFetchSelects(formElement) {
        const fetchSelects = formElement.querySelectorAll("select[data-fetch]");
        for (const select of fetchSelects) {
            const fetchEndpoint = select.dataset.fetch;
            const placeholder = select.dataset.fetchPlaceholder;
            await this.updateSelect(select, fetchEndpoint, placeholder);
        }
    }

    async onSubmit(formData, id) {
        console.log("Datos del formulario:", formData);
        let endpoint = this.section; 
        let method;

        id ? endpoint += `/${id}` : endpoint;
        id ? method = "PUT" : method = "POST";

        await fetchRequest(endpoint, method, formData);
    }

    /**
     * Cierra y elimina el modal del DOM.
     */
    close() {
        if (this.modal && this.modal.parentNode) {
            this.modal.parentNode.removeChild(this.modal);
            this.modal = null;
        }
    }
}
