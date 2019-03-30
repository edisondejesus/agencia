<?php
include'conexion.php';


	$conexion = new mysqli('localhost','root','','agencia');

/**
 * 
 */
class agencia  extends conexion {



 	function  cargar_servicios($uno_solo=false){
 		global $conexion;

 		if($uno_solo==false){
 		$sql = "select * from servicios order by servicio_id desc";
 	     }else{

 	     	$sql = "select * from servicios where servicio_id='$uno_solo'";

 	     }
 		 $result  = $conexion->query($sql);


 		$data = [];

 		foreach ($result as $key) {

 				$data[] = $key;
 		}


 		echo json_encode($data);


 	}

 	function filtrar_reservaciones($criterio,$conf){
 		global $conexion;
 		//echo $criterio;

 		if($conf=='nombre_pax'){

 			$SQL ="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia,res.reservacion_id from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia where nombre_pax like '%$criterio%' order by reservacion_id desc limit 100";

 		}else if($conf=='referencia'){

 			$SQL ="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia,res.reservacion_id from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia where referencia like'%$criterio%' order by reservacion_id desc limit 100";

 		}

 		$data = [];
 		$resultado = $conexion->query($SQL);

 		foreach ($resultado as $key) {
 		
 				$data[] = $key;
 		}
 		echo json_encode($data);


 	}


 	function actualizar_reservacion($referencia,$nombre_pax,$no_pax,$fecha_servicio,$vuelo,$hora_servicio,$servicio_id,$locacion_id,$id_agencia,$reservacion_id){

 		global $conexion;
 		$sql = "update reservacion set referencia nombre_pax=?,no_pax=?,fecha_servicio=?,vuelo=?,hora_servicio=?,servicio_id=?,locacion_id=?,id_agencia=?,reservacion_id=?";

 		$actualizar = $conexion->prepare('ssisssiiii',
 			$referencia,
 			$nombre_pax,
 			$no_pax,
 			$fecha_servicio,
 			$vuelo,
 			$hora_servicio,
 			$servicio_id,
 			$locacion_id,
 			$id_agencia,
 			$reservacion_id
 		);

 		if($actualizado->execute()){

 			echo "Reservacion actualizada con exito";

 		}else{

 			echo "error al actualizar";

 		}

 	}


 	function cargar_reportes($inicio_fecha="",$fecha_final="",$cargar_uno_solo=false,$id_reservacion=0){

 		$date = date('ymd');
 		global $conexion;	

 	if($cargar_uno_solo==false){

	 		if($inicio_fecha=="" && $fecha_final==""){

	 				
	 				$sql="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia,res.reservacion_id from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia order by reservacion_id desc limit 5";
			}else{

				$sql ="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id 
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia  where fecha_servicio>='$inicio_fecha' and fecha_servicio<='$fecha_final' order by reservacion_id desc limit 5";

			}
	 }else if($cargar_uno_solo==true){

				$sql ="select * from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
					inner join servicios as servi on res.servicio_id=servi.servicio_id 
					inner join agencia as agen on res.id_agencia=agen.id_agencia  where reservacion_id='$id_reservacion'";
	 }

 		$data = [];
 		$resultado = $conexion->query($sql);

 		foreach ($resultado as $key) {
 		
 				$data[] = $key;
 		}
 		echo json_encode($data);

 	}


