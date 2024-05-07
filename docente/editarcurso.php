<?php

require_once('../conexion.php');



$servidor = "localhost";
$usuarioDB = "root";
$passwordDB = "9$8753JK5";
$db = "bd_tesis";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuarioDB, $passwordDB, $db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$usuario = $_REQUEST['usuario'];

$curso = $_REQUEST['nombre'];
$tema = $_REQUEST['tema'];
$docente = $_REQUEST['docente'];


$niveles = $_REQUEST['niveles'];
$grados = $_REQUEST['grados'];


$alumno = $_REQUEST['alumnos'];


//$usuario_apoderado= $_REQUEST['usuario_apoderado'];


$usuario_alumno = $_REQUEST['usuario_alumno'];


$subir_material = file_get_contents($_FILES['subir_material']['tmp_name']);




// Consulta SQL para actualizar el BLOB
$query = "UPDATE curso 
SET nombre = ?, tema = ?, docente = ?,nivel = ?, grado = ?, alumno = ?, archivomaterial = ?
WHERE usuario_alumno = ?";

$stmt = $conexion->prepare($query);

// Vincular parámetros
$stmt->bind_param("ssssssss", $curso, $tema, $docente, $niveles, $grados, $alumno, $subir_material, $usuario_alumno);


try {
    // Ejecutar la consulta
    $stmt->execute();
    header("Location: ../docente/docente-curso-material.php?usuario=$usuario");
    // Verificar el resultado de la ejecución

} catch (Exception $e) {
    // Manejar la excepción, puedes loguear o mostrar un mensaje de error personalizado.
    echo "Error: " . $e->getMessage();
}


// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
