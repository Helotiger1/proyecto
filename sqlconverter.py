data = ["Municipio Antolín del Campo", "Parroquia Antolín del Campo", "Ciudad La Plaza de Paraguachí", "Ciudad El Cardón", "Ciudad El Salado", "Municipio Arismendi", "Parroquia Arismendi", "Ciudad La Asunción", "Ciudad Atamo", "Ciudad Atamo Sur.", "Municipio Díaz", "Parroquia San Juan Bautista", "Ciudad San Juan Bautista", "Ciudad Boquerón", "Ciudad El Macho", "Parroquia Zabala", "Ciudad Zabala", "Ciudad El Hatico", "Ciudad El Dátil.", "Municipio García", "Parroquia García", "Ciudad El Valle del Espíritu Santo", "Parroquia Francisco Fajardo", "Ciudad La Asuncion", "Ciudad La Sierra", "Municipio Gómez", "Parroquia Sucre", "Ciudad El Maco", "Ciudad La Guardia", "Ciudad Altagracia", "Parroquia Matasiete", "Ciudad Tacarigua", "Ciudad Pedro González", "Ciudad El Cercado.", "Parroquia Bolívar", "Ciudad Santa Ana", "Ciudad El Cercado", "Ciudad El Maco", "Municipio Maneiro", "Parroquia Aguirre", "Ciudad Los Robles", "Parroquia Maneiro", "Ciudad Maneiro", "Ciudad Pampatar", "Municipio Marcano", "Parroquia Juan Griego", "Ciudad Juan Griego", "Ciudad Pedregales", "Ciudad Las Cabreras", "Ciudad Los Millanes", "Municipio Mariño", "Parroquia Mariño", "Ciudad Porlamar", "Ciudad Bella Vista.", "Municipio Península de Macanao", "Parroquia Boca de Río", "Ciudad Boca de Río", "Ciudad El Junquito", "Parroquia San Francisco de Macanao", "Ciudad El Maguey", "Municipio Tubores", "Parroquia Punta de Piedras", "Ciudad Punta de Piedras", "Ciudad Punta Arena", "Ciudad La Blanquilla", "Parroquia Los Barales", "Ciudad El Guamache", "Ciudad Punta de Mangle", "Ciudad Los Barales", "Municipio Villalba", "Parroquia San Pedro de Coche", "Ciudad San Pedro de Coche", "Ciudad Las Lapas", "Ciudad El Rincón", "Parroquia Vicente Fuentes", "Ciudad Güinima", "Ciudad Guamache", "Ciudad Zulica"]







numEstado = 1
numMunicipio = 0
numParroquia = 0
numCiudad = 0



def sqlconverter(data):
     global numEstado, numMunicipio, numParroquia, numCiudad
     if data.startswith("Municipio"):
         numMunicipio += 1
         data = f"INSERT INTO Municipios (codMunicipio, CodEdo, Descripcion) VALUES ({numMunicipio}, {numEstado} , '{data}');"

     elif data.startswith("Parroquia"):
            numParroquia += 1
            data = f"INSERT INTO Parroquias (codParroquia, CodMunicipio, Descripcion) VALUES ({numParroquia}, {numMunicipio} , '{data}');"

     elif data.startswith("Ciudad"):
            numCiudad += 1
            data = f"INSERT INTO Ciudades (codCiudad, CodParroquia, Descripcion) VALUES ({numCiudad}, {numParroquia} , '{data}');"

     else:
         data = "No se encontró el valor"

     return data

    

resultado = list(map(lambda x: sqlconverter(x), data))

print(*resultado, sep = "\n")