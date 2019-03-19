<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesion</title>
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
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="container-fluid">

		<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-5"><br><br><br><br><br><br><hr>
									<h1>Iniciar Sesion</h1>

					<form method="post" action="call_logic.php">
						<strong>Usuario</strong>
						<input type="hidden" name="action" value="login">
						<input type="text" name="usuario">
						<strong>Contraseña</strong>
						<input type="password" name="clave"><br><br>
						<button class="btn btn-primary">Conectar</button>
					</form>
				</div>
		</div>		





	</div>
</body>
</html>