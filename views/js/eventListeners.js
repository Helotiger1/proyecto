import { loadData } from "./renderTable.js";

export function initEventListeners() {
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const section = e.target.dataset.section;
            loadData(section);
        });
    });
}
