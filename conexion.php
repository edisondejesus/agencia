<?php
	

	class conexion {


	  	 function conectar(){


			$conexion = new mysqli('localhost','root','','agencia');

			return $conexion;



		}





	}






?>