 function filtrar_reportes($tipo_b,$buscar=null,$inicio=0,$fecha_inicial="",$fecha_final=""){

 		$date = date('ymd');
 		global $conexion;

 			if($tipo_b=='buscar_agencia'){

				$sql="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia  where nombre_agencia like'%$buscar%' and fecha_servicio>='$fecha_inicial' and fecha_servicio<='$fecha_final' order by reservacion_id desc limit 6";

 			}else if($tipo_b=="buscar_pack"){

 				$sql="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia,res.reservacion_id from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia where nombre_pax like '%$buscar%' and fecha_servicio>='$fecha_inicial' and fecha_servicio<='$fecha_final' order by reservacion_id desc limit 6";

 			}else if($tipo_b=='paginar'){
 				
 				$final =5;

 				if($inicio<=1){

 					$inicio = 0;

 				}else if($inicio>1){

 					$inicio = ($inicio * $final) - $final;

 				}

 				$sql="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia  order by reservacion_id desc limit $inicio,$final";
 			
 			}else if($tipo_b=='buscar_referencia'){

 				$sql="select DATE_FORMAT(fecha_servicio,'%m/%d/%y') fecha_servicio,nombre_pax,no_pax,TIME_FORMAT(hora_servicio,'%H:%i')hora_servicio,comentarios,vuelo,nombre_servicio,description,nombre_locacion,nombre_agencia,loc.direccion,referencia,res.reservacion_id from reservacion as res inner join locacion as loc on res.locacion_id=loc.locacion_id
				inner join servicios as servi on res.servicio_id=servi.servicio_id 
				inner join agencia as agen on res.id_agencia=agen.id_agencia where referencia like '%$buscar%' and fecha_servicio>='$fecha_inicial' and fecha_servicio<='$fecha_final' order by reservacion_id desc limit 6";

 			}
 				

 		$data = [];
 		$resultado = $conexion->query($sql);

 		foreach ($resultado as $key) {
 		
 				$data[] = $key;
 		}
 		echo json_encode($data);



 	}

 	function cargar_locacion($una_solo=false){
 		global $conexion;
 		
 		if($una_solo==false){
 		
 			$sql = "select * from locacion";

 		}else{

 				$sql = "select * from locacion where locacion_id='$una_solo'";

 		}

 		$result =$conexion->query($sql);


 		$data = [];

 		foreach ($result as $key) {

 				$data[] = $key;
 		}


 		echo json_encode($data);


 	}


 	function cargar_agencia($solo_uno=false){
 		global $conexion;
 		if($solo_uno==false){
 			
 			$sql = "select * from agencia order by id_agencia desc";
 		
 		}else{

 			$sql = "select * from agencia where id_agencia='$solo_uno'";

 		}

 		 $result = $conexion->query($sql);


 		$data = [];

 		foreach ($result as $key) {

 				$data[] = $key;
 		}


 		echo json_encode($data);




 	}

 	function cargar_reservacion($fecha=""){


 		$sql = "select * from reservacion where fecha_servicio=$fecha";
 		$data = $this->conectar()->query($sql);
 		$datos = [];

 		foreach($data as $key){

 				$datos[] = $key;

 		}

 		echo json_encode($datos);

 	}


	  	 function conectare(){


			$conexion = new mysqli('localhost','root','','agencia');

			return $conexion;



		}

/*
 	function cargar_reservacion($fecha_inicial,$fecha_final){

 		$sql = "select * from reservacion where fecha_servicio>=?  and fecha_servicio<=?";
 		$search = $this->conectar()->prepare($sql);
 		$search->bind_param('ss',
 			$fecha_inicial,
 			$fecha_final
 		);

 		$search->execute();
 		$data = $search->get_result();
 		$reservaciones = [];

 		foreach ($data as $key) {
 		
 			$reservaciones[] = $key;
 		}

 		echo json_encode($reservaciones);

 	}

*/
 	//Crud servicios
	 function guardar_servicio($nombre_servicio,$descripcion){
 		//echo $nombre_servicio." ".$descripcion;
	 	global $conexion;

 		$sql ="insert into servicios(nombre_servicio,description)values(?,?)";
 	//	$this->conectar()->query("insert into servicios(nombre_servicio,description)values('$nombre_servicio','$descripcion')");
 		$guardar_servicio = $conexion->prepare($sql);
 		$guardar_servicio->bind_param('ss',$nombre_servicio,$descripcion);
 		//$guardar_servicio->execute();

 		try{

	 		if( $guardar_servicio->execute() ){

	 			echo "servicio guardado correctamente";
	 		}else {

	 			echo "fail";
	 		}
 	   }catch(Exception $e){

 	   		echo $e->getMessage();
 	   }


 	}


