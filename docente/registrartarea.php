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



$titulo = $_POST['titulo'];

$descripcion = $_POST['descripcion'];

$tema = $_POST['temas'];

$docente = $_POST['docente'];

$materias = $_POST['materias'];


$niveles = $_POST['niveles'];

$grados = $_POST['grados'];

$alumnos_seleccionados = $_POST['alumnos'];



$turno = "mañana";
$modalidad = "Presencial";

$nota = 0.00;

$fecha_entrega = $_POST['fecha_entrega'];

$hora_entrega = $_POST['hora_entrega'];

$categoriaentrega = "SIN ENTREGAR";



$subirarchivotarea = "";

$estadoarchivo = "SUBIDO";

$archivotarea = addslashes(file_get_contents($_FILES['subir_do_tarea']['tmp_name']));







// Realizar la inserción en la base de datos
foreach ($alumnos_seleccionados as $alumno_id) {




    $query_alumno = "SELECT a.usuario,a.alumno from alumno a WHERE a.alumno='$alumno_id'";
    $resultado_usuario_alumno = $conexion->query($query_alumno);
    
    $fila_usuario_alumno = $resultado_usuario_alumno->fetch_assoc();
    
    $usuario_alumno = $fila_usuario_alumno['usuario'];


    $query_apoderado = "SELECT a.usuario_apoderado,a.alumno from alumno a WHERE a.alumno='$alumno_id'";
    $resultado_usuario_apoderado = $conexion->query($query_apoderado);
    
    $fila_usuario_apoderado = $resultado_usuario_apoderado->fetch_assoc();
    
    $usuario_apoderado = $fila_usuario_apoderado['usuario_apoderado'];
    
    
    
    $query = "INSERT INTO tarea (titulo,descripcion,tema,docente,materia,nivel,
    grado,turno,modalidad,alumno,nota,fecha_entrega,hora_entrega,categoriaentrega,estadoarchivo,usuario,usuario_apoderado,archivotarea,subirarchivotarea) 
        VALUES ('$titulo','$descripcion','$tema','$docente','$materias','$niveles','$grados','$turno','$modalidad','$alumno_id','$nota','$fecha_entrega','$hora_entrega','$categoriaentrega','$estadoarchivo','$usuario_alumno','$usuario_apoderado','$archivotarea','$subirarchivotarea') ";
    
    
    
    
    $resultado = $conexion->query($query);
    



    if ($resultado) {

        //echo "se han insertado los datos";
        //echo "success";
        header("Location: ../docente/docente-tarea-alumno.php?usuario=$usuario");
    } else {
        //echo "error";
        //echo "No se han insertado los datos";
        header("Location: ../docente/docente-tarea-alumno.php?usuario=$usuario");
    }






}








// Cerrar la declaración y la conexión

$conexion->close();
