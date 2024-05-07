<?php

require_once('../conexion.php');

if (
    empty($_POST['docente']) && empty($_POST['curso']) &&
    empty($_POST['niveles']) && empty($_POST['grados']) &&
    empty($_POST['tema']) &&
    empty($_POST['usuario']) &&
    empty($_POST['tipoasistencia']) &&
    empty($_POST['hora_inicio']) &&
    empty($_POST['hora_fin']) &&
    empty($_POST['fecha_inicio']) &&
    empty($_POST['fecha_asis']) &&
    empty($_POST['fecha_fin'])
) {
    echo "por favor llene los campos correspondientes";
} else {

    $usuario = $_REQUEST['usuario'];




    //$alumnos_seleccionados = $_POST['alumnos'];
    $docente = $_POST['docente'];
    $curso = $_POST['curso'];

    $nivel_p = $_POST['niveles'];
    $grado_p = $_POST['grados'];

    $tema = $_POST['tema'];

    //$tipoasistencia = $_POST['tipoasistencia'];



    $fecha_inicio = $_POST['fecha_inicio'];


    $fecha_asis = $_POST['fecha_asis'];


    $fecha_fin = $_POST['fecha_fin'];

    $dia = $_POST['dia'];

    $hora_inicio = $_POST['hora_inicio'];

    $hora_fin = $_POST['hora_fin'];



    $horaFormateada_inicio = date("h:i A", strtotime($hora_inicio));

    $horaFormateada_fin = date("h:i A", strtotime($hora_fin));



    $hora = $horaFormateada_inicio . " - " . $horaFormateada_fin;






    //$usuario_alumno = $_POST['usuario'];

    $usuario_docente = $_POST['usuario_docente'];



    $alumnos = $_POST['alumnos'];
    $tipoasistencias = $_POST['tipoasistencia'];







    for ($i = 0; $i < count($alumnos); $i++) {





        $alumno = mysqli_real_escape_string($conexion, $alumnos[$i]);


        $query_alumno = "SELECT a.usuario from alumno a WHERE a.alumno='$alumno'";
        $resultado_usuario_alumno = $conexion->query($query_alumno);

        $fila_usuario_alumno = $resultado_usuario_alumno->fetch_assoc();

        $usuario_alumno = $fila_usuario_alumno['usuario'];


        $query_apoderado = "SELECT a.usuario_apoderado from alumno a WHERE a.alumno='$alumno'";
        $resultado_apoderado = $conexion->query($query_apoderado);

        $fila_apoderado = $resultado_apoderado->fetch_assoc();

        $usuario_apoderado = $fila_apoderado['usuario_apoderado'];



        $tipoasistencia = mysqli_real_escape_string($conexion, $tipoasistencias[$i]);

        $sqlAsistencia = "INSERT INTO asistencia (
            alumno,
            docente,
            curso,
            nivel,
            tema,
            grado,
            tipoasistencia,
            fecha_inicio,
            fecha_asis,
            fecha_fin,
            dia,
            hora,
            usuario,
            usuario_apoderado,
            usuario_docente
            ) 
            VALUES (
            '$alumno',
            '$docente',
            '$curso',
            '$nivel_p',
            '$tema',
            '$grado_p',
            '$tipoasistencia',
            '$fecha_inicio',
            '$fecha_asis',
            '$fecha_fin',
            '$dia',
            '$hora',
            '$usuario_alumno',
            '$usuario_apoderado',
            '$usuario_docente')";





        $resultado=mysqli_query($conexion, $sqlAsistencia);




    }











    if ($resultado) {

        //echo "se han insertado los datos";
        header("Location: ../docente/docente-asistencia.php?usuario=$usuario&docente=$docente");
        //header("Location: ../panel_inicio.php");

    } else {
        //echo "error";
        header("Location: ../docente/docente-asistencia.php?usuario=$usuario&docente=$docente");
        //echo "No se han insertado los datos";
    }



    
}
