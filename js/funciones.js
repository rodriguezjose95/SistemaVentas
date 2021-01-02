
/*-------------------------------------------------------------------------------------*/
/*--------------------------FUNCIONES PARA REGISTRAR CLIENTES--------------------------*/
/*-------------------------------------------------------------------------------------*/

function agregarCliente(nombres,apellidos,sexo,tipo_doc,num_doc,celular,correo,departamento,provincia,distrito,direccion,clase){
	cadena="nombres=" + nombres + 
			"&apellidos=" + apellidos +
			"&sexo=" + sexo +
			"&tipo_doc=" + tipo_doc +
			"&num_doc=" + num_doc +
			"&celular=" + celular +
			"&correo=" + correo +
			"&departamento=" + departamento +
			"&provincia=" + provincia +
			"&distrito=" + distrito +
			"&direccion=" + direccion +
			"&clase=" + clase;

	$.ajax({
		type:"POST",
		url:"php/agregarCliente.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				if(r == 1){
					alertify.confirm('Cliente Encontrado', 'El numero de documento ya esta registrado, ¿desea continuar y actualizar los datos?'
					, function(){
						actualizarCliente(cadena);
					 }
					, function(){ 
						alertify.error('Cancelado')
					 }
					);
				}

				else{
					$(location).attr('href','seleccionarProducto.php?c='+r);
					alertify.success("Guardado con Exito");
				}
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function actualizarCliente(cadena){
	$.ajax({
		type:"POST",
		url:"php/actualizarCliente.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','seleccionarProducto.php?c='+r);
				alertify.success('Datos Actualizados');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function consultarDocCliente(num_doc){
	cadena = "num_doc=" + num_doc;

	$.ajax({
		type:"POST",
		url:"php/consultarDocCliente.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				if(r == 2){
					alertify.alert('Documento no Registrado','No existe Cliente con este Número de Documento');
				}
				else{
					d=r.split('||');
					alertify.alert(d[1]+' '+d[2],'Cliente encontrado, se cargarán sus datos');
					$('#id-cli').val(d[0]);
					$('#nombres-cli').val(d[1]);
					$('#apellidos-cli').val(d[2]);
					$('#sexo-cli').val(d[3]);	
					$('#tdoc-cli').val(d[4]);	
					$('#ndoc-cli').val(d[5]);	
					$('#celular-cli').val(d[6]);	
					$('#correo-cli').val(d[7]);	
					$('#departamento-cli').val(d[8]);	
					$('#provincia-cli').val(d[9]);	 
					$('#distrito-cli').val(d[10]);	
					$('#direccion-cli').val(d[11]);
					$('#clase-cli').val(d[12]);
				}
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function limpiarAgregarCliente(){
	$('#id-cli').val('');
	$('#nombres-cli').val('');
	$('#apellidos-cli').val('');	
	$('#sexo-cli').val(1);	
	$('#tdoc-cli').val(1);	
	$('#ndoc-cli').val('');	
	$('#celular-cli').val('');	
	$('#correo-cli').val('');	
	$('#departamento-cli').val(1);	
	$('#provincia-cli').val('');	
	$('#distrito-cli').val('');	
	$('#direccion-cli').val('');
	$('#clase-cli').val(1);
}

/*-------------------------------------------------------------------------------------*/
/*-------------------------SELECCIONAR PRODUCTO----------------------------------------*/
/*-------------------------------------------------------------------------------------*/

function seleccionarProducto(idcli,idprod){
	alertify.confirm('Producto Seleccionado', '¿Seguro que desea seleccionar este producto?'
		, function(){
			$(location).attr('href','registrarPedido.php?c=' + idcli + '&p=' + idprod);
		 }
		, function(){ 
			alertify.error('Cancelado')
		 }
	);
}

/*-------------------------------------------------------------------------------------*/
/*-----------------------------REGISTRAR PEDIDO----------------------------------------*/
/*-------------------------------------------------------------------------------------*/

function costoEntrega(id,monto){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"php/costoEntrega.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$('#costoentrega-reg').val(r);
				$('#montototal-reg').val(r*1 + monto*1);
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function costoEntregaPed(id,monto){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"php/costoEntrega.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$('#costoentrega-ped').html(r);
				$('#montototal-ped').html(r*1 + monto*1);
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function grabarPedido(iduser,idcli,tipodoc,numdoc,correo,departamento,
	provincia,distrito,direccion,idprod,cantidad,formapago,entrega,estado,canal,comentario){

	cadena="iduser=" + iduser + 
			"&idcli=" + idcli +
			"&idprod=" + idprod +
			"&cantidad=" + cantidad +
			"&formapago=" + formapago +
			"&entrega=" + entrega +
			"&estado=" + estado +
			"&tipodoc=" + tipodoc +
			"&numdoc=" + numdoc +
			"&correo=" + correo +
			"&departamento=" + departamento +
			"&provincia=" + provincia +
			"&distrito=" + distrito +
			"&direccion=" + direccion +
			"&canal=" + canal +
			"&comentario=" + comentario;

	$.ajax({
		type:"POST",
		url:"php/agregarPedido.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','verPedido.php?p='+r);
				alertify.success('Pedido Guardado ('+r+')');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});

}

function guardarComentario(idped,comentario){
	cadena="idped=" + idped + 
			"&comentario=" + comentario;

	$.ajax({
		type:"POST",
		url:"php/agregarComentario.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','verPedido.php?p='+r);
				//$('#tabla-comentario').load('verPedido.php #tabla-comentario');
				//alertify.success('Comentario Guardado');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function editarPedido(id,cantidad,entrega,pago,estado){
	cadena="id=" + id + 
			"&cantidad=" + cantidad +
			"&pago=" + pago +
			"&entrega=" + entrega +
			"&estado=" + estado;

	$.ajax({
		type:"POST",
		url:"php/editarPedido.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','verPedido.php?p='+r);
				//alertify.success('Pedido Actualizado');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function seleccionarPedido(id){
	alertify.confirm('Pedido Seleccionado', '¿Seguro que desea seleccionar este Pedido?'
		, function(){
			$(location).attr('href','verPedido.php?p=' + id);
		 }
		, function(){ 
			alertify.error('Cancelado')
		 }
	);
}

function grabarVenta(id,iduser){
	cadena="id=" + id;

	$.ajax({
		type:"POST",
		url:"php/agregarVenta.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','historial-ventas.php');
				//alertify.success('Pedido Actualizado');
				//alertify.alert('Vendido','Venta efectuada con Exito Cod('+r+')');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

/*-------------------------------------------------------------------------------------*/
/*-----------------------------HISTORIAL DE VENTAS-------------------------------------*/
/*-------------------------------------------------------------------------------------*/

function preguntarActualizar(id){
	alertify.confirm('Confirmar', '¿Seguro que desea subir el estado de la venta?'
		, function(){
			actualizarEstadoVenta(id);
		 }
		, function(){ 
			alertify.error('Cancelado')
		 }
	);
}

function actualizarEstadoVenta(id){
	cadena="id=" + id;

	$.ajax({
		type:"POST",
		url:"php/actualizarEstadoVenta.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','historial-ventas.php');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

/*-------------------------------------------------------------------------------------*/
/*-------------------------------CONFIGURACION DE USUARIOS-----------------------------*/
/*-------------------------------------------------------------------------------------*/

function cambiarPassword(id,pass_act,pass_neo){
	cadena="id=" + id +
		   "&pass_act=" + pass_act +
		   "&pass_neo=" + pass_neo;

	$.ajax({
		type:"POST",
		url:"php/cambiarPassword.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				if(r == 1){
					$(location).attr('href','configuracion.php');
				}
				else{
					alertify.alert('Error',r);
					$('#pass-actual').val('');
					$('#pass-nuevo').val('');
				}
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}

function guardarCambiosConfig(id,celular,correo){
	cadena="id=" + id +
		   "&celular=" + celular +
		   "&correo=" + correo;

	$.ajax({
		type:"POST",
		url:"php/guardarCambiosConfig.php",
		data:cadena,
		success:function(r){
			if(r != ''){
				$(location).attr('href','configuracion.php');
			}else{
				alertify.error("Fallo el Servidor");
			}
		}
	});
}









