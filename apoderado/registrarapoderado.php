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






    $tipo_documento = $_POST['tipo_documento'];
    $dni = $_POST['dni'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $nombres = $_POST['nombres'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $foto_do_identidad = file_get_contents($_FILES['foto_do_identidad']['tmp_name']);





    $queryUsuario = "INSERT INTO usuario (correo,clave,usuario) 
    VALUES ('$correo','$password','$usuario')";
    $resultadoUsuario = $conexion->query($queryUsuario);



    $query = "INSERT INTO apoderado (tipo_documento,dni,
    apellido_paterno,apellido_materno,nombres,
    usuario,correo,password,rol,estado_foto,foto_do_identidad,perfil)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE 
            correo = '$correo',
            dni = '$dni'";
    
    $perfil = NULL;
    
    $rol="apoderado";

    $estado_foto="SUBIDO";
    
        $stmt = $conexion->prepare($query);
    
        // Vincular parámetros
        $stmt->bind_param(
            "ssssssssssss",
            $tipo_documento,
            $dni,
            $apellido_paterno,
            $apellido_materno,
            $nombres,
            $usuario,$correo,$password,
            $rol,$estado_foto,$foto_do_identidad,$perfil
        );
    
        try {
            // Ejecutar la consulta
            $stmt->execute();
            //header("Location: ../docente/docente-curso-material.php?usuario=$usuario");


            if ($stmt == TRUE) {

                //echo "se han insertado los datos";
                echo "success";
                //header("Location: ../panel_inicio.php");
        
            } else {
                echo "error";
                //echo "No se han insertado los datos";
            }

            // Verificar el resultado de la ejecución
    
        } catch (Exception $e) {
            // Manejar la excepción, puedes loguear o mostrar un mensaje de error personalizado.
            echo "Error: " . $e->getMessage();
        }







// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();