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



$usuario_docente = $_POST['usuario_docente'];

$correo = $_POST['correo'];

$password = $_POST['password'];

$apellido_paterno = $_POST['apellido_paterno'];

$apellido_materno = $_POST['apellido_materno'];

$nombres = $_POST['nombres'];

$direccion = $_POST['direccion'];

$sexo = $_POST['sexo'];

$fechadn = $_POST['fechadn'];

$telefono = $_POST['telefono'];

$tipo_documento = $_POST['tipo_documento'];

$dni = $_POST['dni'];

$rol = "docente";

$nivel = $_POST['nivel'];

$grado = $_POST['grado'];

$turno = "mañana";



// Consultar la cantidad de descuentos y la cantidad de alumnos ordinarios para el nivel recibido
$qlee = "SELECT c.id, c.nivel, c.cant_docente_desc_est, c.cant_docente_or FROM colegio c WHERE c.nivel ='$nivel'";
$resultadoddee = $conexion->query($qlee);
$rowddee = $resultadoddee->fetch_assoc();

$cant_desc_estee = $rowddee['cant_docente_desc_est'];
$cant_or = $rowddee['cant_docente_or'];


// Verificar si hay vacantes disponibles
if ($cant_desc_estee == 0) {
    echo "error";
} elseif ($cant_desc_estee <= $cant_or) {

    // Realizar la actualización de la cantidad de descuentos disponibles
    $qlrdd = "UPDATE colegio SET cant_docente_desc_est = cant_docente_desc_est - 1 WHERE nivel = '$nivel'";
    $resultyy = $conexion->query($qlrdd);


    $qleed = "SELECT c.id, c.cant_docente_desc_est FROM colegio c WHERE c.nivel ='$nivel'";
    $resultadoddeed = $conexion->query($qleed);
    $rowddeed = $resultadoddeed->fetch_assoc();

    $cant_desc_ested = $rowddeed['cant_docente_desc_est'];



    $query = "INSERT INTO docente (
    usuario,correo,password,
    apellido_paterno,apellido_materno,
    nombres,direccion,
    sexo,fechadn,
    telefono,tipo_documento,
    dni,rol,perfil,nivel,
    grado,turno,usuario_admin,cant_docente_desc_est) 
    VALUES (
        '$usuario_docente',
        '$correo','$password',
        '$apellido_paterno','$apellido_materno',
        '$nombres','$direccion',
        '$sexo','$fechadn','$telefono',
        '$tipo_documento','$dni','$rol',NULL,
        '$nivel','$grado','$turno','$usuario','$cant_desc_ested') ";




    $resultado = $conexion->query($query);



    $queryUsuario = "INSERT INTO usuario (correo,clave,usuario,usuario_apalum) 
    VALUES ('$correo','$password','$usuario_docente','$usuario')";
    $resultadoUsuario = $conexion->query($queryUsuario);







    if ($resultado === TRUE) {

        //echo "se han insertado los datos";
        echo "success";
        //header("Location: ../administrador/admin-docente.php?usuario=$usuario");
    } else {
        echo "error";
        //echo "No se han insertado los datos";
        //header("Location: ../administrador/admin-docente.php?usuario=$usuario");
    }
}








// Cerrar la declaración y la conexión

$conexion->close();
