import { crearTabla } from "./crearTablas.js";
const navConfigs = [
    ".nav-representantes",
    ".nav-maestros",
    ".nav-territorios",
    ".nav-estudiantes",
    ".nav-inscripciones"
];

navConfigs.forEach((selector) => {
    document.querySelectorAll(selector).forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const section = e.target.dataset.section;
            crearTabla(section);
        });
    });
});
