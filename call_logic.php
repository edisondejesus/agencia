<?php
require('logica.php');

	date_default_timezone_set('America/Santo_Domingo');
	$servicios = new agencia();

	$action = $_POST['action'];

	if($action=="cargar_servicios"){


		$servicios->cargar_servicios();




	}else if($action=="cargar_locacion"){


		$servicios->cargar_locacion();

	}else if($action=="cargar_agencia"){


		$servicios->cargar_agencia();

	}else if($action=="guardar_servicio"){

		$servicios->guardar_servicio($_POST['nombre_servicio'],$_POST['servicio_descripcion']);

	}else if($action=="actualizar_servicio"){

			$ready =  $_POST['ready'];

			if($ready=='false'){

			
				$servicios->cargar_servicios($_POST['id_servicio']);

		    }else if($ready=='true'){
		    	//actualizando el servicio


		    	$servicios->actualizar_servicio($_POST['servicio_id'],$_POST['nombre_servicio'],$_POST['servicio_descripcion']);


		    }
			//$servicios->guardar_servicio($_POST['nombre_servicio'],$_POST['servicio_descripcion'],$_POST['id_servicio']);



	}else if($action=="eliminar_servicio"){

		$servicios->eliminar_servicio($_POST['id_servicio']);


	}else if($action=="guardar_agencia"){


		$servicios->guardar_agencia($_POST['nombre_agencia'],$_POST['pagina_web'],$_POST['email'],$_POST['telefono'],$_POST['direccion']);



	}else if($action=="eliminar_agencia"){

			$servicios->eliminar_agencia($_POST['id_agencia']);

	}else if($action=="actualizar_agencia"){

		$ready = $_POST['ready'];

		if($ready=='false'){

			$servicios->cargar_agencia($_POST['id_agencia']);
		  
	
	    
	    }else if($ready=='true'){

			  $servicios->actualizar_agencia($_POST['nombre_agencia'],$_POST['pagina_web'],$_POST['email'],$_POST['telefono'],$_POST['direccion'],$_POST['id_agencia']);

	    }
	}else if($action=="guardar_locacion"){

		$servicios->guardar_locacion($_POST['nombre_locacion'],$_POST['pagina_web'],$_POST['email'],$_POST['direccion'],$_POST['telefono']);

	}else if($action=="actualizar_locacion"){

		$ready=$_POST['ready'];

		if($ready=='true'){
			
			$servicios->actualizar_locacion($_POST['nombre_locacion'],$_POST['pagina_web'],$_POST['email'],$_POST['direccion'],$_POST['telefono'],$_POST['locacion_id']);

		}else if($ready=='false'){

				$servicios->cargar_locacion($_POST['locacion_id']);

		}	
 		

	}else if($action=="guardar_reservacion"){

		///echo $_POST['referencia'];

		$servicios->guardar_reservacion($_POST['referencia'],$_POST['nombre_pax'],$_POST['no_pax'],$_POST['fecha_servicio'],$_POST['vuelo'],$_POST['hora_servicio'],$_POST['servicio_id'],$_POST['locacion_id'],$_POST['id_agencia'],$_POST['comentarios']);

	}else if($action=="cargar_reservacion"){


		$servicios->cargar_reportes();

	}else if($action=="eliminar_reservacion"){


			$servicios->eliminar_reservacion($_POST['id_reservacion']);


	}else if($action=="eliminar_locacion"){


		$servicios->eliminar_locacion($_POST['id_locacion']);

	}else if($action=="cargar_reportes_rango"){

		$servicios->cargar_reportes($_POST['fecha_inicial'],$_POST['fecha_final']);
	
	}else if($action=="nombre_agencia_filtrer"){



		$servicios->filtrar_reportes("buscar_agencia",$_POST['nombre_agencia']);



	}else if($action=="nombre_pax_filtrer"){


		$servicios->filtrar_reportes("buscar_pack",$_POST['nombre_pax']);

	}else if($action=="paginar_reporte"){


		$servicios->filtrar_reportes('paginar','',$_POST['pagina']);
	
	}else if($action=="login"){


			$servicios->login($_POST['usuario'],$_POST['clave']);
	

	}



























?>