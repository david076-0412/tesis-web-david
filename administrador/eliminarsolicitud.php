<?php

require_once('../conexion.php');


$id = $_REQUEST['id'];

$usuario = $_REQUEST['usuario'];

$usuario_apoderado = $_REQUEST['usuario_apoderado'];

$query = "DELETE FROM solicitud_apoderado WHERE id ='$id'";

$resultado = $conexion->query($query);


if ($resultado) {


    header("Location: ../administrador/admin-solicitud.php?usuario=$usuario&usuario_apoderado=$usuario_apoderado");

} else {

    header("Location: ../administrador/admin-solicitud.php?usuario=$usuario&usuario_apoderado=$usuario_apoderado");
}