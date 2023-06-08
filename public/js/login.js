$(function () {

	
	 $('#frm_login').submit(function (e) {
		
		//alert('aquiii');


      usu= $('#txt_usua').val();
	  pass= sha1($('#txt_pass').val().toString());
		
		
		$.ajax({
            url: 'auth/login/',
           // async: false,
            dataType: 'json',
            type: 'POST',
            data: {
               usu: usu,
               pass: pass.toString(),
              
            },
			success:function(data){
				switch (data.resu) {
					case 0:
						redireccion('inicio');
						break;

						case 2:
							Swal.fire({
								//position: 'top-end',
								icon: 'error',
								title: 'Usuario o contraseña Incorrecta',
								showConfirmButton: false,
								timer: 2000
							  });
						break;
					default:
						alert('Error con el Usuario o Contraseña');
					
				}


			  },
		
		});
		e.preventDefault();
	 });		

	

	 function redireccion(contr, meth) {
		location.replace("/Carnet/" + contr + (meth ? "/" + meth : ""));
	 }
	
	function sha1(valo) {
	return CryptoJS.SHA1(valo);
	}



});

 // Filtrar la cedula para ver las tallas
    $(document).on("click", ".busq_trab", function() {
       
        alert('aqui'); 
        
        var ced = $("#txt_ced_tra").val();
        if (ced === "") {
            alert("Debe Ingresar la  Cedúla del Trabajador");
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "Carnet/trab_filt",
                data: {
                    ced: ced
                },
                success: function(json) {
                    if (json.resu == 0) {
                        $("#tx_pri_nom").val(json.nom_tra);
                        $("#tx_pri_ape").val(json.ape_tra);
                        $("#cod_d").val(json.dep_tra);       
                    } else {
                        alert(json.resu);
                    }
                  //  refreshGrid();
                }
            });
        }
    });
    
