import { fetchRequest } from "./api.js";
import { TableView } from "./table.js";
import {FIELDS_TABLES} from "./configs.js";

export async function crearTabla(section) {
    try {
        let fields = FIELDS_TABLES[section];
        let response = await fetchRequest(section);
        let tableGenerator = new TableView(fields, response.data, section);
        tableGenerator.render();
    } catch (error) {
        console.error(error);
    }
}
