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

$id = $_GET['id'];

$materia = $_GET['materia'];

$nivel = $_GET['nivel'];

$grado = $_GET['grado'];

$docente = $_GET['docente'];


$nombre_curso = $materia." - ".$alumno. " - ".$nivel." - ".$grado." - ".$docente;

// Consultar la base de datos para obtener el archivo material correspondiente al curso
$sql = "SELECT subirarchivotarea,titulo,materia,docente,tema,nivel,grado,usuario,alumno
FROM tarea 
WHERE alumno = :alumno
AND usuario = :usuario_alumno 
AND id = :id
AND materia = :materia
AND nivel = :nivel
AND grado = :grado
AND docente = :docente";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':alumno', $alumno);
$stmt->bindParam(':usuario_alumno', $usuario_alumno);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':materia', $materia);
$stmt->bindParam(':nivel', $nivel);
$stmt->bindParam(':grado', $grado);
$stmt->bindParam(':docente', $docente);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el archivo en la base de datos
if ($result) {
    $archivo = $result['archivotarea'];

    // Configurar las cabeceras para la descarga del archivo
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $nombre_curso . '.pdf"');

    // Imprimir el contenido del archivo
    echo $archivo;
} else {
    // Archivo no encontrado
    echo "Archivo no encontrado";
}
