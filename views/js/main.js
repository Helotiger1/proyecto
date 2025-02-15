import { initEventListeners } from "./eventListeners.js";
import { initModal, initTable } from "./init.js";

document.addEventListener("DOMContentLoaded", () => {
    initTable();
    initModal();
    initEventListeners();
});


