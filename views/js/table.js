import { fetchRequest } from "./api.js";
import { FIELD_HEADERS, FIELD_PRIMARY_KEY, MODAL_CONFIGS } from "./configs.js";
import { ModalForm } from "./modals.js";

export class TableView {
    constructor(columns, data, section) {
        this.container = document.getElementById("mainContent");
        if (!this.container) throw new Error("Contenedor no encontrado");
        this.columns = columns;
        this.data = data;
        this.options = { actions: ["Modificar", "Eliminar"], addButton: true };
        this.section = section;
    }

    render() {
        this.container.innerHTML = "";
        this.container.className = "table-responsive flex-grow-1 p-3";

        const h2 = document.createElement("h2");
        h2.textContent = `Tabla de ${this.section}`;
        h2.className = "text-primary my-1 fw-bold text-dark";
        this.container.appendChild(h2);

        const btnAgregar = document.createElement("button");
        btnAgregar.textContent = "Agregar";
        btnAgregar.className = "btn btn-sm btn-primary mb-3 p-1 m-2";
        btnAgregar.setAttribute("id", "btnAgregar");
        btnAgregar.onclick = () => mostrarFormulario(this.section);
        this.container.appendChild(btnAgregar);

        const table = document.createElement("table");
        table.className = "table table-striped table-bordered table-hover";

        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");

        this.columns.forEach((col) => {
            const th = document.createElement("th");
            th.textContent = FIELD_HEADERS[col];
            headerRow.appendChild(th);
        });

        if (this.options.actions && this.options.actions.length > 0) {
            const th = document.createElement("th");
            th.textContent = "Acciones";
            headerRow.appendChild(th);
        }

        thead.appendChild(headerRow);
        table.appendChild(thead);

        const tbody = document.createElement("tbody");
        this.data.forEach((item) => {
            const row = document.createElement("tr");
            this.columns.forEach((col) => {
                const td = document.createElement("td");
                td.textContent = item[col];
                row.appendChild(td);
            });

            if (this.options.actions && this.options.actions.length > 0) {
                const td = document.createElement("td");
                this.options.actions.forEach((action) => {
                    const btn = document.createElement("button");
                    btn.textContent =
                        action.charAt(0).toUpperCase() + action.slice(1);
                    btn.className = `${
                        action === "Eliminar"
                            ? "btn btn-sm btn-danger me-2"
                            : "btn btn-sm btn-warning"
                    } m-1`;
                    btn.onclick = () =>
                        action === "Eliminar"
                            ? eliminarElemento(
                                  this.section,
                                  item[FIELD_PRIMARY_KEY[this.section]]
                              )
                            : mostrarFormulario(this.section, item);
                    btn.setAttribute("data-id", item.id);
                    btn.setAttribute("data-action", action);
                    td.appendChild(btn);
                });
                row.appendChild(td);
            }
            tbody.appendChild(row);
        });
        table.appendChild(tbody);

        this.container.appendChild(table);
    }
}

function mostrarFormulario(section, item = {}) {
  try {
    let config = MODAL_CONFIGS[section];
    let modalGenerator = new ModalForm(config);
    modalGenerator.open(item);
  } catch (error) {
    console.error("Error capturado:", error);
    console.log(section);
  }
}

async function eliminarElemento(section, id) {
    let endpoint = `${section}/${id}`;
    await fetchRequest(endpoint, "DELETE");
}
