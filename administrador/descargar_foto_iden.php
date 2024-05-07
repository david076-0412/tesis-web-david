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


$apellido_paterno = $_GET['apellido_paterno'];
$apellido_materno = $_GET['apellido_materno'];
$nombres = $_GET['nombres'];
$tipo_documento = $_GET['tipo_documento'];

$usuario_apoderado = $_GET['usuario_apoderado'];


$nombre_curso = $apellido_paterno ." ".$apellido_materno ." ".$nombres ."-". $tipo_documento;

// Consultar la base de datos para obtener el archivo material correspondiente al curso
$sql = "SELECT apellido_paterno, apellido_materno, nombres,tipo_documento,foto_do_identidad
FROM apoderado 
WHERE usuario= :usuario_apoderado";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':usuario_apoderado', $usuario_apoderado);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el archivo en la base de datos
if ($result) {
    $archivo = $result['foto_do_identidad'];

    // Configurar las cabeceras para la descarga del archivo
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $nombre_curso . '.pdf"');

    // Imprimir el contenido del archivo
    echo $archivo;
} else {
    // Archivo no encontrado
    echo "Archivo no encontrado";
}
