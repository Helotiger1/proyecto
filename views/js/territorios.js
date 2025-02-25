import { fetchRequest } from "./api.js";
import { TableView } from "./table.js";

const TERRITORIAL_TABLE = {
    paises: ["idPais", "nombrePais", "estatus"],
    estados: ["idEstado", "nombreEstado", "nombrePais"],
    municipios: [
        "idMunicipio",
        "nombreMunicipio",
        "nombreEstado",
        "nombrePais",
    ],
    parroquias: [
        "idParroquia",
        "nombreParroquia",
        "nombreMunicipio",
        "nombreEstado",
        "nombrePais",
    ],
    ciudades: [
        "idCiudad",
        "nombreCiudad",
        "nombreParroquia",
        "nombreMunicipio",
        "nombreEstado",
        "nombrePais",
    ],
};

export async function crearTablaTerritorial(section) {
    try {
        let fields = TERRITORIAL_TABLE[section];
        let response = await fetchRequest(section);
        let tableGenerator = new TableView(fields, response.data, section);
        tableGenerator.render();
    } 
    catch(error){
        console.error(error)
    }
}
