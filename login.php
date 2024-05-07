




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale-1.0">


<title>Aula Virtual</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrapValidator.css">
<link rel="stylesheet" href="../css/styledd.css" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link href="../imagen/logotiposbp.ico" type="image/x-icon" rel="shortcut icon" />


<link rel="stylesheet" href="../css/normalize.css">

<link rel="stylesheet" href="../css/estilostt.css">








</head>

<body>
	
	
	
	
	
	
	
	
	<div class="contenedor-formulario contenedor">
	
		<div class="imagen-formulario">
		
		</div>
		
		
		
		<div  class="wrapper">
			
			
			
			<form id="panel-i" action="../panel_inicio.php" method="post">
			
			<button type="submit" class="close" data-dismiss="modal" 
		  	aria-hidden="true">&times;</button>
		  	</form>
		  	




			  


		  	<form action="../usuario-rol.php" method="post">

				
			  


			
			<center><div class="brand">
						
						
			<img src="../imagen/logoCPSBP.png" id="logo" class="animated flipInX" width="130" height="130">
						
						
					</div></center>
			
			
			<h1 style="font-size: 24px;">Iniciar Sesion</h1>
			
			<h1 style="font-size: 16px; text-align: left; margin: 0 auto; width: 97%;">Por favor, ingresa tu correo y contraseña, para poder identificarte.</h1>
			<?php 
            if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error'] ?> </p>
            <?php } ?>

			


				<input type="hidden" name="tipo" value="iniciarSesion" />
				
			
				<div class="input-box">
					

					<input type="text" id="usuario" name="usuario" placeholder="Ingresa tu Usuario" required/>
					<i class='bx bxs-user'></i>
				</div>
				
				
				<div class="input-box">
				
				
					
					
					
					<input id="myInput" 
					type="password" 
					
					name="password" 
					placeholder="Ingresa tu contraseña" required/>
					
					<span class="eye" onclick="myFunction()">
					<i id="hide1" class="bx bx-show"></i>
					<i id="hide2" class="bx bx-hide"></i>
					
					</span>
					
					
					
					
				</div>

				
				<div class="remember-forgot">
				<a href="../forgotPassword.php" style="color:blue;text-align: center; margin: 0 auto; width: 80%; ">Recuperar Contraseña?</a>
				</div>
				
				
				
				<button name="btningresar" type="submit" class="btn">Iniciar sesión</button>
				

				
				
				
				
				
			</form>

			<form id="panel-i" action="../panel_inicio.php" method="post">
			
			<button type="submit" class="close" data-dismiss="modal" 
		  	aria-hidden="true">&times;</button>
		  	</form>



		</div>
		
		
		
	</div>
        
	
	
	
	
	
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<script src="../js/bootstrapValidator.js"></script>
	<script src="../js/script.js"></script>
	


    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>




	
	<script>
	
		function myFunction(){
			var x = document.getElementById("myInput");
			var y = document.getElementById("hide1");
			var z = document.getElementById("hide2");
			
			
			if(x.type === 'password'){
				x.type = "text";
				y.style.display = "block";
				z.style.display = "none";
			}else{
				x.type = "password";
				y.style.display="none";
				z.style.display="block";
			}
			
			
			
			
			
			
		}
	
	
	
	</script>
	
	
	
	
	
	
	
	
	
</body>




</html>