 	function eliminar_servicio($id_servicio){
 		global $conexion;
 			$sql = "delete from servicios where servicio_id=?";
 			$elimiar = $conexion->prepare($sql);
 			$elimiar->bind_param('i',$id_servicio);
 			if($elimiar->execute()){
 				echo "servicio eliminado correctamente";
 			}
 	}


 	function actualizar_servicio($id_servicio,$nombre_servicio,$descripcion){
 		global $conexion;

 //	echo $descripcion;
 		$sql = "update servicios set nombre_servicio=?,description=? where servicio_id=?";
 		$update = $conexion->prepare($sql);
 		$update->bind_param('ssi',$nombre_servicio,$descripcion,$id_servicio);

 		if($update->execute()){
 			echo "servicio actualizado correctamente";
 		}

 	}


 	//Crud Agencias

 	function guardar_agencia($nombre_agencia,$pagina_web,$email,$telefono,$direccion){
 		global $conexion;
 			$sql = "insert into agencia(nombre_agencia,pagina_web,email,telefono,direccion)values(?,?,?,?,?)";
 			$guardar = $conexion->prepare($sql);
 			$guardar->bind_param('sssss',
 				$nombre_agencia,
 				$pagina_web,
 				$email,
 				$telefono, 
 				$direccion
 			);
 			if($guardar->execute()){

 				echo "agencia guardada con exito";
 			}else{

 				echo "fail";
 			}

 	}


 	function actualizar_agencia($nombre_agencia,$pagina_web,$email,$telefono,$direccion,$id_agencia){
 		global $conexion;

 			$sql = "update agencia set nombre_agencia=?,pagina_web=?,email=?,telefono=?,direccion=? where id_agencia=?";
 			$actualizar_agencia = $conexion->prepare($sql);
 			$actualizar_agencia->bind_param('sssssi',
 				$nombre_agencia,
 				$pagina_web,
 				$email,
 				$telefono,
 				$direccion,
 				$id_agencia

 			);
  			if($actualizar_agencia->execute()){
 					echo "actualizado con exito";
 			}else{

 				echo "fail";
 			}
 	}


 	function eliminar_agencia($id_agencia){
 		global $conexion;
 			$sql = "delete from  agencia where id_agencia=?";
 			$eliminar = $conexion->prepare($sql);
 			$eliminar->bind_param('i',$id_agencia);

 			if($eliminar->execute()){
 				echo "eliminado con exito";
 			}


 	}


 	//locacion

 	function guardar_locacion($nombre_locacion,$pagina_web,$email,$direccion,$telefono){
 		//Debug
 		//echo  $nombre_locacion." ".$pagina_web." ".$pagina_web." ".$email." ".$direccion;
 		global $conexion;

 		$sql = "insert into locacion (nombre_locacion,pagina_web,email,direccion,telefono)values(?,?,?,?,?)";
 		$guardar = $conexion->prepare($sql);
 		$guardar->bind_param('sssss',
 				$nombre_locacion,
 				$pagina_web,
 				$email,
 				$direccion,
 				$telefono
 		);

 		if($guardar->execute()){

 			echo "guardado con exito";
 		}else{

 			echo "no se guardo";
 		}

 	}

 	function actualizar_locacion($nombre_locacion,$pagina_web,$email,$direccion,$telefono,$id_locacion){
 		global $conexion;
 		$sql = "update locacion set nombre_locacion=?,pagina_web=?,email=?,direccion=?,telefono=? where locacion_id=?";
 		$update = $conexion->prepare($sql);
 		$update->bind_param('sssssi',
 			$nombre_locacion,
 			$pagina_web,
 			$email,
 			$direccion,
 			$telefono,
 			$id_locacion
 		);
 		if($update->execute()){

 			echo "locacion actualizada con exito";
 		}


 	}

