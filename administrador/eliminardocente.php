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



$id = $_REQUEST['id'];

$usuario = $_REQUEST['usuario'];

$usuario_docente = $_REQUEST['usuario_docente'];





// Consultar la cantidad de descuentos y la cantidad de alumnos ordinarios para el nivel recibido
$qlee = "SELECT * FROM colegio c WHERE c.usuario ='$usuario'";
$resultadoddee = $conexion->query($qlee);
$rowddee = $resultadoddee->fetch_assoc();

$cant_desc_estee = $rowddee['cant_docente_desc_est'];
$cant_or = $rowddee['cant_docente_or'];


if($cant_or == $cant_desc_estee){
    
    $queryColed = "UPDATE colegio SET cant_docente_desc_est = cant_docente_desc_est WHERE usuario ='$usuario'";
    $resultadoEs = $conexion->query($queryColed);


    


}else if($cant_or > $cant_desc_estee){
    

    $queryColed = "UPDATE colegio SET cant_docente_desc_est = cant_docente_desc_est + 1 WHERE usuario ='$usuario'";
    $resultadoEs = $conexion->query($queryColed);



}





$query = "DELETE FROM docente WHERE id ='$id'";

$resultado = $conexion->query($query);

$queryUsuario = "DELETE FROM usuario WHERE usuario ='$usuario_docente'";

$resultadoUsuario = $conexion->query($queryUsuario);


$queryAsistencia = "DELETE FROM asistencia WHERE usuario_docente ='$usuario_docente'";

$resultadoAsistencia = $conexion->query($queryAsistencia);


$queryCurso = "DELETE FROM curso WHERE usuario_docente ='$usuario_docente'";

$resultadoCurso = $conexion->query($queryCurso);


$queryNotas = "DELETE FROM notas WHERE usuario_docente ='$usuario_docente'";

$resultadoNotas = $conexion->query($queryNotas);


$queryTarea = "DELETE FROM tarea WHERE usuario_docente ='$usuario_docente'";

$resultadoTarea = $conexion->query($queryTarea);



if ($resultado == TRUE) {


    header("Location: ../administrador/admin-docente.php?usuario=$usuario");
} else {
    header("Location: ../administrador/admin-docente.php?usuario=$usuario");
}






// Cerrar la conexión
$conexion->close();