//Pagina actual de reporte que usa la funcion de paginar reporte como referencia de la pagina actual
var pagina = 1;

function cargar_servicios(){
	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_servicios'	
		}

	
	}).done(data=>{
		console.log(data);
		var info = JSON.parse(data);
		var servicios = `<table class='table'>
		<tr>
			<td>Nombre Servicio</td>
			<td>Descripcion</td>
			<td>Actualizar</td>
			<td>Eliminar</td>
		</tr>
		`;
		info.forEach(key=>{

			servicios+=`<tr id='${key.servicio_id}'>
				<td>${key.nombre_servicio}</td>
				<td>${key.description}</td>
				<td ><img src='assets/update.png' class='menu_icon' onclick="actualizar_servicio(${key.servicio_id})"></td>
				<td><img src='assets/delete.png' class='menu_icon' onclick="eliminar_servicio(${key.servicio_id})"></td>
			</tr>`;

		});

		servicios+="</table>";
		$('#servicios').html(servicios);

	});




}

function imprimir(){

	$('#reportes').printThis({
	importCSS:false,
    loadCSS: "http://banners.local/agencia/css/print.css",
    header: "<h1>LAS VEGAS INTERNATIONAL TOURS SERVICES</h1>"});
	//$('#reportes').addClass("col-md-9")


}

function cabeza_de_reporte(){

	return `<h2>Reportes del dia de hoy</h2>
		<strong>Fecha inicio</strong>
			<input type="date" name="" id="fecha_inicio">
			<strong>Fecha fin</strong>
			<input type="date" name="" id="fecha_fin">
			<input type='text' placeholder='nombre de agencia' id='nombre_de_agencia'>	
			<input type='text' placeholder='nombre pax' id='nombre_de_pax'>
			<button class='btn btn-dark' onclick="buscar_por_fechas()" id='buscar' style='margin-bottom: 5px;'>Buscar</button>
	`;

}

function buscar_por_fechas(){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_reportes_rango',
			fecha_inicial:$('#fecha_inicio').val(),
			fecha_final:$('#fecha_fin').val()
		}


	}).done(data=>{

		console.log(data);
		var reports = JSON.parse(data);

		interface_ver_reportes(reports);	



	});



}

function nombre_agencia_filtrer(agencia_nombre){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'nombre_agencia_filtrer',
			nombre_agencia:agencia_nombre
		}

	}).done(data=>{
		console.log(data)
		var reportes = JSON.parse(data);
		var  reporters_filtrado= "";
		reportes.forEach(key=>{


			reporters_filtrado+=`<div class='reportes'>
			REF# &nbsp&nbsp&nbsp&nbsp${key.referencia} NOMBRE PAX: ${key.nombre_pax}&nbsp&nbsp&nbsp&nbsp AGENCIA: ${key.nombre_agencia}<br>
			SERVICIO:&nbsp&nbsp&nbsp&nbsp${key.nombre_servicio}     HORA:&nbsp&nbsp&nbsp&nbsp ${key.hora_servicio}&nbsp&nbsp&nbspVUELO:&nbsp&nbsp${key.vuelo}    HOTEL:&nbsp&nbsp&nbsp${key.nombre_locacion}<br>
			COMENTARIOS: ${key.comentarios}</div></div>`;


		});

		$('#reportes').html(reporters_filtrado);


	});


}

function paginar_reporte(param){
		//Esta variable esta declarada al comienzo del escript
		
		if(param=="avanzar"){

			pagina++;

		}else if(param=="atras"){

			pagina--;
			if(pagina<1){

				pagina=1;
			}
		}

		console.log(pagina);

		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'paginar_reporte',
				pagina:pagina

			}


		}).done(data=>{	
			console.log(data);
			var report_paginar = JSON.parse(data);
			interface_ver_reportes(report_paginar);


		});



}




