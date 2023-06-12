


$(document).on('click', '.btn_bus_tra', function () {
	var tra = $("#txt_trab").val();
	if (tra === '') {
		Swal.fire('¡Espera!', 'Indicar Nª de Cedula', 'info');
						
	//	return false;
	} else {
		buscar_trabajador($('#txt_trab').val());
	}
});


function buscar_trabajador(tra) {
	$.ajax({
		async: false,
		type: "POST",
		url: 'trabajadores/setvartemp/',
		dataType: 'json',
		data: {tra: tra},
		success: function (json) {

			$.ajax({
				async: false,
				type: "POST",
				url: 'trabajadores/trab_filt/',
				dataType: 'json',
				data: {tra: tra},
				success: function (json) {
					
					//alert('prueba');
					
					$("#cedu").val(json.cedula);
					$("#txt_pri_nom").val(json.txt_nom);
					$("#txt_pri_ape").val(json.ape_tra);
					$("#cod_dep").val(json.dep);

					if (json.btn_emi === 1){
						document.getElementById('val').style.display = 'inline';     
					   } else {  
						document.getElementById('val').style.display = 'none';
					   }
					  // refreshGrid();
					   if (json.btn_reg === 1){
						document.getElementById('reg').style.display = 'inline'; 
					   } else  {  
						document.getElementById('reg').style.display = 'none';
					   }
					   if (json.fot_trab === null) {
						$("#fot_tra").html('<img src="/Carnet/public/img/perfil.jpg" alt="Imagen Vistante" width="150" height="150">');
					} else {
						$("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" width="150" height="150" style="border-radius:100px;" >');
					}
					if (json.resu === 1) {
						
						Swal.fire('¡Espera!', 'No existen registros por favor comunicarse con Recursos Humanos', 'error');
						
					
					} 
					
				}
			});

			
		}
	});
}

function redireccion(contr, meth) {
	location.replace("/Carnet/" + contr + (meth ? "/" + meth : ""));
 }
