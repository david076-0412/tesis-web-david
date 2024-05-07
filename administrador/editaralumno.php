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





$id = $_POST['id'];


$usuario_admin = $_POST['usuario_admin'];
// Recibir datos del formulario (alternativa)
$usuario_apoderado = $_POST['usuario_apoderado'];
$usuario_dni_apoderado = $_POST['usuario_dni_apoderado'];
$usuario_nombre_apoderado = $_POST['usuario_nombre_apoderado'];
$tipo_documento = $_POST['tipo_documento'];
$dni = $_POST['dni'];

// Concatenar apellido y nombre para obtener el nombre completo del alumno
$alumno = $_POST['alumno'];

$fecha_nacimiento = $_POST['fecha_nacimiento'];



$usuario_alumnodd = $_POST['usuario_alumnodd'];


$usuario_alumno = $_POST['usuario_alumno'];



$correo = $_POST['correo'];
$password = $_POST['password'];
$sexo = $_POST['sexo'];


$estado_foto = $_POST['estado_foto'];

$estado_libreta = $_POST['estado_libreta'];

$estado_alumno = $_POST['estado_alumno'];



if ($estado_alumno == "Antiguo") {




    if ($estado_foto == "SUBIDO") {
        // Ambas fotos están presentes

        $discapacidad = $_POST['discapacidad'];

        // Validar si hay discapacidad y asignar el tipo de discapacidad correspondiente
        if ($discapacidad === "SI") {
            $tipo_discapacidad = $_POST['tipo_discapacidad'];
        } else {
            $tipo_discapacidad = "Ninguno";
        }

        // Definir turno y estado de la foto
        $turno = "mañana";


        // Obtener el año de inscripción actual
        $ano_inscrip = date('Y');

        // Definir la modalidad
        $modalidad = "Presencial";

        // Recibir nivel del formulario
        $nivel = $_POST['niveles'];



        $grado = $_POST['grado'];

        $codalu = $_POST['codalu'];


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


            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario SET correo='$correo', clave='$password', usuario='$usuario_alumno' WHERE usuario = '$usuario_alumno'";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
    usuario_apoderado = ?,
    usuario_dni_apoderado = ?,
    usuario_nombre_apoderado = ?,
    tipo_documento = ?,
    dni = ?,
    alumno = ?,
    fecha_nacimiento = ?,
    usuario = ?,
    correo = ?,
    password = ?,
    sexo = ?,
    rol = ?,
    estado_alumno = ?,
    discapacidad = ?,
    tipo_discapacidad = ?,
    nivel = ?,
    grado = ?,
    turno = ?,
    horario = ?,
    codalu = ?,
    ano_inscrip = ?,
    modalidad = ?,
    estado = ?,
    perfil = ?
    WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "sssssssssssssssssssssssss",
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
                $estado_alumno,
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $estado,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );


            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_foto == "SIN SUBIR") {
        // Solo hay foto de libreta



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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario 
             SET correo='$correo', 
             clave='$password', 
             usuario='$usuario_alumno' 
             WHERE usuario = '$usuario_alumnodd'";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     foto_do_identidad = ?,
     estado_alumno = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "ssssssssssssssssssssssssssss",
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
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    }


    
} else if ($estado_alumno == "Nuevo") {



    if ($estado_foto == "SUBIDO" && $estado_libreta == "SUBIDO") {
        // Ambas fotos están presentes

        $discapacidad = $_POST['discapacidad'];

        // Validar si hay discapacidad y asignar el tipo de discapacidad correspondiente
        if ($discapacidad === "SI") {
            $tipo_discapacidad = $_POST['tipo_discapacidad'];
        } else {
            $tipo_discapacidad = "Ninguno";
        }

        // Definir turno y estado de la foto
        $turno = "mañana";


        // Obtener el año de inscripción actual
        $ano_inscrip = date('Y');

        // Definir la modalidad
        $modalidad = "Presencial";

        // Recibir nivel del formulario
        $nivel = $_POST['niveles'];



        $grado = $_POST['grado'];

        $codalu = $_POST['codalu'];


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


            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario SET correo='$correo', clave='$password', usuario='$usuario_alumno' WHERE usuario = '$usuario_alumno'";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
    usuario_apoderado = ?,
    usuario_dni_apoderado = ?,
    usuario_nombre_apoderado = ?,
    tipo_documento = ?,
    dni = ?,
    alumno = ?,
    fecha_nacimiento = ?,
    usuario = ?,
    correo = ?,
    password = ?,
    sexo = ?,
    rol = ?,
    estado_alumno = ?,
    discapacidad = ?,
    tipo_discapacidad = ?,
    nivel = ?,
    grado = ?,
    turno = ?,
    horario = ?,
    codalu = ?,
    ano_inscrip = ?,
    modalidad = ?,
    estado = ?,
    perfil = ?
    WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "sssssssssssssssssssssssss",
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
                $estado_alumno,
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $estado,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );


            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_foto == "SUBIDO" && $estado_libreta == "SIN SUBIR") {
        // Solo hay foto de documento de identidad



        $foto_libreta = file_get_contents($_FILES['foto_libreta']['tmp_name']);
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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario 
             SET correo='$correo', 
             clave='$password', 
             usuario='$usuario_alumno' 
             WHERE usuario='$usuario_alumnodd'";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     estado_alumno = ?,
     foto_libreta = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "ssssssssssssssssssssssssssss",
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
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_foto == "SIN SUBIR" && $estado_libreta == "SUBIDO") {
        // Solo hay foto de libreta



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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario 
             SET correo='$correo', 
             clave='$password', 
             usuario='$usuario_alumno' 
             WHERE usuario = '$usuario_alumnodd'";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     estado_alumno = ?,
     foto_do_identidad = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "ssssssssssssssssssssssssssss",
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
                $estado_alumno,
                $foto_do_identidad,
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_foto == "SUBIDO") {
        // Solo hay foto de documento de identidad



        $foto_libreta = file_get_contents($_FILES['foto_libreta']['tmp_name']);
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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario SET correo='$correo', clave='$password', usuario='$usuario_alumno')";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     estado_alumno = ?,
     foto_libreta = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "ssssssssssssssssssssssssssss",
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
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_libreta == "SUBIDO") {
        // Solo hay foto de libreta



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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario SET correo='$correo', clave='$password', usuario='$usuario_alumno')";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     estado_alumno = ?,
     foto_do_identidad = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "ssssssssssssssssssssssssssss",
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
                $estado_alumno,
                $foto_do_identidad,
                $discapacidad,
                $tipo_discapacidad,
                $nivel,
                $grado,
                $turno,
                $horario,
                $codalu,
                $ano_inscrip,
                $modalidad,
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } elseif ($estado_foto == "SIN SUBIR" && $estado_libreta == "SIN SUBIR") {
        // Ninguna foto está presente





        $foto_do_identidad = file_get_contents($_FILES['foto_do_identidad']['tmp_name']);
        $foto_libreta = file_get_contents($_FILES['foto_libreta']['tmp_name']);
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

            // Realizar la actualización de la cantidad de descuentos disponibles
            $qlrdd = "UPDATE colegio SET cant_desc_est = cant_desc_est WHERE nivel = '$nivel'";
            $resultyy = $conexion->query($qlrdd);

            // Construir el horario
            $dia_p = $rowddee['dia_p'];
            $dia_s = $rowddee['dia_s'];
            $hora_i = $rowddee['hora_ic'];
            $hora_f = $rowddee['hora_fc'];
            $horario = "$dia_p-$dia_s: $hora_i - $hora_f";

            // Insertar datos del alumno en la base de datos
            $queryUsuario = "UPDATE usuario SET correo='$correo', clave='$password', usuario='$usuario_alumno')";
            $resultadoUsuario = $conexion->query($queryUsuario);

            // Preparar consulta para actualizar datos del alumno
            $query = "UPDATE alumno SET 
     usuario_apoderado = ?,
     usuario_dni_apoderado = ?,
     usuario_nombre_apoderado = ?,
     tipo_documento = ?,
     dni = ?,
     alumno = ?,
     fecha_nacimiento = ?,
     usuario = ?,
     correo = ?,
     password = ?,
     sexo = ?,
     rol = ?,
     foto_do_identidad = ?,
     estado_alumno = ?,
     foto_libreta = ?,
     discapacidad = ?,
     tipo_discapacidad = ?,
     nivel = ?,
     grado = ?,
     turno = ?,
     horario = ?,
     codalu = ?,
     ano_inscrip = ?,
     modalidad = ?,
     estado = ?,
     estado_foto = ?,
     estado_libreta = ?,
     perfil = ?
     WHERE id = ?"; // Aquí asumo que id_alumno es el campo clave único

            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $rol = "alumno";
            $estado = $_POST['estado'];
            $perfil = NULL;

            $stmt->bind_param(
                "sssssssssssssssssssssssssssss",
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
                $estado,
                $estado_foto,
                $estado_libreta,
                $perfil,
                $id // Asegúrate de proporcionar el valor de id_alumno aquí
            );

            try {
                // Ejecutar la consulta
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                } else {
                    header("Location: ../administrador/admin-alumno.php?usuario=$usuario_admin&usuario_apoderado=$usuario_apoderado&usuario_dni_apoderado=$usuario_dni_apoderado&usuario_nombre_apoderado=$usuario_nombre_apoderado");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage(); // Manejar la excepción
            }

            // Cerrar la declaración
            $stmt->close();
        }
    }
}







// Cerrar la conexión
$conexion->close();
