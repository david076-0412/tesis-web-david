

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesion</title>
    <link rel="stylesheet" href="../alumno/css/estilospi.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<link href="../alumno/images/logotiposbp.ico" type="image/x-icon" rel="shortcut icon" />
    
</head>

</html>





<?php 

session_start();

session_unset();
session_destroy();


header("Location: ../login.php");

