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


$alumno = $_GET['alumno'];

$usuario_alumno = $_GET['usuario_alumno'];

$nivel = $_GET['nivel'];

$grado = $_GET['grado'];

$nombre_curso = "Libreta de Notas de ".$alumno."-".$nivel."-".$grado;

// Consultar la base de datos para obtener el archivo material correspondiente al curso
$sql = "SELECT alumno,foto_libreta,usuario
FROM alumno 
WHERE usuario= :usuario_alumno";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':usuario_alumno', $usuario_alumno);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el archivo en la base de datos
if ($result) {
    $archivo = $result['foto_libreta'];

    // Configurar las cabeceras para la descarga del archivo
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $nombre_curso . '.pdf"');

    // Imprimir el contenido del archivo
    echo $archivo;
} else {
    // Archivo no encontrado
    echo "Archivo no encontrado";
}
