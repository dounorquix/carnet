
$(document).ready(function(){

  var tabladetalle = $("#example1").DataTable({
    
    ajax :{
      url: base_url+"usuarios/listar",
      type:'POST',
     
      
    },
    "responsive": true,
      //"lengthChange": false,
      "autoWidth": false,
      "aLengthMenu":[9, 15, 25, 50, -1],
      "language": {

           "lengthMenu": "Muestra _MENU_ Registros por Página",
            "zeroRecords": "Usuario no Encontrado - Verifique",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No existe el usuario",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search":"Buscar:",
            "paginate":{
              "next": "Siguiente",
              "previous":"Anterior"
            }
        },
       
       
        "columns":[
          {"data":'N°'},
          {"data":'usuario'},
          {"data":'cedula'},
          {"data":'apellidos'},
          {"data":'nombre'},
          {"data":'tipo de usuario'},
          {"data":'acciones'},

       //  {"defaultContent":"<button type='button' class='eliminar btn btn-success btn-sm'><span class='fa fa-edit'></span></button>"},
      ],
  

      "columdefs":[
        { "width": "10%", "targets": 0 },
        { "width": "20%", "targets": 3 },
        {
          targets: 3,
          className: 'text-center'
        }
      ],       
  });

});




// Filtrar la cedula para ver las usurios del intrasarrhh
    $(document).on("click", ".filt_trab", function(e) {
       
      e.preventDefault();
        
        var ced = $("#txt_ced_tra").val();
        if (ced === "") {
            alert("Debe Ingresar la  Cedúla del Trabajador");
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "usuarios/trab_filt",
                data: {
                    ced: ced
                },
                success: function(json) {
                    if (json.resu == 0) {
                        $("#cedula").val(json.cedula);
                        $("#pri_ape").val(json.ape_tra);
                        $("#txt_nom").val(json.txt_nom);
                        $("#usuario").val(json.usuario);
                        $("#clave").val(json.clave);       
                    } else {
                        alert(json.resu);
                        $('#exampleModal').modal('hide');
                        location.reload();
                    }
                  //  refreshGrid();
                }
            });
        }
    });




// guardar usuario en la base de datos carnetizacion

  $(document).on("click", ".ins_usu", function(e) {

     cedula = $("#cedula").val();
		 nom = $("#txt_nom").val();
     ape = $("#pri_ape").val();
     usu = $("#usuario").val();
		 pass = $("#clave").val();
     tip_usu = $("#tip_usu option:selected").val();

     alert('alert');


    e.preventDefault();
 
        $.ajax({
            url: "usuarios/guardar",
            dataType: "json",
            type: "POST",
            data: {
              cedula:cedula,
		 nom:nom,
     ape:ape,
     usu:usu,
		 pass:pass,
     tip_usu:tip_usu
           
            },
        success: function(json) {

          if (json.resu === 3) {
            alert(json.mens);
        }
        else {
          alert(json.mens);

        }
          //  location.replace("/code3_10/" + json.cont + "/" + json.meto);
          

          }
        });
    });

