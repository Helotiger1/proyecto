/* ---CONFIGURACIONES DE API--- */

export const API_CONFIG = {
paises : ["nombrePais", "estatus"],
estados : ["nombreEstado", "paises_idPais"],
municipios : ["nombreMunicipio", "estados_idEstado"],
parroquias : ["nombreParroquia", "municipios_idMunicipio"],
ciudades : ["nombreCiudad", "parroquias_idParroquia"],

}


/* ---CONFIGURACIONES DE SELECTS--- */
export const SELECT_CONFIG = {
    paises: ["idPais", "nombrePais"],
    estados: ["idEstado", "nombreEstado"],
    municipios: ["idMunicipio", "nombreMunicipio"],
    parroquias: ["idParroquia", "nombreParroquia"],
    ciudades: ["idCiudad", "nombreCiudad"],
    maestros: ["idMaestros", "nombrePersona"],
    representantes: ["idRepresentante", "nombrePersona"],
    estudiantes: ["idEstudiante", "nombrePersona"],
    inscripciones: ["idInscripciones", "nombrePersona"]
};



/* ---CONFIGURACIONES DE MODALES TERRITORIALES--- */
import { fetchRequest } from "./api.js";

const MODAL_PAISES = {
    title: "Agregar País",
    fields: [
        { label: "Nombre del País", name: "nombrePais", type: "text" },
        { label: "Estatus", name: "estatus", type: "text" },
    ],
    section: "paises",
};

const MODAL_ESTADOS = {
    title: "Agregar Estado",
    fields: [
        {
            label: "País",
            name: "paises_idPais",
            type: "select",
            fetch: "paises",
            placeholder: "Seleccione un país",
        },
        { label: "Nombre del Estado", name: "nombreEstado", type: "text" },
    ],
    section: "estados",
};

const MODAL_MUNICIPIOS = {
    title: "Agregar Municipio",
    fields: [
        {
            label: "País",
            name: "paises_idPais",
            type: "select",
            fetch: "paises",
            placeholder: "Seleccione un país",
            cascade : {
                target: "estados_idEstado",
                apiUrl: "estados/",
                placeholder: "Seleccione un estado",
            }
        },
        {
            label: "estado",
            name: "estados_idEstado",
            type: "select",
        },
        { label: "Nombre del Municipio", name: "nombreMunicipio", type: "text"},
    ],
    section: "municipios",
};

const MODAL_PARROQUIAS = {
    title: "Agregar Parroquia",
    fields: [
        {
            label: "País",
            name: "paises_idPais",
            type: "select",
            fetch: "paises",
            placeholder: "Seleccione un país",
            cascade : {
                target: "estados_idEstado",
                apiUrl: "estados/",
                placeholder: "Seleccione un estado",
            }
        },
        {
            label: "estado",
            name: "estados_idEstado",
            type: "select",
            cascade : {
                target: "municipios_idMunicipio",
                apiUrl: "municipios/",
                placeholder: "Seleccione un municipio",
            }
        },
        { label: "municipio",
            name: "municipios_idMunicipio",
            type: "select",
        },
        { label: "Nombre de la Parroquia", name: "nombreParroquia", type: "text"},
    ],
    section: "parroquias",
};

const MODAL_CIUDADES = {
    title: "Agregar Municipio",
    fields: [
        {
            label: "País",
            name: "paises_idPais",
            type: "select",
            fetch: "paises",
            placeholder: "Seleccione un país",
            cascade : {
                target: "estados_idEstado",
                apiUrl: "estados/",
                placeholder: "Seleccione un estado",
            }
        },
        {
            label: "estado",
            name: "estados_idEstado",
            type: "select",
            cascade : {
                target: "municipios_idMunicipio",
                apiUrl: "municipios/",
                placeholder: "Seleccione un municipio",
            }
        },
        {
            label: "municipio",
            name: "municipios_idMunicipio",
            type: "select",
            cascade : {
                target: "parroquias_idParroquia",
                apiUrl: "parroquias/",
                placeholder: "Seleccione una parroquia",
            }
        },
        { label: "parroquias",
            name: "parroquias_idParroquia",
            type: "select",
        },
        { label: "Nombre de la Ciudad", name: "nombreCiudad", type: "text"},
    ],
    section: "ciudades",
};

const CIUDAD_INYECTION = [
    {
        label: "País",
        name: "paises_idPais",
        type: "select",
        fetch: "paises",
        placeholder: "Seleccione un país",
        cascade : {
            target: "estados_idEstado",
            apiUrl: "estados/",
            placeholder: "Seleccione un estado",
        }
    },
    {
        label: "estado",
        name: "estados_idEstado",
        type: "select",
        cascade : {
            target: "municipios_idMunicipio",
            apiUrl: "municipios/",
            placeholder: "Seleccione un municipio",
        }
    },
    {
        label: "municipio",
        name: "municipios_idMunicipio",
        type: "select",
        cascade : {
            target: "parroquias_idParroquia",
            apiUrl: "parroquias/",
            placeholder: "Seleccione una parroquia",
        }
    },
    {
        label: "parroquia",
        name: "parroquias_idParroquia",
        type: "select",
        cascade : {
            target: "ciudades_idCiudad",
            apiUrl: "ciudades/",
            placeholder: "Seleccione una Ciudad",
        }
    },
    { label: "Ciudades",
        name: "ciudades_idCiudad",
        type: "select",
    },
]



