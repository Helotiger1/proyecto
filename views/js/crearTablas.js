import { fetchRequest } from "./api.js";
import { TableView } from "./table.js";
import {
    FIELDS_MAESTROS,
    FIELDS_REPRESENTANTES,
    FIELDS_TERRITORIOS,
    FIELDS_ESTUDIANTES,
    FIELDS_INSCRIPCIONES
} from "./configs.js";

export async function crearTabla(section) {
    try {
        let fields;

        switch (section) {
            case "paises":
            case "estados":
            case "municipios":
            case "parroquias":
            case "ciudades":
                fields = FIELDS_TERRITORIOS[section];
                break;
            case "maestros":
                fields = FIELDS_MAESTROS;
                break;
            case "representantes":
                fields = FIELDS_REPRESENTANTES;
                break;
            case "estudiantes":
                fields = FIELDS_ESTUDIANTES;
                break;
            case "inscripciones":
                fields = FIELDS_INSCRIPCIONES;
                break;
            default:
                throw new Error(`Tipo de tabla desconocido: ${section}`);
        }

        let response = await fetchRequest(section);
        let tableGenerator = new TableView(fields, response.data, section);
        tableGenerator.render();
    } catch (error) {
        console.error(error);
    }
}
