<!DOCTYPE html>
<html>
<head>
	<title>Instalando Reporte de Agencias</title>
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
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-5"><br><br>
				<h2>Instalando Sistema Agencia</h2>
				<form method="post">
					<strong>Serivdor DB HOST</strong><br>
					<input type="text" name="host_database" class="form-control" placeholder="localhost"><br>
					<strong>Usuario de base de datos</strong><br>
					<input type="text" name="usuario_database" class="form-control" placeholder="root"><br>
					<strong>Contraseña de base datos</strong><br>
					<input type="password" name="clave_database" class="form-control">
					<hr><strong>Usuario</strong>
					<input type="text" name="usuario_cuenta" placeholder="usuario" class="form-control"><br>
					<strong>Contraseña</strong>
					<input type="password" name="clave_cuenta" class="form-control"><br>
					<strong>Repita su contraseña</strong><br>
					<input type="password" name="clave_cuenta2" class="form-control"><br>
					<input type="submit" name="guardar"  class="btn btn-info" value="guardar">
				</form>

				<?php
					require('install_function.php');

				?>
			</div>
		</div>

		<div class="row">
			
		</div>
	</div>
</body>
</html>