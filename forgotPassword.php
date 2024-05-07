
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale-1.0">


<title>Aula Virtual</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrapValidator.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link href="../imagen/logotiposbp.ico" type="image/x-icon" rel="shortcut icon" />


<link rel="stylesheet" href="../css/normalize.css">


<link rel="stylesheet" href="../css/estilostt.css">


<script type='text/javascript'
	src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

</head>

<body oncontextmenu='return false' class='snippet-body'>
	<div class="container padding-bottom-3x mb-2 mt-5">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<div class="forgot">
					<h2>¿Olvidaste tu contraseña?</h2>
					<p>Cambie su contraseña en tres sencillos pasos. 
					¡Esto le ayudará a proteger su contraseña!</p>
					<ol class="list-unstyled">
						<li><span class="text-primary text-medium">1. </span>Introduzca su dirección de 
						correo electrónico a continuación.</li>
						<li><span class="text-primary text-medium">2. </span>Nuestro 
						sistema le enviará una OTP a su correo electrónico</li>
						<li><span class="text-primary text-medium">3. </span>Ingrese la OTP 
						en la página siguiente</li>
					</ol>
				</div>
				<form class="card mt-4" action="../forgotPassword_OTP.php" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="email-for-pass">Ingresa tu email</label> <input
								class="form-control" type="text" name="email" id="email-for-pass" required="required"><small
								class="form-text text-muted">Ingrese la dirección de correo electrónico registrada. Pues
								envie una OTP por correo electrónico a esta dirección.</small>
						</div>
						
						<div class="form-group">
							<label for="email-for-pass">Ingresa la Contraseña de aplicaciones</label> <input
								class="form-control" type="text" name="conaplicacion" id="conaplicacion" required=""><small
								class="form-text text-muted">Ingrese la contraseña que esta dentro del Gmail registrada. 
								La contraseñas de aplicaciones esta dentro de la verificación de 2 pasos.</small>
						</div>
						
						
					</div>
					<div class="card-footer">
						<button class="btn btn-success" type="submit">Obtener nueva contraseña</button>
						

						<a href="../login.php" class="btn btn-danger">Atrás para iniciar sesión</a>
		
						</div>
						
							
							
							
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type='text/javascript'
		src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>
	
</body>
</html>