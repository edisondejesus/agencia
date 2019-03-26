<!DOCTYPE html>
<html>
<head>
<?php
session_start();
	if(!isset($_SESSION['usuario'])){

			header("location:login.php");

	}


?>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agencia Pedro</title>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" type="text/css" href="">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
  
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/wickedpicker@0.4.3/dist/wickedpicker.min.css">
   <script src="https://cdn.jsdelivr.net/npm/wickedpicker@0.4.3/dist/wickedpicker.min.js""></script>

	<script src="js/printThis.js"></script>

	<script src="js/dashboard.js"></script>


	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-12" style="background: black; height: 50px;">
	<p style="color:gray; padding-top: 10px;">Software agencia</p>
	<p style="color:white;"><?php "Bienvenido! $_SESSION[nombre] $_SESSION[apellido]"?></p>
	<button class="btn btn-danger">Cerrar Sesion</button>
</div>

</div>

<div class="row">
	<div class="col-md-2"><br>
		<div class="card">
			<div class="card-header">
				Menu
			</div>
			<div class="card-boyd">
 			<img src="assets/telegram.png" class="img-circle menu_icon" id="adm_servicios"><label>Adm Serivicios</label>				
									

			<img src="assets/telegram.png" class="img-circle menu_icon" id="adm_agencias"><label>Adm Agencias</label>

			<img src="assets/telegram.png" class="img-circle menu_icon" id="adm_locacion"><label>Adm locacion</label>


			<img src="assets/telegram.png" class="img-circle menu_icon" id="adm_reservacion"><label>Agregar Reservacion</label>	


			<img src="assets/telegram.png" class="img-circle menu_icon" id="cargar_reportes"><label>Listar Reportes</label>				
			
			<img src="assets/telegram.png" class="img-circle menu_icon" id="cerrar_sesion"><label>Cerrar Sesion</label>				


			</div>


			</div>


		</div>

		<div class="col-md-10" id="data_read">

		

	</div>
	</div>






</div>




</div>

</body>
</html>