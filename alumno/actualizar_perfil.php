<?php

session_start(); // Asegúrate de iniciar la sesión al principio del script


// Verifica si el usuario está autenticado
if (isset($_SESSION['usuario'])) {


    $servidor = "localhost";
    $usuario = "root";
    $password = "9$8753JK5";
    $db = "bd_tesis";


    // Establece la conexión a la base de datos
    $conexion = new mysqli($servidor, $usuario, $password, $db);


    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtiene el usuario actual de la sesión
    $usuarioSesion = $_SESSION['usuario'];

    // Verifica si se envió el formulario con el nuevo usuario
    if (isset($_POST['usuario'])) {

        function validarEntrada($entrada)
        {
            // Implementa la validación necesaria según el tipo de dato
            // o utiliza funciones como mysqli_real_escape_string
            return $entrada;
        }


        // Limpia y obtén el nuevo valor del usuario
        $nuevoUsuario = $conexion->real_escape_string($_POST['usuario']);



        $id = validarEntrada($_REQUEST['id']);
        $alumno = validarEntrada($_POST['alumno']);
        $tipo_documento = validarEntrada($_POST['tipo_documento']);
        $dni = validarEntrada($_POST['dni']);
        $correo = validarEntrada($_POST['correo']);

        $password = validarEntrada($_POST['password']);


        // Actualiza el campo 'usuario' en la tabla 'alumno'
        $queryAlumno = "UPDATE alumno SET alumno = '$alumno',
        tipo_documento = '$tipo_documento',
        dni = '$dni',
        correo = '$correo',
        password ='$password',
        usuario='$nuevoUsuario' 
        WHERE usuario='$usuarioSesion'";


        $resultadoAlumno = $conexion->query($queryAlumno);




        // Actualiza el campo 'usuario' en la tabla 'alumno'
        $queryCurso = "UPDATE curso
        SET usuario_alumno='$nuevoUsuario'
        WHERE usuario_alumno='$usuarioSesion'";




        $resultadoCurso = $conexion->query($queryCurso);




        // Actualiza el campo 'usuario' en la tabla 'alumno'
        $queryTarea = "UPDATE tarea 
        SET usuario='$nuevoUsuario'
        WHERE usuario='$usuarioSesion'";


        $resultadoTarea = $conexion->query($queryTarea);



        // Actualiza el campo 'usuario' en la tabla 'alumno'
        $queryNotas = "UPDATE notas
        SET usuario='$nuevoUsuario'
        WHERE usuario='$usuarioSesion'";


        $resultadoNotas = $conexion->query($queryNotas);


        $queryUsuario = "UPDATE usuario
        SET
        correo = '$correo',
        clave = '$password',
        usuario = '$nuevoUsuario'
        WHERE usuario = '$usuarioSesion'";


        $resultadoUsuario = $conexion->query($queryUsuario);



        if ($resultadoAlumno) {
            // Actualización exitosa, actualiza también la sesión con el nuevo usuario
            $_SESSION['usuario'] = $nuevoUsuario;
            header("Location: ../alumno/alumno-perfil.php?usuario=$nuevoUsuario");
            exit(); // Termina el script después de redireccionar
        } else {
            // Log del error
            error_log("Error en la consulta: " . $conexion->error);
        }
    }


    // Cierra la conexión
    $conexion->close();
    // Redirecciona si no se procesó correctamente el formulario
    header("Location: ../alumno/alumno-perfil.php?usuario=$usuarioSesion");
    exit(); // Termina el script después de redireccionar

} else {
    echo "No has iniciado sesión.";
}
