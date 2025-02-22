<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noticias";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['error' => 'Conexión fallida: ' . $conn->connect_error]);
    exit;
}

$type = $_GET['type'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($type == 'pais') {
    $sql = "SELECT codPais AS id, nombrePais AS nombre FROM paises";
} elseif ($type == 'estado' && $id > 0) {
    $sql = "SELECT codEstado AS id, nombreEstado AS nombre FROM estados WHERE codPais = $id";
} elseif ($type == 'municipio' && $id > 0) {
    $sql = "SELECT codMunicipio AS id, nombreMunicipio AS nombre FROM municipios WHERE codEstado = $id";
} elseif ($type == 'parroquia' && $id > 0) {
    $sql = "SELECT codParroquia AS id, nombreParroquia AS nombre FROM parroquias WHERE codMunicipio = $id";
} elseif ($type == 'ciudad' && $id > 0) {
    $sql = "SELECT codCiudad AS id, nombreCiudad AS nombre FROM ciudades WHERE codParroquia = $id";
} else {
    echo json_encode(['error' => 'Tipo o ID inválido']);
    $conn->close();
    exit;
}

$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(['error' => 'Error en la consulta SQL: ' . $conn->error]);
    $conn->close();
    exit;
}

$options = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
} else {
    echo json_encode(['error' => 'No se encontraron resultados']);
    $conn->close();
    exit;
}

echo json_encode($options);

$conn->close();
?>