function nombre_pax_filtrer(nombre_pax){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'nombre_pax_filtrer',
			nombre_pax:nombre_pax
		}

	}).done(data=>{
		console.log(data)
		var reportes_pack = JSON.parse(data);
		var  reporters_filtrado_PACK= "";
		reportes_pack.forEach(key=>{


			reporters_filtrado_PACK+=`<div class='reportes'>
			REF# &nbsp&nbsp&nbsp&nbsp${key.referencia} NOMBRE PAX: ${key.nombre_pax}&nbsp&nbsp&nbsp&nbsp AGENCIA: ${key.nombre_agencia}<br>
			SERVICIO:&nbsp&nbsp&nbsp&nbsp${key.nombre_servicio}     HORA:&nbsp&nbsp&nbsp&nbsp ${key.hora_servicio}&nbsp&nbsp&nbspVUELO:&nbsp&nbsp${key.vuelo}    HOTEL:&nbsp&nbsp&nbsp${key.nombre_locacion}<br>
			COMENTARIOS: ${key.comentarios}</div>`;


		});

		$('#reportes').html(reporters_filtrado_PACK);


	});


}

 
function  interface_ver_reportes(reports){
	/*interface para mostrar reportes solo pasando el objeto de los reporte 
		esta funcion lo lee y imprime en su lugar correspondiente.	
	*/

		var interface_report = cabeza_de_reporte();
		interface_report+="<div id='reportes'>";
		reports.forEach(key=>{


			interface_report+=`<div class='reportes'>
			REF# &nbsp&nbsp&nbsp&nbsp${key.referencia} NOMBRE PAX: ${key.nombre_pax}&nbsp&nbsp&nbsp&nbsp AGENCIA: ${key.nombre_agencia}<br>
			SERVICIO:&nbsp&nbsp&nbsp&nbsp${key.nombre_servicio}     HORA:&nbsp&nbsp&nbsp&nbsp ${key.hora_servicio}&nbsp&nbsp&nbspVUELO:&nbsp&nbsp${key.vuelo}    HOTEL:&nbsp&nbsp&nbsp${key.nombre_locacion}<br>
			COMENTARIOS: ${key.comentarios}</div>`;


		});
		interface_report+="</div>";
		interface_report+=`<br><button class='btn btn-info' style='float:rigth;' onclick='imprimir()'>Imprimir</button>
		<button class='btn btn-primary' onclick="paginar_reporte('atras')">Atras</button><button onclick="paginar_reporte('avanzar')" class='btn btn-primary' style='margin-left:2px;'>Siguiente</button>
		`;
		
		$('#data_read').html(interface_report);

		$('#nombre_de_agencia').keyup(()=>{

			nombre_agencia_filtrer($('#nombre_de_agencia').val());
		});

		$('#nombre_de_pax').keyup(()=>{


			nombre_pax_filtrer($('#nombre_de_pax').val());


		});

	}


function reporte_cargar(){
	//cargar reportes

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_reservacion'	
		}

	
	}).done(data=>{

		var reports = JSON.parse(data);
		
		interface_ver_reportes(reports);


	});


}

function cargar_reservacion(){
	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_reservacion'	
		}

	
	}).done(data=>{
		console.log(data);
		var info = JSON.parse(data);
		var servicios = `<table class='table'>
		<tr>
			<td>Referencia</td>
			<td>Nombre Pax</td>
			<td>No Pax</td>
			<td>Fecha servicio</td>
			<td>Vuelo</td>
			<td>Hora Servicio</td>
			<td>Agencia</td>
			<td>Servicio</td>
			<td>Locacion</td>
			<td>Comentarios</td>
			<td>Actualizar</td>
			<td>Eliminar</td>
		</tr>
		`;
		info.forEach(key=>{

			servicios+=`<tr id='${key.reservacion_id}'>
				<td>${key.referencia}</td>
				<td>${key.nombre_pax}</td>
				<td>${key.no_pax}</td>
				<td>${key.fecha_servicio}</td>
				<td>${key.vuelo}</td>
				<td>${key.hora_servicio}</td>
				<td>${key.nombre_agencia}</td>
				<td>${key.nombre_servicio}</td>
				<td>${key.nombre_locacion}</td>
				<td>${key.comentarios}</td>
				<td ><img src='assets/update.png' class='menu_icon' onclick="actualizar_reservacion(${key.reservacion_id})"></td>
				<td><img src='assets/delete.png' class='menu_icon' onclick="eliminar_reservacion(${key.reservacion_id})"></td>
			</tr>`;

		});

		servicios+="</table>";
		$('#servicios').html(servicios);

	});




}


