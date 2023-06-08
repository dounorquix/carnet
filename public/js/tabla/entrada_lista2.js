$(document).ready(function () { 

    var tabladetalle = $("#example1").DataTable({


        ajax: {
            url: base_url + "entrada/listar",
            type: 'POST'


        },
        "responsive": true,
        // "lengthChange": false,
        "autoWidth": false,
        "aLengthMenu": [
            9,
            15,
            25,
            50,
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
                "data": 'factura'
            },
            {
                "data": 'fecha'
            },
            {
                "data": 'proveedor'
            },
            {
                "data": 'acciones'
            },

            // {"defaultContent":"<button type='button' class='eliminar btn btn-success btn-sm'><span class='fa fa-edit'></span></button>"},
        ],


        "columdefs": [
            {
                "width": "10%",
                "targets": 0
            }, {
                "width": "20%",
                "targets": 3
            }, {
                targets: 3,
                className: 'text-center'
            }
        ]
    });

});

$(document).on("click", "#ent_reg", function (e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $.ajax({
        url: base_url + "entrada/setvartemp",
        dataType: "json",
        type: "POST",
        data: {
            acci: 0,
            id: id
        },
        success: function (json) {
            location.replace("/code3_10/" + json.cont + "/" + json.meto);

        }
    });
});


// boton AQUI modulo entrada para continuar el proceso
$(document).on("click", "#sali_cont", function (event) {
    event.preventDefault();

    var fecha = $("#txt_fec_ent").val();
    var txt_orig_entr = $("#txt_orig_entr").val();
    var cmb_depo = $("#cmb_depo option:selected").val();
    var txt_nume_fact = $("#txt_nume_fact").val();
    if (fecha === "") {

        Swal.fire('¡Espera!', 'DEBE INGRESAR LA FECHA', 'info');

    } else {
        if (txt_orig_entr === "") {
            Swal.fire('¡Espera!', 'INDIQUE EL NOMBRE DEL PROVEEDOR', 'info');

        } else {
            if (txt_nume_fact === "") {
                Swal.fire('¡Espera!', 'INDIQUE EL Nº DE FACTURA', 'info');

            } else {
                if (cmb_depo === "") {
                    Swal.fire('¡Espera!', 'SELECCIONE EL ALMACEN', 'info');

                } else {

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
                        success: function (json) {


                            if (json.ent == '') {
                                Swal.fire('¡Espera!', 'NO POSEE PRIVILEGIOS', 'warning');
                            } else {
                                redireccion("entrada/detalles");

                            }


                        }
                    });
                }
            }
        }
    }
    return false;

});

// AÑADIR UN PRODUCTO A LA LISTA DE DETALLES DE ENTRADA PRODUCTO
$(document).on("click", "#btn_ann", function (event) {
    gene = $("#cmb_gene :selected").text();
    id_gen = $("#cmb_gene :selected").val();
    tipo = $("#cmb_tipo :selected").text();
    id_tip = $("#cmb_tipo :selected").val();
    prod = $("#cmb_prod :selected").text();
    id_prod = $("#cmb_prod :selected").val();
    talla = $("#cmb_talla :selected").text();
    id_talla = $("#cmb_talla :selected").val();
    id_entr = $("#txt_cant2").val();
    cantidad = $("#txt_cant").val();
    tot_cant = 0;
    if (id_gen === "" || id_tip === "" || id_prod === "" || id_talla === "" || cantidad === "") { // alert("DEBE INGRESAR LOS DATOS SOLICITADOS");
        Swal.fire('¡Espera!', 'NO PUEDE FINALIZAR UN REGISTRO SIN DATOS', 'info');
    } else {
        if (cantidad <= 0) {

            Swal.fire('¡Espera!', 'CANTIDAD DEBE SER MAYOR A 0', 'info');
           
        } else {
            $.ajax({
                url: "/code3_10/entrada_producto/guardar",
                dataType: "json",
                type: "POST",
                data: {
                    gene: gene,
                    tipo: tipo,
                    id_prod: id_prod,
                    prod: prod,
                    id_talla: id_talla,
                    talla: talla,
                    cantidad: cantidad,
                    id_entr: id_entr
                },
                success: function (data) {

                    $("#example2").DataTable().destroy();
                    fetchpro();
                    // tablalista.ajax.reload(null, false);

                    // refreshGrid();
                }
            });
        }
    }

});


function fetchpro(event) {
    // tablalista.distroy();
    // alert('aqui');

    var tablalista = $("#example2").DataTable({


        ajax: {
            url: base_url + "entrada_producto/listar",
            type: 'POST'


        },
        "responsive": true,
        // "lengthChange": false,
        "autoWidth": false,
        "aLengthMenu": [
            9,
            15,
            25,
            50,
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
                "data": 'producto'
            },
            {
                "data": 'tipo empleado'
            },
            {
                "data": 'genero'
            }, {
                "data": 'talla'
            }, {
                "data": 'cantidad'
            }, {
                "data": 'accion'
            },

            // {"defaultContent":"<button type='button' class='eliminar btn btn-success btn-sm'><span class='fa fa-edit'></span></button>"},
        ],


        "columdefs": [
            {
                "width": "10%",
                "targets": 0
            }, {
                "width": "20%",
                "targets": 3
            }, {
                targets: 3,
                className: 'text-center'
            }
        ]
    });

    event.preventDefault();
}


// Eliminar producto de una entrada 'entradaproducto'
// Eliminar producto

$(document).on("click", ".ent_pro_del", function (event) { // //	alert('aqui');
    var id = $(this).attr("id");
    Swal.fire({
        title: 'Esta seguro que desea eliminar este registro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/entrada_producto/eliminar",
                data: {
                    id: id
                },
                success: function (json) {
                    if (json.resu === 0) {
                        Swal.fire('¡Borrado!', 'Su producto ha sido eliminado.', 'success')
                        $("#example2").DataTable().destroy();
                        fetchpro();
                    }
                }
            });

        }
    })


});

$(document).on("click", ".btn-view", function(){

// $(".btn-view").on("click", function(){


 var id = $(this).val();

 //alert(id);

 $.ajax({
url: "/code3_10/entrada/view",
type:"POST",
data: {
                    id: id
                },

success:function(resp){

     //$("#view").html(resp);
     $("#modal-lg .modal-body").html(resp);

}
 
 });

});
$(document).on("click",".btn-print",function(){
    $("#modal-lg .modal-body").print()
});

$(document).on("click","#btn-print",function(){
    $("#modal-lg .modal-body").print()
});



function cambiar() {
    return confirm('Esta seguro que desea cambiar el producto?');
}
function finalizar() {

    return confirm('Esta seguro que desea finalizar este registro?');
}

function redireccion(contr, meth) {
    location.replace("/code3_10/" + contr + (meth ? "/" + meth : ""));
}


$(document).on("click", "#btn_cerr", function (event) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Esta seguro que desea finalizar este Registro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Finalizar!',
        cancelButtonText: 'No!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/entrada_producto/cerrar",
                success: function (json) {
                    if (json.mens == 'vacio') {
                        Swal.fire('¡Espera!', 'NO PUEDE FINALIZAR UN REGISTRO SIN DATOS', 'info')
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire('Cancelar', 'registro Salvado :)', 'error')
                    } else {

                        finalizar();
                    }


                }
            });


        } else {}
    })
});

function finalizar() { // return confirm('Esta seguro que desea finalizar este registro?');

    redireccion("entrada");
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro Finalizado',
        showConfirmButton: true,
        timer: 91500
    });

}
