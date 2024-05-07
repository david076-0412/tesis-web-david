<?php

require_once('../conexion.php');


$id = $_REQUEST['id'];

$usuario = $_REQUEST['usuario'];


$query = "DELETE FROM curso WHERE id ='$id'";

$resultado = $conexion->query($query);

if ($resultado) {


    header("Location: ../docente/docente-curso-material.php?usuario=$usuario");
} else {
    echo "No se a eliminado";
}