//eliminar usuario
  $(document).on('click', '.usu_del', function () {

    //  alert('eliminar');

      id_us = $(this).attr('id');

     // alert(id_us);
      
                  $.ajax({
                      type: "POST",
                      url: 'usuarios/eliminar/',
                      dataType: 'json',
                      data:{
id_us:id_us
                      },
                      success: function (json) {
                          switch (json.resu) {
                              case 0:
                                  alert(json.mens);
                                //  refreshGrid();
                                  break;
                              case 1:
                                  alert(json.mens);
                                  break;
                          }
                      }
                  });

              
          });
      
  


		 
		//boton AQUI modulo entrada para continuar el proceso 
    $(document).on("click", "#sali_cont", function(event) {
			event.preventDefault();

			var fecha = $("#txt_fec_ent").val();
			var txt_orig_entr = $("#txt_orig_entr").val();
			var cmb_depo = $("#cmb_depo option:selected").val();
			var txt_nume_fact = $("#txt_nume_fact").val();
			if (fecha === "") {
					alert("DEBE INGRESAR LA FECHA");
			}
			else {
					if (txt_orig_entr === "") {
							alert("INDIQUE EL NOMBRE DEL PROVEEDOR");
					}
					else {
							if (txt_nume_fact === "") {
									alert("INDIQUE EL Nº DE FACTURA");
							}
							else {
									if (cmb_depo === "") {
											alert("SELECCIONE EL ALMACEN");
									}
									else {

											$.ajax({
													type: "POST",
													dataType: "json",
													url: "/code3_10/entrada/guardar",
													data: {
															fecha: fecha,
															txt_orig_entr: txt_orig_entr,
															cmb_depo: cmb_depo,
															txt_nume_fact: txt_nume_fact
													},
													async: false,
													success: function(json) {

                                                        $('#vw').html(json.ent);
                                                        $('.modal-backdrop').remove();


                          //console.log('esto es: ',json.ent);return false;

                                                  /*$.ajax({
                                                    type: "POST",
                                                    //dataType: "json",
                                                    url: "/code3_10/entrada_producto/detalles",
                                                    data: {
                                                            datos: json.ent
                                                    },
                                                    success: function(data) {

                                                        //console.log('esto es: ',data);return false;
                                                        $('#vw').html(data);

                                                        //redireccion("entrada_producto/detalles");


                                                    }

                                                   
                          //console.log('esto es: ',json.ent);
													
													// 		if (json.mens === '') {

													// 				location.reload();
													// 				//redireccion("entrada_producto/detalles");
													// 		} else {
													// 				alert('Usted no posee privilegios');
													// 		}

                                                     });*/
													 }
											});
									}
							}
					}
			}
			return false;
			//event.preventDefault();
			//redireccion("entrada/detalles");
	});

   // AÑADIR UN PRODUCTO A LA LISTA DE DETALLES DE ENTRADA PRODUCTO
    $(document).on("click", "#btn_ann", function(event) {
        gene = $("#cmb_gene :selected").text();
        id_gen = $("#cmb_gene :selected").val();
        tipo = $("#cmb_tipo :selected").text();
        id_tip = $("#cmb_tipo :selected").val();
        prod = $("#cmb_prod :selected").text();
        id_prod = $("#cmb_prod :selected").val();
        talla = $("#cmb_talla :selected").text();
        id_talla = $("#cmb_talla :selected").val();
        id_entr = $("#txt_id_entr").val();
        cantidad = $("#txt_cant").val();
        tot_cant = 0;
        if (id_gen === "" || id_tip === "" || id_prod === "" || id_talla === "" || cantidad === "") {
            alert("DEBE INGRESAR LOS DATOS SOLICITADOS");
        }
        else {
            if (cantidad <= 0) {
                alert("CANTIDAD DEBE SER MAYOR A 0")
            }
            else {
                $.ajax({
                    url: "/code3_10/entrada_producto/guardar",
                    dataType: "json",
                    type: "POST",
                    data: {gene: gene, tipo: tipo, id_prod: id_prod, prod: prod, id_talla: id_talla, talla: talla, cantidad: cantidad},
                    success: function(data) {

                        fetchpro();
                      //  refreshGrid();
                    }
                });
            }
        }

    });


function fetchpro() {
$.ajax({
 url: base_url+"entrada_producto/listar",
                  type: "post",
                  dataType: "json",
                  // desde áca la datatable bootrap
                  success: function(data) {

    if (data.responce == "success") {
 $('#example1').DataTable({
  "data": data.posts,
                          "responsive": true,
                          "autoWidth": false,
                          "aLengthMenu":[9, 15, 25, 50, -1],
                          "language": {
                            "lengthMenu": "Muestra _MENU_ Registros por Página",
                            "zeroRecords": "No Existe el Registro - Verifica",
                            "info": "Mostrando la Página _PAGE_ de _PAGES_",
                            "infoEmpty": "No records available",
                            "infoFiltered": "(filtrado de _MAX_ registros totales)",
                            'search': 'Buscar:',
                            'paginate': {
                              'next': 'Siguiente',
                              'previous': 'Anterior'
                            }
                          },

     "columns":[
                                       {"data":'ref'},
          {"data":'producto'},
          {"data":'tipo empleado'},
           {"data":'genero'},
          {"data":'talla'},
          {"data":'cantida'},
          {"data":'acciones'},
                                    ],

 "columdefs":[
        { "width": "10%", "targets": 0 },
        { "width": "20%", "targets": 3 },
        {
          targets: 3,
          className: 'text-center'
        }
      ], 


  });

                  }
      
      }

  });
 }






function redireccion(contr, meth) {
		location.replace("/code3_10/" + contr + (meth ? "/" + meth : ""));
	 }