function cargar_locacion(){
		$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_locacion'	
		}

	
	}).done(data=>{
		console.log(data);
		var info = JSON.parse(data);
		var servicios = `<table class='table'>
		<tr>
			<td>Nombre Locacion</td>
			<td>Pagina Web</td>
			<td>Email</td>
			<td>Telefono</td>
			<td>Direccion</td>
			<td>Actualizar</td>
			<td>Eliminar</td>
		</tr>
		`;
		info.forEach(key=>{

			servicios+=`<tr id='${key.locacion_id}'>
				<td>${key.nombre_locacion}</td>
				<td>${key.pagina_web}</td>
				<td>${key.email}</td>
				<td>${key.telefono}</td>
				<td>${key.direccion}</td>
				<td ><img src='assets/update.png' class='menu_icon' onclick="actualizar_locacion(${key.locacion_id})"></td>
				<td><img src='assets/delete.png' class='menu_icon' onclick="eliminar_locacion(${key.locacion_id})"></td>
			</tr>`;

		});

		servicios+="</table>";
		$('#servicios').html(servicios);




});

}
function cargar_agencias(){
	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			action:'cargar_agencia'	
		}

	
	}).done(data=>{
		console.log(data);
		var info = JSON.parse(data);
		var servicios = `<table class='table'>
		<tr>
			<td>Nombre Agencia</td>
			<td>Pagina Web</td>
			<td>Email</td>
			<td>Telefono</td>
			<td>Direccion</td>
			<td>Eliminar o borrar</td>
		</tr>
		`;
		info.forEach(key=>{

			servicios+=`<tr id='${key.id_agencia}'>
				<td>${key.nombre_agencia}</td>
				<td>${key.pagina_web}</td>
				<td>${key.email}</td>
				<td>${key.telefono}</td>
				<td>${key.direccion}</td>
				<td ><img src='assets/update.png' class='menu_icon' onclick="actualizar_agencia(${key.id_agencia})"></td>
				<td><img src='assets/delete.png' class='menu_icon' onclick="eliminar_agencia(${key.id_agencia})"></td>
			</tr>`;

		});

		servicios+="</table>";
		$('#servicios').html(servicios);

	});




}



function actualizar_servicio(id_servicio){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			ready:false,
			action:'actualizar_servicio',
			id_servicio:id_servicio
		}

	}).done(data=>{
		console.log(data);
		var data = JSON.parse(data);

	
		$(`#${id_servicio}`).html(`
			<td><input type='text' value='${data[0].nombre_servicio}' id='nombre_servicio${id_servicio}'></td>
			<td><input type='text' value='${data[0].description}' id='descripcion_servicio${id_servicio}'></td>
			<td><img src='assets/update.png' class='menu_icon' id="actualizar_servicio_a${id_servicio}"></td>
			<td></td>
			`);




		$(`#actualizar_servicio_a${id_servicio}`).click(()=>{


				$.ajax({
					url:'call_logic.php',
					type:'post',
					data:{
						action:'actualizar_servicio',
						nombre_servicio:$(`#nombre_servicio${id_servicio}`).val(),
						servicio_descripcion:$(`#descripcion_servicio${id_servicio}`).val(),
						servicio_id:id_servicio,
						ready:true

					}


				}).done(data=>{

					$('#adm_servicios').trigger('click');

						console.log(data);
				});



		});


	});


}
	


