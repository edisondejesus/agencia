<?php

if(isset($_POST['guardar'])){

	$host = $_POST['host_database'];

	$usuario = $_POST['usuario_database'];

	$clave_database = $_POST['clave_database'];

	$usuario_cuenta =$_POST['usuario_cuenta'];

	$clave_cuenta = $_POST['clave_cuenta'];

	$clave_cuenta2 = $_POST['clave_cuenta2'];


	if($clave_cuenta!=$clave_cuenta2){

		echo "<strong>Las contraseñas no son iguales</strong>";

		header("location:install.php");
	}

	echo "$host,$usuario,$clave_database";

	$conectar = new mysqli($host,$usuario,$clave_database);
	$SQL ="create database agencias";

	if($conectar->query($SQL)===true){

		$sql="insert into usuario(usuario,clave)values(?,?)";
		$guardar_user = $conectar->prepare($sql);
		$guardar_user->bind_param('ss',
			$usuario,
			$clave
		);

		echo "<strong>El Sistema se instalo correctamente</strong>";

	}else{

		echo "<strong>Conexion incorrecta a base de datos</strong>";

	}





}





?>