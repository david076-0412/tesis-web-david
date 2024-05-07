<?php

$servidor = "localhost";
$usuario = "root";
$password = "9$8753JK5";
$db = "bd_tesis";
$conexion = mysqli_connect($servidor, $usuario, $password, $db) or die("No se ha podido conectar al Servidor");


mysqli_query($conexion, "SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($conexion, $db) or die("Upps! Error en conectar a la Base de Datos");
