import {crearTablaTerritorial} from './territorios.js'

document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        const section = e.target.dataset.section;
        crearTablaTerritorial(section);
    });
});