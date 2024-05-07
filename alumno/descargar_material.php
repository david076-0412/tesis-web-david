<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuarioDB = "root";
$passwordDB = "9$8753JK5";
$nombreDB = "bd_tesis";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombreDB;charset=utf8mb4", $usuarioDB, $passwordDB);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Obtener el ID del curso desde la URL
$nombre = $_GET['nombre'];
$docente = $_GET['docente'];


$tema = $_GET['tema'];
$nivel = $_GET['nivel'];
$grado = $_GET['grado'];

$nombre_curso = $nombre . " - ".$docente ." - ". $tema ." - ". $nivel ." - ". $grado;

// Consultar la base de datos para obtener el archivo material correspondiente al curso
$sql = "SELECT archivomaterial, nombre, 
docente,
tema, nivel, grado 
FROM curso 
WHERE nombre= :curso
AND docente = :docente
AND tema = :tema 
AND nivel = :nivel 
AND grado = :grado";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':curso', $nombre);
$stmt->bindParam(':docente', $docente);

$stmt->bindParam(':tema', $tema);
$stmt->bindParam(':nivel', $nivel);
$stmt->bindParam(':grado', $grado);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el archivo en la base de datos
if ($result) {
    $archivo = $result['archivomaterial'];

    // Configurar las cabeceras para la descarga del archivo
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $nombre_curso . '.pdf"');

    // Imprimir el contenido del archivo
    echo $archivo;
} else {
    // Archivo no encontrado
    echo "Archivo no encontrado";
}