/*-----CONFIGURACIONES DE MODALES PERSONALES--- */

const MODAL_MAESTROS = {
    title: "Agregar Maestro",
    fields: [
        { label: "Nombre", name: "nombrePersona", type: "text" },
        { label: "Apellido", name: "apellidoPersona", type: "text" },
        { label: "Cédula", name: "cedulaPersona", type: "text" },
        { label: "Cargo Actual", name: "cargoActual", type: "text" },
        { label: "Estado Civil", name: "estadoCivil", type: "select", options: ["Soltero", "Casado", "Divorciado", "Viudo"] },
        { label: "Sexo", name: "sexoPersona", type: "select", options: ["Masculino", "Femenino", "Otro"] },
        { label: "Fecha de Nacimiento", name: "fechaNac", type: "date" },
        ...CIUDAD_INYECTION,
        {
            label: "Teléfono Principal",
            name: "telefonoPrincipal",
            type: "text",
        },
        {
            label: "Teléfono Secundario",
            name: "telefonoSecundario",
            type: "text",
        },
        { label: "Correo Principal", name: "emailPrincipal", type: "text" },
        { label: "Correo Secundario", name: "emailSecundario", type: "text" },
        {
            label: "Rol",
            name: "rol",
            type: "select",
            options: [
                { value: "admin", text: "Administrador" },
                { value: "user", text: "Usuario" },
            ],
        },
    ],
};

const MODAL_REPRESENTANTES = {
    title: "Agregar Representante",
    fields: [
        { label: "Nombre", name: "nombrePersona", type: "text" },
        { label: "Apellido", name: "apellidoPersona", type: "text" },
        { label: "Cédula", name: "cedulaPersona", type: "text" },
        { label: "Estado Civil", name: "estadoCivil", type: "text" },
        { label: "Parentesco", name: "parentesco", type: "text" },
        { label: "Fecha de Nacimiento", name: "fechaNac", type: "date" },
        { label: "Sexo", name: "sexoPersona", type: "text" },
        {
            label: "Teléfono Principal",
            name: "telefonoPrincipal",
            type: "text",
        },
        {
            label: "Teléfono Secundario",
            name: "telefonoSecundario",
            type: "text",
        },
        { label: "Correo Principal", name: "emailPrincipal", type: "text" },
        { label: "Correo Secundario", name: "emailSecundario", type: "text" },
        { label: "Ciudad", name: "nombreCiudad", type: "text" },
        { label: "Estado", name: "status", type: "text" },
    ],
};

const MODAL_ESTUDIANTES = {
    title: "Agregar Estudiante",
    fields: [
        { label: "ID Estudiante", name: "idEstudiante", type: "text" },
        { label: "Nombre", name: "nombrePersona", type: "text" },
        { label: "Apellido", name: "apellidoPersona", type: "text" },
        { label: "Cédula", name: "cedulaPersona", type: "text" },
        {
            label: "Nombre del Representante",
            name: "nombreRepresentante",
            type: "text",
        },
        { label: "Sexo", name: "sexoPersona", type: "text" },
        { label: "Ciudad", name: "nombreCiudad", type: "text" },
        {
            label: "Teléfono Principal",
            name: "telefonoPrincipal",
            type: "text",
        },
        {
            label: "Teléfono Secundario",
            name: "telefonoSecundario",
            type: "text",
        },
        { label: "Correo Principal", name: "emailPrincipal", type: "text" },
        { label: "Correo Secundario", name: "emailSecundario", type: "text" },
        { label: "Fecha de Nacimiento", name: "fechaNac", type: "date" },
        { label: "Enfermedades", name: "enfermedades", type: "text" },
        { label: "Alergias", name: "alergias", type: "text" },
        { label: "Estatura", name: "estatura", type: "text" },
        { label: "Peso", name: "peso", type: "text" },
        { label: "Talla de Calzado", name: "tallaCalzado", type: "text" },
        { label: "Talla de Pantalón", name: "tallaPantalon", type: "text" },
        { label: "Estado", name: "status", type: "text" },
    ],
};

const MODAL_INSCRIPCIONES = {
    title: "Agregar Inscripción",
    fields: [
        { label: "Calificaciones", name: "calificaciones", type: "text" },
        {
            label: "Fecha de Inscripción",
            name: "fechaInscripcion",
            type: "date",
        },
        { label: "Rango del semestre", name: "rango", type: "text" },
        { label: "Nombre", name: "nombrePersona", type: "text" },
        { label: "Apellido", name: "apellidoPersona", type: "text" },
        { label: "Cédula", name: "cedulaPersona", type: "text" },
    ],
};









