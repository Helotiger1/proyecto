import {crearTablaTerritorial} from './territorios.js'
import {crearTablaMaestros} from './maestros.js'


document.querySelectorAll(".nav-maestros").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        const section = e.target.dataset.section;
        console.log("sera?");
        crearTablaMaestros(section)
    });
});


document.querySelectorAll(".nav-territorios").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        const section = e.target.dataset.section;
        crearTablaTerritorial(section);
    });
});