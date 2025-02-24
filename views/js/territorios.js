import { fetchRequest } from "./api.js";
import { TableView } from "./table.js";

const TERRITORIAL_TABLE = {
    paises: ["codPais", "nombrePais", "estatus"],
    estados: ["codEstado", "nombreEstado", "nombrePais"],
    municipios: [
        "codMunicipio",
        "nombreMunicipio",
        "nombreEstado",
        "nombrePais",
    ],
    parroquias: [
        "codParroquia",
        "nombreParroquia",
        "nombreMunicipio",
        "nombreEstado",
        "nombrePais",
    ],
    ciudades: [
        "codCiudad",
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
        console.log(fields);
        let response = await fetchRequest(section);
        let options = {
            actions: ["Modificar", "Eliminar"],
        };

        let tableGenerator = new TableView(fields, response.data, options);
        tableGenerator.render();
    } 
    catch(error){
        console.error("nose papi, resuelve el peo", section, fields, response, options)
    }
}
