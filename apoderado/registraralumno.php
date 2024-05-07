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

// Recibir datos del formulario
$usuariouu = $_REQUEST['usuario'];
$usuario_apoderadouu = $_REQUEST['usuario_apoderado'];
$usuario_dni_apoderadouu = $_REQUEST['usuario_dni_apoderado'];
$usuario_nombre_apoderadouu = $_REQUEST['usuario_nombre_apoderado'];

// Recibir datos del formulario (alternativa)
$usuario_apoderado = $_POST['usuario_apoderado'];
$usuario_dni_apoderado = $_POST['usuario_dni_apoderado'];
$usuario_nombre_apoderado = $_POST['usuario_nombre_apoderado'];
$tipo_documento = $_POST['tipo_documento'];
$dni = $_POST['dni'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$nombres = $_POST['nombres'];

// Concatenar apellido y nombre para obtener el nombre completo del alumno
$alumno = $apellido_paterno . " " . $apellido_materno . " " . $nombres;

$fecha_nacimiento = $_POST['fecha_nacimiento'];
$usuario_alumno = $_POST['usuario_alumno'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$sexo = $_POST['sexo'];
$foto_do_identidad = file_get_contents($_FILES['foto_do_identidad']['tmp_name']);

$discapacidad = $_POST['discapacidad'];

// Validar si hay discapacidad y asignar el tipo de discapacidad correspondiente
if ($discapacidad === "SI") {
    $tipo_discapacidad = $_POST['tipo_discapacidad'];
} else {
    $tipo_discapacidad = "Ninguno";
}

// Definir turno y estado de la foto
$turno = "mañana";

$estado_foto = "SUBIDO";

$estado_libreta = "SUBIDO";

// Obtener el año de inscripción actual
$ano_inscrip = date('Y');

// Definir la modalidad
$modalidad = "Presencial";

// Recibir nivel del formulario
$nivel = $_POST['niveles'];

$grado = $_POST['grado'];

$codalu = $_POST['codalu'];


// Establecer la zona horaria a Perú
date_default_timezone_set('America/Lima');

// Obtener la fecha actual en Perú
$fecha_actual_peru = date('Y-m-d');

// Añadir 3 días a la fecha actual
$tiempo_espera = date('Y-m-d', strtotime($fecha_actual_peru . ' +3 days'));




// Consultar la cantidad de descuentos y la cantidad de alumnos ordinarios para el nivel recibido
$qlee = "SELECT c.id, c.nivel, TIME_FORMAT(c.hora_i, '%h:%i %p') AS hora_ic, TIME_FORMAT(c.hora_f, '%h:%i %p') AS hora_fc, c.dia_p, c.dia_s, c.cant_desc_est, c.cant_or FROM colegio c WHERE c.nivel ='$nivel'";
$resultadoddee = $conexion->query($qlee);
$rowddee = $resultadoddee->fetch_assoc();

$cant_desc_estee = $rowddee['cant_desc_est'];
$cant_or = $rowddee['cant_or'];

// Verificar si hay vacantes disponibles
if ($cant_desc_estee == 0) {
    echo "error";
} elseif ($cant_desc_estee <= $cant_or) {


    $estado_alumno = $_POST['estado_alumno'];


    if ($estado_alumno == "Antiguo") {
        $estado_libretadd = "SUBIDO";

        // Realizar la actualización de la cantidad de descuentos disponibles
        //$qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est - 1 WHERE nivel = '$nivel'";
        //$resultyy = $conexion->query($qlrdd);

        // Construir el horario
        $dia_p = $rowddee['dia_p'];
        $dia_s = $rowddee['dia_s'];
        $hora_i = $rowddee['hora_ic'];
        $hora_f = $rowddee['hora_fc'];
        $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

        $qleed = "SELECT c.id, c.cant_desc_est FROM colegio c WHERE c.nivel ='$nivel'";
        $resultadoddeed = $conexion->query($qleed);
        $rowddeed = $resultadoddeed->fetch_assoc();

        $cant_desc_ested = $rowddeed['cant_desc_est'];

        // Insertar datos del alumno en la base de datos
        $queryUsuario = "INSERT INTO usuario (correo, clave, usuario,usuario_apalum) VALUES ('$correo','$password','$usuario_alumno','$usuario_apoderadouu')";
        $resultadoUsuario = $conexion->query($queryUsuario);


        $qleede = "SELECT a.id,a.usuario,a.foto_libreta FROM alumno a WHERE a.usuario ='$usuario_alumno'";
        $resultadott = $conexion->query($qleede);
        $rowtt = $resultadott->fetch_assoc();

        $foto_libreta = $rowtt['foto_libreta'];














        // Preparar consulta para insertar datos del alumno
        $query = "INSERT INTO alumno (
            usuario_apoderado, usuario_dni_apoderado, usuario_nombre_apoderado, 
            tipo_documento, dni, alumno, fecha_nacimiento, usuario, correo, 
            password, sexo, rol, foto_do_identidad, 
            estado_alumno,foto_libreta, discapacidad, 
            tipo_discapacidad, nivel, grado, turno, 
            horario, codalu, ano_inscrip, modalidad, 
            cant_desc_est, estado, tiempo_espera, 
            estado_foto, estado_libreta, perfil) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
            ON DUPLICATE KEY UPDATE 
            correo = '$correo',
            dni = '$dni'";
        $stmt = $conexion->prepare($query);

        // Vincular parámetros
        $rol = "alumno";
        $estado = "en proceso";
        $perfil = NULL;





        $stmt->bind_param(
            "ssssssssssssssssssssssssssssss",
            $usuario_apoderado,
            $usuario_dni_apoderado,
            $usuario_nombre_apoderado,
            $tipo_documento,
            $dni,
            $alumno,
            $fecha_nacimiento,
            $usuario_alumno,
            $correo,
            $password,
            $sexo,
            $rol,
            $foto_do_identidad,
            $estado_alumno,
            $foto_libreta,
            $discapacidad,
            $tipo_discapacidad,
            $nivel,
            $grado,
            $turno,
            $horario,
            $codalu,
            $ano_inscrip,
            $modalidad,
            $cant_desc_ested,
            $estado,
            $tiempo_espera,
            $estado_foto,
            $estado_libretadd,
            $perfil
        );


        



        try {


        
            // Ejecutar la consulta
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "success"; // La inserción fue exitosa
            } else {

                echo "error"; // Hubo un problema con la inserción
            }




        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); // Manejar la excepción
        }

        // Cerrar la declaración
        $stmt->close();
    } else if ($estado_alumno == "Nuevo") {


        if (isset($_FILES['foto_libreta']) && !empty($_FILES['foto_libreta']['tmp_name'])) {



            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est - 1 WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            $qleed = "SELECT c.id, c.cant_desc_est FROM colegio c WHERE c.nivel ='$nivel'";
            $resultadoddeed = $conexion->query($qleed);
            $rowddeed = $resultadoddeed->fetch_assoc();

            $cant_desc_ested = $rowddeed['cant_desc_est'];

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "INSERT INTO usuario (correo, clave, usuario,usuario_apalum) VALUES ('$correo','$password','$usuario_alumno','$usuario_apoderadouu')";
            $resultadoUsuario = $conexion->query($queryUsuario);





            // El campo de texto está lleno

            $foto_libreta = file_get_contents($_FILES['foto_libreta']['tmp_name']);


            // Preparar consulta para insertar datos del alumno
            $query = "INSERT INTO alumno (usuario_apoderado, usuario_dni_apoderado, usuario_nombre_apoderado, tipo_documento, dni, alumno, fecha_nacimiento, usuario, correo, password, sexo, rol, foto_do_identidad, estado_alumno,foto_libreta, discapacidad, tipo_discapacidad, nivel, grado, turno, horario, codalu, ano_inscrip, modalidad, cant_desc_est, estado, tiempo_espera, estado_foto, estado_libreta, perfil) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = "en proceso";
            $perfil = NULL;





            $stmt->bind_param(
                "ssssssssssssssssssssssssssssss",
                $usuario_apoderado,
                $usuario_dni_apoderado,
                $usuario_nombre_apoderado,
                $tipo_documento,
                $dni,
                $alumno,
                $fecha_nacimiento,
                $usuario_alumno,
                $correo,
                $password,
                $sexo,
                $rol,
                $foto_do_identidad,
                $estado_alumno,
                $foto_libreta,
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $cant_desc_ested,
                $estado,
                $tiempo_espera,
                $estado_foto,
                $estado_libreta,
                $perfil
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "success"; // La inserción fue exitosa
                } else {
                    echo "error"; // Hubo un problema con la inserción
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            // El campo de texto está vacío
            echo "error"; // Hubo un problema con la inserción
        }
    }
}

// Cerrar la conexión
$conexion->close();