function actualizar_agencia(id_agencia){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			ready:false,
			action:'actualizar_agencia',
			id_agencia:id_agencia
		}

	}).done(data=>{
		console.log(data);
		var data = JSON.parse(data);

	
		$(`#${id_agencia}`).html(`
			<td><input type='text' value='${data[0].nombre_agencia}' id='nombre_agencia${id_agencia}'></td>
			<td><input type='text' value='${data[0].pagina_web}' id='pagina_web${id_agencia}'></td>
			<td><input type='text' value='${data[0].email}' id='email${id_agencia}'></td>
			<td><input type='text' value='${data[0].telefono}' id='telefono${id_agencia}'></td>
			<td><input type='text' value='${data[0].direccion}' id='direccion${id_agencia}'></td>


			<td><img src='assets/update.png' class='menu_icon' id="actualizar_servicio_a${id_agencia}"></td>
			<td></td>
			`);




		$(`#actualizar_servicio_a${id_agencia}`).click(()=>{

				$.ajax({
					url:'call_logic.php',
					type:'post',
					data:{
						action:'actualizar_agencia',
						nombre_agencia:$(`#nombre_agencia${id_agencia}`).val(),
						pagina_web:$(`#pagina_web${id_agencia}`).val(),
						email:$(`#email${id_agencia}`).val(),
						telefono:$(`#telefono${id_agencia}`).val(),
						direccion:$(`#direccion${id_agencia}`).val(),
						ready:true,
						id_agencia:id_agencia

					}


				}).done(data=>{

					$('#adm_agencias').trigger('click');

						console.log(data);
				});



		});


	});


}


function actualizar_locacion(locacion_id){

	$.ajax({
		url:'call_logic.php',
		type:'post',
		data:{
			ready:false,
			action:'actualizar_locacion',
			locacion_id:locacion_id
		}

	}).done(data=>{
		console.log(data);
		var data = JSON.parse(data);

	
		$(`#${locacion_id}`).html(`
			<td><input type='text' value='${data[0].nombre_locacion}' id='nombre_agencia${locacion_id}'></td>
			<td><input type='text' value='${data[0].pagina_web}' id='pagina_web${locacion_id}'></td>
			<td><input type='text' value='${data[0].email}' id='email${locacion_id}'></td>
			<td><input type='text' value='${data[0].telefono}' id='telefono${locacion_id}'></td>
			<td><input type='text' value='${data[0].direccion}' id='direccion${locacion_id}'></td>


			<td><img src='assets/update.png' class='menu_icon' id="actualizar_servicio_a${locacion_id}"></td>
			<td></td>
			`);




		$(`#actualizar_servicio_a${locacion_id}`).click(()=>{

				$.ajax({
					url:'call_logic.php',
					type:'post',
					data:{
						action:'actualizar_locacion',
						nombre_locacion:$(`#nombre_agencia${locacion_id}`).val(),
						pagina_web:$(`#pagina_web${locacion_id}`).val(),
						email:$(`#email${locacion_id}`).val(),
						direccion:$(`#direccion${locacion_id}`).val(),
						telefono:$(`#telefono${locacion_id}`).val(),
						ready:true,
						locacion_id:locacion_id

					}


				}).done(data=>{

					$('#adm_locacion').trigger('click');

						console.log(data);
				});



		});


	});


}


function eliminar_agencia(id){

	alertify.confirm('Eliminar Agencia','Seguro que deseas eliminar esta agencia',function(){

		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'eliminar_agencia',
				id_agencia:id
			}


		}).done(data=>{

				alertify.success(data);
				$('#adm_agencias').trigger('click');

		});



	},function(){

			alertify.error("Cancel");

	});






}

