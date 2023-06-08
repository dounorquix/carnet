
//buscar trabajador 
$(document).on("click", "#btn_busq_trab", function(event) {
       
        var ced = $("#txt_ced_tra").val();
        var reg = document.getElementById('reg');
        var val = document.getElementById('val');

         $("#example3").DataTable().destroy();
                    fich_trab();
        if (ced === "") {
            //alert("Debe Ingresar la  Cedúla del Trabajador");
            Swal.fire('¡Espera!', 'Debe Ingresar la  Cedúla del Trabajador', 'warning');
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/salida/trab_filt",
                data: {
                    ced: ced
                },
                success: function(json) {
                    if (json.resu == 0) {
                        $("#txt_pri_nom").val(json.nom_tra);
                        $("#txt_pri_ape").val(json.ape_tra);
                        $("#cod_dep").val(json.dep_tra);

                        if (json.data_val === 1){
                         val.style.display = 'inline';     
                        } else if (json.data_val === 2) {  
                         val.style.display = 'none';
                        }
                      fich_trab(); 
                        if (json.data_reg === 1){
                         reg.style.display = 'none';  
                        } else if (json.data_reg === 2) {  
                         reg.style.display = 'inline';
                        }
                      fich_trab(); 

                        if (json.fot_trab === null) {
                            $("#fot_tra").html('<img src="/code3_10/public/img/perfil.jpg"  alt="Imagen Vistante" width="150" height="150">');
                        } else {
                            $("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" >');
                        }
                    } else {
                        //alert(json.resu);
                        Swal.fire('¡Espera!', 'No existen registros por favor comunicarse con Recursos Humanos', 'warning');
                    }
                    $("#example3").DataTable().destroy();
                    fich_trab(); 
                }
            });
        }
        event.preventDefault();
    });

    function fich_trab(event) {
        // tablalista.distroy();
        // alert('aqui');
    
        var tablalistar = $("#example3").DataTable({
    
    
            ajax: {
                url: base_url + "salida/listar",
                type: 'POST'
    
    
            },
            "responsive": true,
            // "lengthChange": false,
            "autoWidth": true,
            "aLengthMenu": [
                5,
                10,
                15,
                20,
                -1
            ],
            "language": {
    
                "lengthMenu": "Muestra _MENU_ Registros por Página",
                "zeroRecords": "Usuario no Encontrado - Verifique",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No existe el usuario",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
    
    
            "columns": [
                {
                    "data": 'ref'
                },
                {
                    "data": 'fecha'
                },
                {
                    "data": 'cedula'
                },
                {
                    "data": 'trabajador'
                }, 
                {
                    "data": 'accion'
                },
    
                // {"defaultContent":"<button type='button' class='eliminar btn btn-success btn-sm'><span class='fa fa-edit'></span></button>"},
            ],
    
    
            "columdefs": [
                {
                    "width": "15%",
                    "targets": 0
                }, {
                    "width": "10%",
                    "targets": 3
                }, {
                    "targets": 3,
                    "className": 'text-center'
                }
            ]
        });
    
       // event.preventDefault();
    }

$(document).on("click", ".sal_reg", function(){

// $(".btn-view").on("click", function(){


 var id = $(this).val();

 //alert(id);

 $.ajax({
url: "/code3_10/salida/detalles",
type:"POST",
data: {
                    id: id
                },

success:function(resp){

     //$("#view").html(resp);
     $("#modal-xl .modal-body").html(resp);

}
 
 });

});


//vista de la ficha del trabajador

$(document).on("click", ".reg_sig", function(){

$.ajax({
 url: "/code3_10/salida/detalles_sig",
type:"POST",

 success:function(resp){

      $("#modal-default .modal-body").html(resp);

 }
 
  });

});

// Click al guardar los datos DESDE EL FORM DIALOG     
         $(document).on('click', '#guar_sig', function () {

            //alert('aqui');

         var txt_cedu_sig = $("#txt_cedu_sig").text();
             txt_cedu_sig = txt_cedu_sig.trim();
//                alert("INGRESE EL NUMERO DE CEDULA DEL TRABAJADOR" + txt_cedu_sig);
//                return false;
          $.ajax({
              type: "POST",
              dataType: "json",
            url: "/code3_10/salida/guardar_sig",
            data: {
                txt_cedu_sig: txt_cedu_sig
            },
            async: false,
            success: function (json) {

               // alert(json.mens);
   Swal.fire(
      'Guardar!',
      'El Trabajador a sido registrado.',
      'success'
    )
            $('#modal-default').modal('hide');
            //location.reload();
            }
        });

    });


         //vista de la ficha del trabajador

$(document).on("click", ".ver_mas", function(){

$.ajax({
 url: "/code3_10/trabajadores/detalles",
type:"POST",

 success:function(resp){

      $("#modal-default .modal-body").html(resp);

 }
 
  });

});


//vista de la actualizacion de la talla del trabajador

$(document).on("click", "#act_tal", function(){

   // $('#modal-default').modal('hide');

$.ajax({
 url: "/code3_10/salida/tallatrabajador",
type:"POST",

 success:function(resp){

    $('#modal-default').modal('hide');

      $("#modal-sm .modal-body").html(resp);

 }
 
  });

});

//envio de datos para actualizar talla del trabajador 
    $(document).on("click", "#actu_talla", function(event){

       // console.log('aquiii');

   
        var cam = $("#txt_tall_cami").val();
        var cha = $("#txt_tall_chaq").val();
        var cal = $("#txt_tall_calz").val();
        var bra = $("#txt_tall_brag").val();
        var pan = $("#txt_tall_pant").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/code3_10/salida/guardartalla",
            data: {
                cam: cam,
                cha: cha,
                cal: cal,
                bra: bra,
                pan: pan

            },
            async: false,
            success: function(json) {
                if (json.mens === '') {

                     Swal.fire(
      'Guardar!',
      'Talla Actualizada Exitosamente.',
      'success'
    ); $('#modal-sm').modal('hide');
                    
                } else {
                    Swal.fire('¡Espera!', 'NO POSEE PRIVILEGIOS', 'warning');
                }
            }
        });

        return false;
             event.preventDefault();
    });


    function redireccion(contr, meth) {
        location.replace("/code3_10/" + contr + (meth ? "/" + meth : ""));
    }