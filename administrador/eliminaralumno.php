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

$usuario_alumno = $_REQUEST['usuario_alumno'];

$usuario = $_REQUEST['usuario'];


$usuario_apoderado = $_REQUEST['usuario_apoderado'];


$usuario_dni_apoderado = $_REQUEST['usuario_dni_apoderado'];


$usuario_nombre_apoderado = $_REQUEST['usuario_nombre_apoderado'];





// Consultar la cantidad de descuentos y la cantidad de alumnos ordinarios para el nivel recibido
$qlee = "SELECT * FROM colegio c WHERE c.usuario ='$usuario'";
$resultadoddee = $conexion->query($qlee);
$rowddee = $resultadoddee->fetch_assoc();

$cant_desc_estee = $rowddee['cant_desc_est'];
$cant_or = $rowddee['cant_or'];


if($cant_or == $cant_desc_estee){
    
    $queryColed = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE usuario ='$usuario'";
    $resultadoEs = $conexion->query($queryColed);

}else if($cant_or > $cant_desc_estee){
    

    $queryColee = "UPDATE colegio SET cant_desc_est = cant_desc_est + 1 WHERE usuario ='$usuario'";
    $resultadoEE = $conexion->query($queryColee);



}



$queryUs = "DELETE FROM usuario WHERE usuario ='$usuario_alumno'";

$resultadoUs = $conexion->query($queryUs);


$queryAl = "DELETE FROM alumno WHERE usuario ='$usuario_alumno'";

$resultadoAl = $conexion->query($queryAl);


$queryAsis = "DELETE FROM asistencia WHERE usuario ='$usuario_alumno'";

$resultadoAsis = $conexion->query($queryAsis);


$queryCur = "DELETE FROM curso WHERE usuario_alumno ='$usuario_alumno'";

$resultadoCur = $conexion->query($queryCur);


$queryNo = "DELETE FROM notas WHERE usuario ='$usuario_alumno'";

$resultadoNo = $conexion->query($queryNo);


$queryPago = "DELETE FROM pago WHERE usuario_alumno ='$usuario_alumno'";

$resultadoPago = $conexion->query($queryPago);


$querySoli = "DELETE FROM solicitud WHERE usuario_alumno ='$usuario_alumno'";

$resultadoSoli = $conexion->query($querySoli);



$queryTarea = "DELETE FROM tarea WHERE usuario ='$usuario_alumno'";

$resultadoTarea = $conexion->query($queryTarea);



if ($resultado == TRUE) {


    header("Location: ../administrador/admin-alumno.php?usuario=$usuario&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");

} else {

    header("Location: ../administrador/admin-alumno.php?usuario=$usuario&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");

}





// Cerrar la conexión
$conexion->close();