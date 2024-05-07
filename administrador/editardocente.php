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




$usuario_docentedd = $_POST['usuario_docentedd'];



$usuario = $_REQUEST['usuario'];

$id = $_POST['id'];


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



    
$query = "UPDATE docente
SET
usuario = '$usuario_docente',
correo = '$correo',
password = '$password',
apellido_paterno = '$apellido_paterno',
apellido_materno = '$apellido_materno',
nombres = '$nombres',
direccion = '$direccion',
sexo = '$sexo',
fechadn = '$fechadn',
telefono = '$telefono',
tipo_documento = '$tipo_documento',
dni = '$dni',
nivel = '$nivel',
grado = '$grado'
WHERE id='$id'";


    
    
    $resultado = $conexion->query($query);



    $queryUsuario = "UPDATE usuario 
         SET correo='$correo', 
         clave='$password', 
         usuario='$usuario_docente' 
         WHERE usuario='$usuario_docentedd'";
         $resultadoUsuario = $conexion->query($queryUsuario);
    



    if ($resultado) {

        //echo "se han insertado los datos";
        //echo "success";
        header("Location: ../administrador/admin-docente.php?usuario=$usuario");
    } else {
        //echo "error";
        //echo "No se han insertado los datos";
        header("Location: ../administrador/admin-docente.php?usuario=$usuario");
    }






// Cerrar la declaración y la conexión

$conexion->close();