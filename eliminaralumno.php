<?php

require_once('../alumno/conexion.php');


$id = $_REQUEST['id'];



$query = "DELETE FROM alumno WHERE id ='$id'";

$resultado = $conexion->query($query);

if ($resultado) {


    header("Location: ../alumno/consulta.php");
} else {
    echo "No se a eliminado";
}
