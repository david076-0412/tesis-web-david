<?php

$servidor = "localhost";
$usuarioDB = "root";
$passwordDB = "9$8753JK5";
$nombreDB = "bd_tesis";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombreDB;charset=utf8mb4", $usuarioDB, $passwordDB);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

$usu = $_POST['usuario'];
$password = $_POST['password'];

$roles = ['admin', 'docente', 'apoderado', 'alumno'];

foreach ($roles as $rol) {
    $query = "SELECT * FROM $rol WHERE usuario = :usuario AND password = :password";

    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usu);
    $stmt->bindParam(':password', $password); // Assuming passwords are stored as plain text (this should be improved)

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        switch ($rol) {
            case 'admin':
                session_start();
                $_SESSION['usuario'] = $usu;
                header("location: ../administrador/panel_admin.php?usuario=$usu");
                exit();
            

            case 'docente':
                session_start();
                $_SESSION['usuario'] = $usu;
                header("location: ../docente/panel_docente.php?usuario=$usu");
                exit();
                

            case 'apoderado':
                session_start();
                $_SESSION['usuario'] = $usu;
                header("location: ../apoderado/panel_apoderado.php?usuario=$usu");
                exit();

            case 'alumno':
                session_start();
                $_SESSION['usuario'] = $usu;
                header("location: ../alumno/panel_alumno.php?usuario=$usu");
                exit();

            default:
                header("Location: ../login.php?error=Rol no encontrado");
                exit();
        }
    }
}

// User not found in any role
header("Location: ../login.php?error=Usuario o password incorrecto");
exit();
