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

$id = $_POST['id'];


$facebook = $_POST['facebook'];


$usuario = $_REQUEST['usuario'];

if ($usuario == "adminprimaria" || $usuario == "adminsecundaria") {
    $query = "UPDATE admin
              SET facebook = '$facebook'
              WHERE usuario = '$usuario'";
    
    $resultado = $conexion->query($query);
}


    

    

   



    if ($resultado) {

        //echo "se han insertado los datos";
        //echo "success";
        header("Location: ../administrador/panel_admin.php?usuario=$usuario");
    } else {
        //echo "error";
        //echo "No se han insertado los datos";
        header("Location: ../administrador/panel_admin.php?usuario=$usuario");
    }






// Cerrar la declaración y la conexión

$conexion->close();