/* ---CONFIGURACIONES DE TABLAS TERRITORIALES--- */

const FIELDS_PAISES = ["idPais", "nombrePais", "estatus"];
const FIELDS_ESTADOS = ["idEstado", "nombreEstado", "nombrePais"];
const FIELDS_MUNICIPIOS = [
    "idMunicipio",
    "nombreMunicipio",
    "nombreEstado",
    "nombrePais",
];
const FIELDS_PARROQUIAS = [
    "idParroquia",
    "nombreParroquia",
    "nombreMunicipio",
    "nombreEstado",
    "nombrePais",
];
const FIELDS_CIUDADES = [
    "idCiudad",
    "nombreCiudad",
    "nombreParroquia",
    "nombreMunicipio",
    "nombreEstado",
    "nombrePais",
];





/*---CONFIGURACIONES DE TABLAS PERSONALES--- */
const FIELDS_MAESTROS = [
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "cargoActual",
    "estadoCivil",
    "sexoPersona",
    "fechaNac",
    "nombreCiudad",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
];
const FIELDS_REPRESENTANTES = [
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "estadoCivil",
    "parentesco",
    "fechaNac",
    "sexoPersona",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
    "nombreCiudad",
    "status",
];
const FIELDS_ESTUDIANTES = [
    "idEstudiante",
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "nombreRepresentante",
    "sexoPersona",
    "nombreCiudad",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
    "fechaNac",
    "enfermedades",
    "alergias",
    "estatura",
    "peso",
    "tallaCalzado",
    "tallaPantalon",
    "status",
];
const FIELDS_INSCRIPCIONES = [
    "calificaciones",
    "fechaInscripcion",
    "rango",
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
];

/* ---AUXILIARES--- */

export const FIELD_PRIMARY_KEY = {
    paises: "idPais",
    estados: "idEstado",
    municipios: "idMunicipio",
    parroquias: "idParroquia",
    ciudades: "idCiudad",
    maestros: "idMaestros",
    representantes: "idRepresentante",
    estudiantes: "idEstudiantes",
    inscripciones: "idInscripciones",
};

export const FIELD_HEADERS = {
    nombrePersona: "Nombre",
    apellidoPersona: "Apellido",
    cedulaPersona: "Cédula",
    estadoCivil: "Estado Civil",
    parentesco: "Parentesco",
    fechaNac: "Fecha de Nacimiento",
    sexoPersona: "Sexo",
    telefonoPrincipal: "Teléfono Principal",
    telefonoSecundario: "Teléfono Secundario",
    emailPrincipal: "Correo Principal",
    emailSecundario: "Correo Secundario",
    nombreCiudad: "Ciudad",
    status: "Estado",
    idEstudiante: "ID Estudiante",
    nombreRepresentante: "Nombre del Representante",
    enfermedades: "Enfermedades",
    alergias: "Alergias",
    estatura: "Estatura",
    peso: "Peso",
    tallaCalzado: "Talla de Calzado",
    tallaPantalon: "Talla de Pantalón",
    idPais: "ID País",
    nombrePais: "Nombre del País",
    estatus: "Estatus",
    idEstado: "ID Estado",
    nombreEstado: "Nombre del Estado",
    idMunicipio: "ID Municipio",
    nombreMunicipio: "Nombre del Municipio",
    idParroquia: "ID Parroquia",
    nombreParroquia: "Nombre de la Parroquia",
    idCiudad: "ID Ciudad",
    cargoActual: "Cargo Actual",
    calificaciones: "Calificaciones",
    fechaInscripcion: "Fecha de Inscripción",
    rango: "Rango del semestre",
};

/* ---CONFIGURACIONES GENERALES--- */
export const FIELDS_TABLES = {
    paises: FIELDS_PAISES,
    estados: FIELDS_ESTADOS,
    municipios: FIELDS_MUNICIPIOS,
    parroquias: FIELDS_PARROQUIAS,
    ciudades: FIELDS_CIUDADES,
    maestros: FIELDS_MAESTROS,
    representantes: FIELDS_REPRESENTANTES,
    estudiantes: FIELDS_ESTUDIANTES,
    inscripciones: FIELDS_INSCRIPCIONES,
};

export const MODAL_CONFIGS = {
    maestros: MODAL_MAESTROS,
    paises: MODAL_PAISES,
    estados: MODAL_ESTADOS,
    municipios: MODAL_MUNICIPIOS,
    parroquias: MODAL_PARROQUIAS,
    ciudades: MODAL_CIUDADES,
    representantes: MODAL_REPRESENTANTES,
    estudiantes: MODAL_ESTUDIANTES,
    inscripciones: MODAL_INSCRIPCIONES,
};
