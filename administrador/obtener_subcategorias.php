<?php

$servidor="localhost";
$usuario="root";
$password="9$8753JK5";
$db="bd_tesis";
// Conectar a la base de datos (ajusta los detalles de conexión según tu configuración)
$conexion = new mysqli($servidor, $usuario, $password, $db);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener la categoría seleccionada desde la solicitud GET
$servicioSeleccionada = $_GET['servicio'];

// Consultar la base de datos para obtener subcategorías según la categoría seleccionada
$query = "SELECT importe,servicio FROM solicitud_apoderado WHERE servicio = '$servicioSeleccionada'";
$resultado = $conexion->query($query);

// Crear un array para almacenar las subcategorías
$subservicios = array();

// Convertir el resultado de la consulta a un array asociativo
while ($fila = $resultado->fetch_assoc()) {
    $subservicios[] = $fila;
}

// Devolver las subcategorías en formato JSON
echo json_encode($subservicios);

// Cerrar la conexión a la base de datos
$conexion->close();