function eliminar_reservacion(id){

	alertify.confirm('Eliminar Reservacion','Seguro que deseas eliminar esta reservacion',function(){

		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'eliminar_reservacion',
				id_reservacion:id
			}


		}).done(data=>{

				alertify.success(data);
				$('#adm_reservacion').trigger('click');

		});



	},function(){

			alertify.error("Cancel");

	});






}



function eliminar_locacion(id){

	alertify.confirm('Eliminar Locacion','Seguro que deseas eliminar esta Locacion',function(){

		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'eliminar_locacion',
				id_locacion:id
			}


		}).done(data=>{

				alertify.success(data);
				$('#adm_locacion').trigger('click');

		});



	},function(){

			alertify.error("Cancel");

	});






}


function eliminar_servicio(id){

	alertify.confirm('Eliminar Servicio', 'Seguro que deseas eliminar este servicio?', function(){

					$.ajax({
						url:'call_logic.php',
						type:'post',
						data:{
							action:'eliminar_servicio',
							id_servicio:id
						}


					}).done(data=>{

						 alertify.success(data);

						 $('#adm_servicios').trigger('click');
					});



			}
            , function(){

            	 alertify.error('Cancel');


        	});





}

function load_c_box(){
//Cargar combo box
		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'cargar_servicios',
			}


		}).done(servicios=>{

			var svc = JSON.parse(servicios);
			var svc_interface = "";

			svc.forEach(key=>{

				svc_interface+=`<option value='${key.servicio_id}'>${key.nombre_servicio}</option>`;


			});


			$('#select_servicio').html(svc_interface);

		});

		//cargar agencias en combo box
		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'cargar_agencia',
			}


		}).done(servicios=>{

			var svc = JSON.parse(servicios);
			var svc_interface = "";

			svc.forEach(key=>{

				svc_interface+=`<option value='${key.id_agencia}'>${key.nombre_agencia}</option>`;


			});


			$('#select_angencia').html(svc_interface);

		});

		//cargar locacion 
		$.ajax({
			url:'call_logic.php',
			type:'post',
			data:{
				action:'cargar_locacion',
			}


		}).done(servicios=>{

			var svc = JSON.parse(servicios);
			var svc_interface = "";

			svc.forEach(key=>{

				svc_interface+=`<option value='${key.locacion_id}'>${key.nombre_locacion}</option>`;


			});


			$('#select_locacion').html(svc_interface);

		});



}


