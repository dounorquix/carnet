
$(document).ready(function () { 

    var tabladetalleinv = $("#example4").DataTable({


        ajax: {
            url: base_url + "inventario_stock/listar",
            type: 'POST'


        },
        "responsive": true,
       // "lengthChange": false,
        "autoWidth": false,
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
                "data": 'producto'
            },
            {
                "data": 'genero'
            },
            {
                "data": 'talla'
            },
            {
                "data": 'cantidad'
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