import { loadData } from "./features/domicilios/renderTable.js";

export function initEventListeners() {
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const section = e.target.dataset.section;
            loadData(section);
        });
    });
}

export function initTable(){
document.getElementById("mainContent").innerHTML = `
            <div class="table-container">
                <h4 id="tableTitle"></h4>
                <div id="loading" class="d-none">Cargando...</div>
                <table class="table table-striped" id="dataTable">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        `;
}

export function initModal(){
    const modal = `<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>
    </div>`;
    document.body.innerHTML += modal; 
}


export default initEventListeners;