$('document').ready(function(){
reporte_cargar()






$('#cargar_reportes').click(()=>{

		reporte_cargar();


});

	$('#adm_servicios').click(()=>{
		cargar_servicios();
		var servicio_panel =`<br>
		<div id="forms"></div>
			<div class='card'>
				<p>Control de servicios</p>
				<div class='dashboard_icon'>
				<img src='assets/plus.png' class='img-circle' id='agregar_servicio'><label>Agregar Servicio</label>
				</div>
				<div id='servicios' style='overflow-y:scroll; height:300px;'></div>
			</div>
		`;


		$('#data_read').html(servicio_panel);

		$('#agregar_servicio').click(()=>{


				$('#forms').html(`<div class='card form-modular col-md-5'>
					<strong>Nombre Servicio</strong>
					<input type='text' class='form-control' id='nombre_servicio'><br>
					<strong>Descripcion</strong>
					<textarea class='form-control' id='descripcion_servicio'></textarea><br>
					<button class='btn btn-success' id='guardar_servicio'>Guardar</button><br>
					<div class='' id='result_form' style='display:none'>Gurdado con exito</div>

				</div>`);

				$('#guardar_servicio').click(()=>{

						$.ajax({
							url:'call_logic.php',
							type:'post',
							data:{
								action:'guardar_servicio',
								nombre_servicio:$('#nombre_servicio').val(),
								servicio_descripcion:$('#descripcion_servicio').val()


							}


						}).done(data=>{
							console.log(data);

								if(data=="fail"){

									$('#result_form').addClass("alert alert-danger");
									$('#result_form').text("error al guardar");
									$('#result_form').show('slow');
								}else if(data=="servicio guardado correctamente"){

									$('#result_form').addClass("alert alert-success");
									$('#result_form').text("Guardado con exito");
									$('#result_form').show('slow');
									$('#adm_servicios').trigger('click');

								}

						})

						

				})



		});



	});



	$('#adm_agencias').click(()=>{
		cargar_agencias();
		var servicio_panel =`<br>
		<div id="forms"></div>
			<div class='card'>
				<p>Control de Agencias</p>
				<div class='dashboard_icon'>
				<img src='assets/plus.png' class='img-circle' id='agregar_agencia'><label>Agregar Agencia</label>
				</div>
				<div id='servicios' style='overflow-y:scroll; height:300px;'></div>
			</div>
		`;


		$('#data_read').html(servicio_panel);

		$('#agregar_agencia').click(()=>{


				$('#forms').html(`<div class='card form-modular col-md-5'>
					<strong>Nombre Agencia</strong>
					<input type='text' class='form-control' id='nombre_agencia'><br>
					<strong>Pagina Web</strong>
					<input class='form-control' id='pagina_web'><br>
					<strong>Email</strong>
					<input type='text' class='form-control' id='email'><br>
					<strong>Telefono</strong>
					<input type='text' class='form-control' id='telefono'>
					<strong>Direccion</strong><br>
					<input type='text' id='direccion' class='form-control'><br>
					<button class='btn btn-success' id='guardar_agencia'>Guardar</button><br>
					<div class='' id='result_form' style='display:none'>Gurdado con exito</div>

				</div>`);

				$('#guardar_agencia').click(()=>{

						$.ajax({
							url:'call_logic.php',
							type:'post',
							data:{
								action:'guardar_agencia',
								nombre_agencia:$('#nombre_agencia').val(),
								pagina_web:$('#pagina_web').val(),
								email:$('#email').val(),
								telefono:$('#telefono').val(),
								direccion:$('#direccion').val()
							}


						}).done(data=>{
							console.log(data);

								if(data=="fail"){

									$('#result_form').addClass("alert alert-danger");
									$('#result_form').text("error al guardar");
									$('#result_form').show('slow');
								}else if(data=="agencia guardada con exito"){

									$('#result_form').addClass("alert alert-success");
									$('#result_form').text("Guardado con exito");
									$('#result_form').show('slow');
									$('#adm_agencias').trigger('click');

								}

						})

						

				})



		});



	});


	$('#adm_locacion').click(()=>{
		cargar_locacion();
		var servicio_panel =`<br>
		<div id="forms"></div>
			<div class='card'>
				<p>Control de Locacion</p>
				<div class='dashboard_icon'>
				<img src='assets/plus.png' class='img-circle' id='agregar_servicio'><label>Agregar Locacion</label>
				</div>
				<div id='servicios' style='overflow-y:scroll; height:300px;'></div>
			</div>
		`;


		$('#data_read').html(servicio_panel);

		$('#agregar_servicio').click(()=>{


				$('#forms').html(`<div class='card form-modular col-md-5'>
					<strong>Nombre Locacion</strong>
					<input type='text' class='form-control' id='nombre_locacion'/><br>
					<strong>Pagina web</strong>
					<input id='pagina_web' type='text' class='form-control'/><br>
					<strong>Email</strong>
					<input type='text' id='email' class='form-control'/><br>
					<strong>Direccion</strong></br>
					<input type='text' id='direccion' class='form-control/><br>
					<strong>Telefono</strong><br>
					<input type='text' class='form-control' id='telefono'/><br>

					<button class='btn btn-success' id='guardar_locacion'>Guardar</button><br>
					<div class='' id='result_form' style='display:none'>Gurdado con exito</div>

				</div>`);

				$('#guardar_locacion').click(()=>{
					//alert("click");
						$.ajax({
							url:'call_logic.php',
							type:'post',
							data:{
								action:'guardar_locacion',
									nombre_locacion:$('#nombre_locacion').val(),
									pagina_web:$('#pagina_web').val(),
									email:$('#email').val(),
									direccion:$('#direccion').val(),
									telefono:$('#telefono').val()

							}


						}).done(data=>{
							console.log(data);

								if(data=="fail"){

									$('#result_form').addClass("alert alert-danger");
									$('#result_form').text("error al guardar");
									$('#result_form').show('slow');
								}else if(data=="guardado con exito"){

									$('#result_form').addClass("alert alert-success");
									$('#result_form').text("Guardado con exito");
									$('#result_form').show('slow');
									$('#adm_locacion').trigger('click');

								}

						})

						

				})



		});



	});


$('#adm_reservacion').click(()=>{
		//cargar_locacion();
		var servicio_panel =`<br>
		<div id="forms"></div>
			<div class='card'>
				<p>Control de Reservacion</p>
				<div class='dashboard_icon'>
				<img src='assets/plus.png' class='img-circle' id='agregar_reservacion'><label>Agregar Reservacion</label>
				</div>
				<div id='servicios' style='overflow-y:scroll; height:300px;'></div>
			</div>
		`;

		cargar_reservacion();
		$('#data_read').html(servicio_panel);

		$('#agregar_reservacion').click(()=>{


				$('#forms').html(`<div class='card form-modular col-md-9'>
					<strong>Referencia</strong>
					<input type='text' class='form-control' id='reference'><br>
					<strong>Nombre Pax</strong>
					<input class='form-control' type='form-control' id='nombre_pax'><br>
					<strong>No pax</strong><br>
					<input type='text' id='no_pax' class='form-control'><br>
					<strong>Fecha Serivicio</strong>
					<input type='date' id='fecha_servicio' class='form-control'><br>
					<strong>Vuelo</strong><br>
					<input type='text' id='vuelo' class='form-control'><br>
					<strong>Hora servicio</strong><br>
					<input type='text' class='form-control' id='hora_servicio'><br>
					<strong>Comentarios</strong><br>
					<textarea class='form-control' id='comentarios'></textarea><br>
					<strong>Seleccionar Servicio</strong><br>
					<select id='select_servicio' class='form-control'>

					</select>
					<strong>Seleccionar Locacion</strong><br>
					<select id='select_locacion' class='form-control'>

					</select><br>
					<strong>Seleccionar Agencia</strong><br>
					<select id='select_angencia' class='form-control'>

					</select><br>
					<button class='btn btn-success' id='guardar_reservacion'>Guardar</button><br>
					<div class='' id='result_form' style='display:none'>Gurdado con exito</div>

				</div>`);

				load_c_box();


				$('#guardar_reservacion').click(()=>{
					//alert("click");
						$.ajax({
							url:'call_logic.php',
							type:'post',
							data:{
								action:'guardar_reservacion',
								referencia:$('#reference').val(),
								nombre_pax:$('#nombre_pax').val(),
								no_pax:$('#no_pax').val(),
								fecha_servicio:$('#fecha_servicio').val(),
								vuelo:$('#vuelo').val(),
								comentarios:$('#comentarios').val(),
								hora_servicio:$('#hora_servicio').val(),
								servicio_id:$('#select_servicio').val(),
								locacion_id:$('#select_locacion').val(),
								id_agencia:$('#select_angencia').val()
					

							}


						}).done(data=>{
							console.log(data);

								if(data=="fail"){

									$('#result_form').addClass("alert alert-danger");
									$('#result_form').text("error al guardar");
									$('#result_form').show('slow');
								}else if(data=="guardado con exito"){

									$('#result_form').addClass("alert alert-success");
									$('#result_form').text("Guardado con exito");
									$('#result_form').show('slow');
									$('#adm_reservacion').click('trigger');



								}	

						});

						

				})



		});



	});














});