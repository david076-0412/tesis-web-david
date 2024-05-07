<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';





// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $passwordapli = $_POST['conaplicacion'];
    $dispatcher = null;
    $otpvalue = 0;
    session_start();

    if (!empty($email) && !empty($passwordapli)) {
        // Sending OTP
        $otpvalue = rand(0, 1255650);

        $to = $email;
        // SMTP configuration
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = $email; // Put your email id here
        $mail->Password = $passwordapli; // Put your password here


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


        $query_clave = "SELECT u.clave from usuario u WHERE u.correo='$email'";
        $resultado_clave = $conexion->query($query_clave);

        $fila_clave = $resultado_clave->fetch_assoc();

        $usuario_clave = $fila_clave['clave'];


        $mail->setFrom($email);
        $mail->addAddress($to);
        $mail->Subject = 'Hola';
        $mail->Body = 'Tu OTP es: ' . $otpvalue.' Email: '.$email.' clave: '.$usuario_clave;

        // Send mail
        if ($mail->send()) {
            echo 'Mensaje enviado con éxito';
        } else {
            echo 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
        }

        $dispatcher = '../EnterOtp.php?email='.$email;
        $_SESSION['message'] = 'La OTP se envía a su ID de correo electrónico';
        $_SESSION['otp'] = $otpvalue;
        $_SESSION['email'] = $email;
        header("Location: $dispatcher");
        exit;
    }
}