 	function eliminar_locacion($id_locacion){
 		global $conexion;
 		$sql = "delete from locacion where locacion_id=?";
 		$borarr = $conexion->prepare($sql);
 		$borarr->bind_param('i',$id_locacion);

 		if($borarr->execute()){

 			echo "eliminado con exito";
 		}

 	}
 	//crud reservacion

 	function guardar_reservacion($referencia,$nombre_pax,$no_pax,$fecha_servicio,$vuelo,$hora_servicio,$servicio_id,$locacion_id,$agencia_id,$comentarios){

 		global $conexion;

 		$sql = "insert into reservacion(referencia,nombre_pax,no_pax,fecha_servicio,vuelo,hora_servicio,servicio_id,locacion_id,id_agencia,comentarios)values(?,?,?,?,?,?,?,?,?,?)";

 			$guardar_reservacion = $conexion->prepare($sql);

 			$guardar_reservacion->bind_param('ssisssiiis',
 				$referencia,
 				$nombre_pax,
 				$no_pax,
 				$fecha_servicio,
 				$vuelo,
 				$hora_servicio,
 				$servicio_id,
 				$locacion_id,
 				$agencia_id,
 				$comentarios
 			);

 			if($guardar_reservacion->execute()){

 				echo "guardado con exito";
 			}else {

 				echo "no se guardo";
 			}

 	}

 	function actualizar_reservacionS($referencia,$nombre_pax,$no_pax,$fecha_servicio,
 		$vuelo,$hora_servicio,$servicio_id,$locacion_id,$agencia_id,$comentarios,$id_reservacion){

 		global $conexion;

 		$sql = "update reservacion set referencia=?,nombre_pax=?,no_pax=?,fecha_servicio=?,vuelo=?,hora_servicio=?,
 		servicio_id=?,locacion_id=?,id_agencia=?,comentarios=? where reservacion_id=?";

 		$actualizar = $conexion->prepare($sql);
 		$actualizar->bind_param('ssisssiiisi',
 			$referencia,
 			$nombre_pax,
 			$no_pax,
 			$fecha_servicio,
 			$vuelo,
 			$hora_servicio,
 			$servicio_id,
 			$locacion_id,
 			$agencia_id,
 			$comentarios,
 			$id_reservacion
 		);

 		if($actualizar->execute()){

 			echo "actualizado con exito";
 		}

 	}

 	function eliminar_reservacion($id_reservacion){
 		$sql = "delete from reservacion where reservacion_id=?";
 		global $conexion;
 		$eliminar  = $conexion->prepare($sql);
 		$eliminar->bind_param('i',$id_reservacion);

 		if($eliminar->execute()){

 			echo "reservacion eliminada con exito";
 		}


 	}

 	function login($usuario,$clave){
 			global $conexion;
 			$sql = "select * from usuario where usuario=? and clave=?";
 			$logiar = $conexion->prepare($sql);
 			$logiar->bind_param('ss',
 				$usuario,
 				$clave
 			);

 			$logiar->execute();
 			$data = $logiar->get_result();
 			if($data->num_rows>0){

 					$data = mysqli_fetch_object($data);
 					session_start();

 					$_SESSION['usuario'] = $data->usuario;
 					$_SESSION['clave'] = $data->clave;
 					$_SESSION['nombre'] = $data->nombre;
 					$_SESSION['apellido'] = $data->apellido;
 					header("location:index.php");
 			}else{

 				echo "este usuario no existe";
 
 				header("location:login.php");

 			}

 	}


 	public static function total_de_paginas(){
 		global $conexion;
 		$page=0;
 		$recorrido=0;
 		$count = 0;
 		$sql = "select count(reservacion_id)cantidad from reservacion";

 		$cantidad_page = $conexion->query($sql);
 		$reportes = mysqli_fetch_object($cantidad_page);
 		$reportes = $reportes->cantidad;

 		while ($recorrido!=$reportes) {
 				
 			if($count==5){
 				
 				$count = 0;
 				$page+=1;

 				
 				
 			}


 			$count++;
 			$recorrido++;
 		}

 		echo $page;
 	}


}














?>