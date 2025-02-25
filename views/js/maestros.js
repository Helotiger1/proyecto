import { fetchRequest } from "./api.js";
import { TableView } from "./table.js";

const FIELDS = [
    "estadoCivil",
    "cargoActual",
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "sexoPersona",
    "fechaNac",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
    "nombreCiudad"
  ]
  

export async function crearTablaMaestros(section) {
    try {
        let response = await fetchRequest(section);
        let tableGenerator = new TableView(FIELDS, response.data, section);
        tableGenerator.render();
    } 
    catch(error){
        console.error(error)
    }
}
