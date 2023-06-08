// JavaScript Document

// $(document).on("click", "#btn_busq_trab", function() {
	
// 	ced = $("#txt_ced_tra").val();
// //alert(ced); exit();

// 	//var cedu = $("#txt_ced_tra").val();
// 	if (ced === "" ) {  
// 		alert("Debe Ingresar la  Cedúla del Trabajador");
// 	}
// 	else {
// 		$.ajax({
// 			type: "POST",
// 			dataType: "json",
// 			url: "Trabajadores/trab_filt",
// 			data: {
// 				ced: ced
// 				//cedu: cedu
// 			},
// 			success: function(json) {
// 				  //refreshGrid();
// 					if (json.resu === 0) {
// 					$("#cedu").val(json.cedula);
// 					$("#txt_pri_nom").val(json.txt_nom);
// 					$("#txt_pri_ape").val(json.ape_tra);
// 					$("#cod_dep").val(json.dep);
				   
// 				 //   $("#val").val(json.data_val);
					
// 					if (json.fot_trab === null) {
// 						$("#fot_tra").html('<img src="/Carnet/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
// 					} else {
// 						$("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" >');
						
// 					}
// 					if (json.cont === 0) {
						
						
// 						$("#fot_tra").html('<img src="/Carnet/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
// 					}  

// 				} else {
// 					 alert(json.resu);
					 
					 
					 
// 				}
// 			   refreshGrid();

// 			}
// 		});
// 	}
// });


$(document).on('click', '.btn_bus_tra', function () {
	var tra = $("#txt_trab").val();
	if (tra === '') {
		alert("Indique n° de Cédula");
		return false;
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
					
					$("#cedu").val(json.cedula);
					$("#txt_pri_nom").val(json.txt_nom);
					$("#txt_pri_ape").val(json.ape_tra);
					$("#cod_dep").val(json.dep);

					if (json.btn_emi === 1){
						document.getElementById('val').style.display = 'inline';     
					   } else if (json.data_val === 2) {  
						document.getElementById('val').style.display = 'none';
					   }
					  // refreshGrid();
					   if (json.btn_fot === 1){
						document.getElementById('reg').style.display = 'inline'; 
					   } else if (json.data_reg === 2) {  
						document.getElementById('reg').style.display = 'none';
					   }
					   if (json.fot_trab === null) {
						$("#fot_tra").html('<img src="/Carnet/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
					} else {
						$("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" width="150" height="150" >');
					}
					if (json.cont === 0) {
						
						$("#fot_tra").html('<img src="/Carnet/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
					} 

		else{

			alert(json.resu);
		}
				
		
					
				}
			});

			
		}
	});
}

function redireccion(contr, meth) {
	location.replace("/Carnet/" + contr + (meth ? "/" + meth : ""));
 }
