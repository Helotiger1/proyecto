
export const API_ENDPOINTS = { 
    paises: 'paises',
    estados: 'estados',
    municipios: 'municipios',
    parroquias: 'parroquias',
    ciudades: 'ciudades'
};

export const FIELDS_TO_SELECT = {
    paises: null,
    estados: ['paises'],
    municipios: ['paises','estados'],
    parroquias: [ 'paises', 'estados','municipios'],
    ciudades: ['paises', 'estados','municipios', 'parroquias']
};

export const FIELDS_TO_FILL = {
    paises: ['nombrePais', 'estatus'],
    estados: ['nombreEstado'],
    municipios: ['nombreMunicipio'],
    parroquias: ['nombreParroquia'],
    ciudades: ['nombreCiudad']
};

export const FIELDS_ALLOW = {
    paises: ['codPais', 'nombrePais', 'estatus'],
    estados: ['codEstado', 'nombreEstado', 'nombrePais'],
    municipios: ['codMunicipio','nombreMunicipio', 'nombreEstado', 'nombrePais'],
    parroquias: ['codParroquia', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais'],
    ciudades: ['codCiudad', 'nombreCiudad', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais']
};


export const FIELD_NAMES = {
    codPais: 'Código País',
    nombrePais: 'País',
    estatus: 'Estatus',
    codEstado: 'Código Estado',
    nombreEstado: 'Estado',
    codMunicipio: 'Código Municipio',
    nombreMunicipio: 'Municipio',
    codParroquia: 'Código Parroquia',
    nombreParroquia: 'Parroquia',
    codCiudad: 'Código Ciudad',
    nombreCiudad: 'Ciudad'
};

export const FIELDS_CONFIG = {
    paises: ['nombrePais', 'estatus'],
    estados: ['nombreEstado', 'nombrePais'],
    municipios: ['nombreMunicipio', 'nombreEstado', 'nombrePais'],
    parroquias: ['nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais'],
    ciudades: ['nombreCiudad', 'nombreParroquia', 'nombreMunicipio', 'nombreEstado', 'nombrePais']
};

export const FIELDS_CONVERSION = {
    "paises": 'codPais',
    "estados": 'codEstado',
    "municipios": 'codMunicipio',
    "parroquias": 'codParroquia',
    "ciudades": 'codCiudad'
};

