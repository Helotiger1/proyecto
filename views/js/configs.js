export const FIELDS_REPRESENTANTES = [
    "estadoCivil",
    "parentesco",
    "status",
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "sexoPersona",
    "fechaNac",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
    "nombreCiudad",
];

export const FIELDS_ESTUDIANTES = [
    "alergias",
    "enfermedades",
    "estatura",
    "peso",
    "tallaCalzado",
    "tallaPantalon",
    "status",
    "nombrePersona",
    "apellidoPersona",
    "cedulaPersona",
    "sexoPersona",
    "fechaNac",
    "telefonoPrincipal",
    "telefonoSecundario",
    "emailPrincipal",
    "emailSecundario",
    "nombreCiudad",
    "nombreRepresentante"
]

export const FIELDS_TERRITORIOS = {
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

export const FIELDS_MAESTROS = [
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
    "nombreCiudad",
    
  ]
  