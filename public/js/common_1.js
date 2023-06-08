var id_arti = '';
//javascript
$(document).ready(function() {

    // $(document).on("click", "#menu a", function(event) {
    //     if ($(this).attr("href") === "#") {
    //         event.preventDefault();
    //     }
    // });
   // // $("#formID").validationEngine();
   //  $("#header, #footer").mousedown(function() {
   //      return false;
   //  });
    // $(document).on("click", ".a_volver", function(event) {
    //     event.preventDefault();
    //     location.replace("/code3_10/" + $(this).attr("id"));
    // });
    $(document).on("click", ".btn_canc", function(event) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/code3_10/entrada/delvartemp",
            success: function(json) {
                alert(json.msj);
                $("#html_arreglo").html('');
                $("#txt_canti").val('');
            }
        });
    });
//boton cerrar de entrada producto para el cambio de estatus de la entrada
    $(document).on("click", ".btn_cerr", function(event) {
        if (finalizar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/entrada_producto/cerrar",
                success: function(json) {
                    if (json.mens == 'vacio') {
                        alert('NO PUEDE FINALIZAR UN REGISTRO SIN DATOS');
                    } else {
                        alert('NO PODRAS REALIZAR MODIFICACIONES');
                        location.reload();
                    }
                }
            });
        }
    });
    $(document).on("click", ".btn_cerr_sali", function(event) {
        if (finalizar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/salida_producto/cerrar",
                success: function(json) {
                    if (json.mens == 'vacio') {
                        alert('NO PUEDE FINALIZAR UN REGISTRO SIN DATOS');
                    } else {
                        alert('NO PODRAS REALIZAR MODIFICACIONES');
                        location.reload();
                    }
                }
            });
        }
    });
    $(document).on("submit", "#formID", function() {
        data = $(this).serialize();
        acci = $(this).attr("action");
        if ($(this).validationEngine('validate')) {
            $(this).find(".btn_guar").html("<img src='/sigecaf/public/img/loader.gif' width='16' height='16' style='float:right; margin-right: 168px;'>");
            $.ajax({
                type: "POST",
                dataType: "json",
                url: acci,
                data: data,
                success: function(json) {
                    alert(json.mens);
                    switch (parseInt(json.resu)) {
                        case 0:
                            $.fancybox.close();
                            refreshGrid();
                            break;
                        default:
                            $('formID.btn_guar').html('<input type="submit" class="btn_guar" value="Guardar" style="float:right; margin-right: 153px; cursor:pointer">');
                            break;
                    }
                }
            });
        }
        return false;
    });

    $(document).on("submit", "#formID1", function() {
data = $(this).serialize();
        acci = $(this).attr("action");
        // if ($(this).validationEngine('validate')) {
            $(this).find(".btn_guar").html("<img src='/sigecaf/public/img/loader.gif' width='16' height='16' style='float:right; margin-right: 168px;'>");
            $.ajax({
                type: "POST",
                dataType: "json",
                url: acci,
                data: {acci: 1},
                success: function(json) {
                    alert(json.mens);
                    switch (parseInt(json.resu)) {
                        case 0:
                            $.fancybox.close();
                            refreshGrid();
                            break;
                        default:
                            $('formID1.btn_guar').html('<input type="submit" class="btn_guar" value="Guardar" style="float:right; margin-right: 153px; cursor:pointer">');
                            break;
                    }
                }
            });
      //  }
        return false;
    });
// boton AQUI modulo entrada para continuar el proceso 
    $(document).on("click", ".btn_entr_cont", function(event) {
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
                                if (json.mens === '') {
                                    location.reload();
                                } else {
                                    alert('Usted no posee privilegios');
                                }
                            }
                        });
                    }
                }
            }
        }
        return false;
    });
    // boton AQUI modulo entrada para continuar el proceso 
    $(document).on("click", ".btn_sali_cont", function(event) {
        event.preventDefault();
        var fecha = $("#txt_fec_sal").val();
        var txt_cedu_trab = $("#txt_cedu_trab").val();
        var cmb_depo = $("#cmb_depo option:selected").val();
        var txt_obse_sali = $("#txt_obse_sali").val();
        if (fecha === "") {
            alert("DEBE INGRESAR LA FECHA");
        }
        else {
            if (txt_cedu_trab === "") {
                alert("INGRESE EL NUMERO DE CEDULA DEL TRABAJADOR");
            }
            else {
                if (cmb_depo === "") {
                    alert("SELECCIONE EL ALMACEN");
                }
                else {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/code3_10/salida/guardar",
                        data: {
                            fecha: fecha,
                            txt_cedu_trab: txt_cedu_trab,
                            cmb_depo: cmb_depo,
                            txt_obse_sali: txt_obse_sali
                        },
                        async: false,
                        success: function(json) {
                            if (json.mens === '') {
                                location.reload();
                            } else {
                                alert('Usted no posee privilegios');
                            }
                        }
                    });
                }
            }
        }
        return false;
    });
    //envio de datos para actualizar talla del trabajador 
    $(document).on("click", ".btn_tall_trab", function(event) {
        event.preventDefault();
        var cam = $("#txt_tall_cami").val();
        var cha = $("#txt_tall_chaq").val();
        var cal = $("#txt_tall_calz").val();
        var bra = $("#txt_tall_brag").val();
        var pan = $("#txt_tall_pant").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/code3_10/trabajadores/guardar",
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
                    location.reload();
                } else {
                    alert('Usted no posee privilegios');
                }
            }
        });

        return false;
    });

//envio de datos para actualizar talla y cantidad de productos cambiados al trabajador 
    $(document).on("click", ".btn_camb_prod_trab", function(event) {
        event.preventDefault();
        var txt_alm = $("#txt_alm").val();
        var txt_pro = $("#txt_pro").val();
        var txt_tal = $("#txt_tal").val();
        var cmb_talla_sali = $("#cmb_talla_sali_1 option:selected").val();
        var txt_cam_sal_pro = $("#txt_cam_sal_pro").val();



        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/code3_10/salida_producto/cambio",
            data: {
                pro: txt_pro,
                tal: cmb_talla_sali,
                cam: txt_cam_sal_pro,
                alm: txt_alm,
                tal_ant: txt_tal
            },
            async: false,
            success: function(json) {
                if (json.mens === '') {
                    location.reload();
                } else {
                    alert('Usted no posee privilegios');
                }
            }
        });
        return false;
    });

    $(document).on("button", "#formID", function() {
        $.ajax({
            url: "/code3_10/entrada/setvartemp",
            dataType: "json",
            type: "POST",
        }).success(function(json) {
            location.replace("/code3_10/" + json.cont + "/" + json.meto);
        });
    });
    $(document).on("click", ".a_menu", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        $.ajax({
            url: "/code3_10/inicio/clear_session",
            type: "POST",
            async: false
        }).done(function() {
            redireccion(id, '');
        });
    });
    $(document).on("click", "#logout", function(event) {
        redireccion("auth", "logout");
    });
    $(document).on("click", ".a_usuarios_cambiarpwd", function(event) {
        edit_pass();
    });
    $(document).on("click", "#btn_pas", function(event) {
        txt_pwd_act = $("#txt_pwd_act").val();
        txt_pwd_nva = $("#txt_pwd_nva").val();
        txt_pwd_con = $("#txt_pwd_con").val();
        if ($("#formID2").validationEngine('validate')) {
            $('.guardar').html("<img src='/public/img/loader.gif' width='16' height='16' style='float:right; margin-right: 168px;'>");
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/usuarios/cambiarpwd",
                data: {txt_pwd_act: txt_pwd_act, txt_pwd_nva: txt_pwd_nva, txt_pwd_con: txt_pwd_con},
                success: function(json) {
                    if (parseInt(json.data) === 0) {
                        alert(json.msj);
                        $.fancybox.close();
                    } else {
                        alert(json.msj);
                        $('.guardar').html('<input type="button" id="btn_pas" name="btn_pas" value="Guardar" style="float:right; margin-right:150px">');
                    }
                }
            });
        }
    });
    $(document).on("click", ".ent_reg", function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "/code3_10/entrada/setvartemp",
            dataType: "json",
            type: "POST",
            data: {
                acci: 0,
                id: id
            }
        }).success(function(json) {
            location.replace("/code3_10/" + json.cont + "/" + json.meto);
        });
    });

    
    $(document).on("click", ".ent_imp", function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "/code3_10/reportes/generarReporte",
            dataType: "json",
            type: "POST",
            data: {
                id: id
            }
        }).success(function(json) {
            location.replace("/code3_10/" + json.cont + "/" + json.meto);
        });
    });


    $(document).on("submit", "#form_mov", function() {
        var data = $(this).serialize();
        var des = $("#txt_desde").val();
        var has = $("#txt_hasta").val();
        var radio = $("input[type='radio']:checked").length;

        if (radio === 0) {
            alert("Seleccione un tipo de movimiento");
            return false;
        }
        if (des === "" || has === "") {
            alert("SELECCIONE EL RANGO DE FECHA");
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/code3_10/reportes/Repormoviprod_val/",
            data: data,
            success: function(json) {
                if (json.resu === 0) {
                    window.open('/reportes/Repormoviprod/', '_blank');
                } else {
                    alert(json.resu);
                }
            }
        });

    });


    $(document).on("submit", "#form_inv", function() {
        var data = $(this).serialize();
        var alm = $("#cmb_alma").val();

        if (alm == "") {
            alert('Debe Seleccionar Un Almacen');
            return false;
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/code3_10/reportes/reportinventario/",
            data: data,
            success: function(json) {
                if (json.resu === 0) {
                    window.open('/reportes/reportinventario/', '_blank');
                } else {
                    alert(json.resu);
                }
            }
        });
    });


    $(document).on("submit", "#form_list_entr", function() {
        data = $(this).serialize();
        var alm = $("#cmb_alma_e").val();
        var des = $("#txt_desde").val();
        var has = $("#txt_hasta").val();
        if (alm === "") {
            alert("SELECCIONE EL ALMACEN");
            return false;
        }
        if (des === "" || has === "") {
            alert("SELECCIONE EL RANGO DE FECHA");
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/code3_10/reportes/report_list_entr/",
                data: data,
                success: function(json) {
                    if (json.resu === 0) {
                        window.open('/reportes/report_list_entr/', '_blank');
                    } else {
                        alert(json.resu);
                    }
                }
            });
        }
    });
    //impresion de reportes de lista de salidas por rango de fecha
    $(document).on("submit", "#form_list_sali", function() {
        alma = $("#cmb_alma_s").val();
        ced = $("#txt_cedu_trab").val();
        des = $("#txt_desde").val();
        has = $("#txt_hasta").val();

        if (alma === "") {
            alert("SELECCIONE EL ALMACEN");
            return false;
        }
        if (des === "" || has === "") {
            alert("SELECCIONE EL RANGO DE FECHA");
            return false;
        }

        window.open("/code3_10/reportes/repor_list_sali?alma=" + alma + "&ced=" + ced + "&des=" + des + "&has=" + has);

    });

//
    $(document).on("click", ".sal_reg", function() {
        var id = $(this).attr("id");
        var ced = $("#txt_ced_tra").val();

        if (ced == "" || ced == null) {
            alert("DEBE INGRESAR EL NUMERO DE CEDULA DEL TRABAJADOR");
        } else {
            $.ajax({
                url: "/code3_10/salida/setvartemp",
                dataType: "json",
                type: "POST",
                data: {
                    acci: 0,
                    id: id,
                    ced: ced
                }
            }).success(function(json) {
                location.replace("/code3_10/" + json.cont + "/" + json.meto);
            });
        }
    });

    //realizar cambio de producto al trabajador
    $(document).on("click", ".cam_pro", function() {
        var id = $(this).attr("id");
        var ced = $("#txt_ced_tra").val();
        $.ajax({
            url: "/salida/setvartemp",
            dataType: "json",
            type: "POST",
            data: {
                acci: 2,
                id: id,
                ced: ced
            }
        }).success(function(json) {
            $.ajax({
                url: "/salida/cambio_estatus",
            }).done(function() {
                location.replace("/code3_10/salida/detalles");
            });
        });
    });


    $(document).on("click", ".ver_mas", function() {
        $.fancybox.open({
            type: "ajax",
            ajax: {
                dataType: "html",
                type: "POST"
            },
            href: "/sigdu/trabajadores/detalles",
            success: function() {
                refreshGrid();
            }
        });
    });
    
    //actualizar tallas de trabajador
    $(document).on("click", ".act_tal", function() {
        $.fancybox.open({
            type: "ajax",
            ajax: {
                dataType: "html",
                type: "POST"
            },
            href: "/sigdu/trabajadores/tallatrabajador",
            success: function() {
                refreshGrid();
            }
        });
    });




    //volve a entrada desde detalles entrada
    $(document).on("click", ".ent_ppa", function(event) {
        redireccion("entrada", "index");
    });
// AÑADIR UN PRODUCTO A LA LISTA DE DETALLES DE ENTRADA PRODUCTO
    $(document).on("click", ".btn_add", function(event) {
        gene = $("#cmb_gene :selected").text();
        id_gen = $("#cmb_gene :selected").val();
        tipo = $("#cmb_tipo :selected").text();
        id_tip = $("#cmb_tipo :selected").val();
        prod = $("#cmb_prod :selected").text();
        id_prod = $("#cmb_prod :selected").val();
        talla = $("#cmb_talla :selected").text();
        id_talla = $("#cmb_talla :selected").val();
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
                    url: "/sigdu/entrada_producto/guardar",
                    dataType: "json",
                    type: "POST",
                    data: {gene: gene, tipo: tipo, id_prod: id_prod, prod: prod, id_talla: id_talla, talla: talla, cantidad: cantidad},
                    success: function(data) {

                    
                        
                        refreshGrid();
                    }
                });
            }
        }

    });
    // AÑADIR UN PRODUCTO A LA LISTA DE DETALLES DE SALIDA PRODUCTO
    $(document).on("click", ".btn_add_sal", function(event) {
        gene = $("#cmb_gene_sali :selected").text();
        id_gen = $("#cmb_gene_sali :selected").val();
        tipo = $("#cmb_tipo_sali :selected").text();
        id_tip = $("#cmb_tipo_sali :selected").val();
        prod = $("#cmb_prod_sali :selected").text();
        id_prod = $("#cmb_prod_sali :selected").val();
        talla = $("#cmb_talla_sali :selected").text();
        id_talla = $("#cmb_talla_sali :selected").val();
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
                    url: "/sigdu/salida_producto/guardar",
                    dataType: "json",
                    type: "POST",
                    data: {gene: gene, tipo: tipo, id_prod: id_prod, prod: prod, id_talla: id_talla, talla: talla, cantidad: cantidad},
                    success: function(json) {
                        alert(json.mens);
                        refreshGrid();
                    }
                });
            }
        }

    });

//agregar un usuario
    $(document).on("click", ".usu_reg", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sigdu/usuarios/setvartemp",
            data: {id: id},
            success: function(data) {
                switch (parseInt(data)) {
                    case 0:
                        $.fancybox.open({
                            type: "ajax",
                            ajax: {
                                dataType: "html",
                                type: "POST"
                            },
                            href: "/sigdu/usuarios/detalles"
                        });
                        break;
                    case 1:
                        alert("Ud no tiene los permisos necesarios");
                        break;
                    default:
                        alert("Error de Conexión");
                }
            }
        });
    });
    // eliminar usuario en listado del modulo configuración de usuario 
    $(document).on("click", ".usu_del", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        if (eliminar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/usuarios/eliminar",
                data: {id: id},
                success: function(json) {
                    alert(json.msj);
                    if (json.resu === 0) {
                        refreshGrid();
                    }
                }
            });
        }
    });
//restablecer contraseña 
    $(document).on("click", ".usu_pas_res", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sigdu/usuarios/setvartemp",
            data: {id: id},
            success: function(data) {
                if (parseInt(data) === 0) {
                    $.fancybox.open({
                        type: "ajax",
                        ajax: {
                            dataType: "html",
                            type: "POST"
                        },
                        href: "/sigdu/usuarios/restablecerpwd"
                    });
                } else {
                    alert("Error de Conexión");
                }
            }
        });
    });
    $(document).on('change', "#cmb_tip_rep", function() {
        id = $(this).find("option:selected").val();
        switch (parseInt(id)) {
            case 1:
                $('#cmb_com').removeAttr('disabled');
                $('#txt_fec_ini').val('').parent().show();
                $('#txt_fec_fin').val('').parent().show();
                break;
            case 2:
                $('#cmb_com').removeAttr('disabled');
                $('#cmb_clie').attr('disabled', 'disabled');
                $('#txt_fec_ini').val('').parent().hide();
                $('#txt_fec_fin').val('').parent().hide();
                break;
            case 3:
                $('#cmb_com, #cmb_clie').attr('disabled', 'disabled');
                $('#txt_fec_ini').val('').parent().show();
                $('#txt_fec_fin').val('').parent().hide();
                break;
            default:
                $('#cmb_com, #cmb_clie').attr('disabled', 'disabled');
                $('#txt_fec_ini').val('').parent().hide();
                $('#txt_fec_fin').val('').parent().hide();
        }
    });
    
    
    //filtrar productos por genero y tipo empleado en modulo de entrada
    $(document).on("change", "#cmb_tipo, #cmb_gene ", function() {
        var tip = $("#cmb_tipo option:selected").val();
        var gen = $("#cmb_gene option:selected").val();
//        alert (tip, gen);
        if ($("#cmb_prod").length > 0) {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/listarcmb2/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function(data) {
                    $("#cmb_prod").html(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/setvartemp/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function() {
                    refreshGrid();
                }
            });
        }
    });
    
 
    //filtrar productos por genero y tipo empleado en modulo de entrada
      $(document).on("change", "#cmb_tip", function() {
        var tip = $("#cmb_tip option:selected").val();
//        var ced = $("#txt_ce_tra").val();
//        alert (tipo);
        
        if ($("#cmb_prod").length > 0) {
            $.ajax({
                type: "POST",
                url: "/sigdu/movi_talla/listarcmb2/",
                data: {
                    tip: tip
//                    ced:ced
                },
                
                success: function(data) {
                     $("#cmb_prod").html(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/sigdu/movi_talla/setvartemp/",
                data: {
                    tip: tip
                
                },
                success: function() {
                    refreshGrid();
                }
            });
        }
    });
    
    
    //Consultar por Cedula
    $(document).on("click", ".con_cedu", function(event) {
        var id = $(this).attr("id");
        
//       alert (id);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sigdu/movi_talla/setvartemp",
            data: {id: id},
            success: function(data) {
                switch (parseInt(data)) {
                    case 0:
                        /*$.fancybox.open({
                         type: "ajax",
                         ajax: {
                         dataType: "html",
                         type: "POST"
                         },
                         href: "/sigdu/producto/detalles",
                         /*success: function() {
                         refreshGrid();
                         }
                         
                         });
                         break;*/
                        redireccion('movi_talla/detalle');
                        break;
                    case 1:
                        alert("Ud no tiene los permisos necesarios");
                        break;
                    default:
                        alert("Error de Conexión");
                }
            }
        });
    });
    
    
 
    
    
    $(document).on("click", ".sal_tall", function(event) {
        var id = $(this).attr("id");
        
//        alert (id);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sigdu/movi_talla/setvartemp",
            data: {id: id},
            success: function(data) {
                
//                  alert (data);
                switch (parseInt(data)) {
                    case 0:
                        $.fancybox.open({
                            type: "ajax",
                            ajax: {
                                dataType: "html",
                                type: "POST"
                            },
                            href: "/sigdu/movi_talla/detalles"
                        });
                        break;
                    case 1:
                        alert("Ud no tiene los permisos necesarios");
                        break;
                    default:
                        alert("Error de Conexión");
                }
            }
        });
    });
    
 
    

    //filtrar productos en inventario y refreshgrip
    $(document).on("change", "#cmb_alma_inve, #cmb_prod_stock, #cmb_tall_prod_stock", function() {
        var alm = $("#cmb_alma_inve option:selected").val();
        var pro = $("#cmb_prod_stock option:selected").val();
        var tal = $("#cmb_tall_prod_stock option:selected").val();
        var id = $(this).attr("id");
        switch (id) {
            case "cmb_alma_inve":
                $("#cmb_prod_stock").load('/sigdu/inventario_stock/listarcmb', {alm: alm});
                $("#cmb_tall_prod_stock").load('/sigdu/inventario_stock/listarcmb1', {alm: alm, pro: pro});
                break;
            case "cmb_prod_stock":
                $("#cmb_tall_prod_stock").load('/sigdu/inventario_stock/listarcmb1', {alm: alm, pro: pro});
                break;
        }
        
        
        var alm = $("#cmb_alma_inve option:selected").val();
        var pro = $("#cmb_prod_stock option:selected").val();
        var tal = $("#cmb_tall_prod_stock option:selected").val();
        
        $.ajax({
            type: "POST",
            datatype: "json",
            url: "/sigdu/inventario_stock/setvartemp/",
            data: {
                alm: alm,
                pro: pro,
                tal: tal

            },
            success: function(json) {
                refreshGrid();
            }
        });
    });

    //filtrar productos por genero y tipo empleado en modulo de salida
    $(document).on("change", "#cmb_tipo_sali, #cmb_gene_sali ", function() {
        var tip = $("#cmb_tipo_sali option:selected").val();
        var gen = $("#cmb_gene_sali option:selected").val();
        //alert (tip,gen);
        if ($("#cmb_prod_sali").length > 0) {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/listarcmb2/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function(data) {
                    $("#cmb_prod_sali").html(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/setvartemp/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function() {
                    refreshGrid();
                }
            });
        }
    });


    //filtrar talla por productos en modulo salida
    $(document).on("change", "#cmb_prod_sali", function() {
        var pro = $("#cmb_prod_sali option:selected").val();

        if ($("#cmb_prod_sali").length > 0) {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/listarcmb3/",
                data: {
                    pro: pro
                },
                success: function(data) {
                    $("#cmb_talla_sali").load('/producto/listarcmb3', {pro: pro});
                }
            });
        }
    });




// MOVI TALLA--------------------------------------------------------

   
   
   //filtrar productos por genero y tipo empleado en modulo de entrada
    $(document).on("change", "#cmb_tipo, #cmb_gene ", function() {
        var tip = $("#cmb_tipo option:selected").val();
        var gen = $("#cmb_gene option:selected").val();
        //alert (tip,gen);
        if ($("#cmb_prod").length > 0) {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/listarcmb2/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function(data) {
                    $("#cmb_prod").html(data);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/sigdu/producto/setvartemp/",
                data: {
                    tip: tip,
                    gen: gen
                },
                success: function() {
                    refreshGrid();
                }
            });
        }
    });
   
   






    //filtrar entradas por nº de factura

    //filtrar entradas por fecha
    function filtrar() {
        var fec = $('.txt_fec_ent').val();
        $.ajax({
            type: "POST",
            url: "/sigdu/entrada/setvartemp",
            data: {
                acci: 2,
                fec: fec
            },
            success: function() {
                refreshGrid();
            }
        });
    }

    //filtrar salidas por fecha
    function filtrar_sal() {
        var fec = $('.txt_fec_sal').val();
        $.ajax({
            type: "POST",
            url: "/sigdu/salida/setvartemp",
            data: {
                acci: 1,
                fec: fec
            },
            success: function() {
                refreshGrid();
            }
        });
    }
    //filtra salidas por numero de cedula de trabajador
    function filtrar_sal_ci() {
        var ced = $('.txt_ced_tra').val();
        $.ajax({
            type: "POST",
            url: "/sigdu/salida/setvartemp",
            data: {
                acci: 1,
                ced: ced
            },
            success: function() {
                refreshGrid();
            }
        });
    }
    
    
  
    
    $(document).on("click", ".btn_busq_fact", function(event) {
        var fac = $('#txt_nume_fact').val();
        if (fac == "" || fac == null) {
            alert('Indique un Número de Factura');
        } else {
            $.ajax({
                type: "POST",
                url: "/sigdu/entrada/setvartemp",
                data: {
                    acci: 2,
                    fac: fac
                },
                success: function() {
                    refreshGrid();
                }
            });
        }
    });

    /*$(document).on("click", ".btn_busq_trab", function(event) {
        event.preventDefault();
        var ced = $("#txt_ced_tra").val();
        if (ced === "") {
            alert("Debe Ingresar la  Cedúla del Trabajador");
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/salida/trab_filt",
                data: {
                    ced: ced
                },
                success: function(json) {
                    if (json.resu == 0) {
                        $("#txt_pri_nom").val(json.nom_tra);
                        $("#txt_pri_ape").val(json.ape_tra);
                        $("#cod_dep").val(json.dep_tra);
                        if (json.fot_trab === null) {
                            $("#fot_tra").html('<img src="/sigdu/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
                        } else {
                            $("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" >');
                        }
                    } else {
                        alert(json.resu);
                    }
                    refreshGrid();
                }
            });
        }
    });*/

$(document).on("click", ".btn_busq_trab", function(event) {
        event.preventDefault();
        var rif = $("#rif_for_pol").val();
      alert(rif);return false;
        if (ced === "" ) {  
            alert("Debe Ingresar la  Cedúla del Trabajador");
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/salida/trab_filt",
                data: {
                    ced: ced
                    //cedu: cedu
                },
                success: function(json) {
                      refreshGrid();
                        if (json.resu === 0) {
                        $("#txt_pri_nom").val(json.nom_tra);
                        $("#txt_pri_ape").val(json.ape_tra);
                        $("#cod_dep").val(json.dep_tra);
  
                        if (json.data_val === 1){
                         document.getElementById('val').style.display = 'inline';     
                        } else if (json.data_val === 2) {  
                         document.getElementById('val').style.display = 'none';
                        }
                        refreshGrid();
                        if (json.data_reg === 1){
                         document.getElementById('reg').style.display = 'none';  
                        } else if (json.data_reg === 2) {  
                         document.getElementById('reg').style.display = 'inline';
                        }
                       refreshGrid();
 
                        if (json.fot_trab === null) {
                            $("#fot_tra").html('<img src="/sigdu/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
                        } else {
                            $("#fot_tra").html('<img src="data:image/jpeg;base64,' + json.fot_trab + '" >');
                        }
                        if (json.cont === 0) {
                            
                            
                            $("#fot_tra").html('<img src="/sigdu/public/img/perfil.jpeg"  alt="Imagen Vistante" width="150" height="150">');
                        }  
   
                    } else {
                         alert(json.resu);
                         
                         
                         
                    }
                   refreshGrid();
 
                }
            });
        }
    });
    
    
    
    // Filtrar la cedula para ver las tallas
    $(document).on("click", ".btn_bu_trab", function(event) {
        event.preventDefault();
        var ced = $("#txt_ce_tra").val();
        if (ced === "") {
            alert("Debe Ingresar la  Cedúla del Trabajador");
        }
        else {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/movi_talla/filt_talla",
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
                    refreshGrid();
                }
            });
        }
    });
    


// Click al guardar los datos DESDE EL FORM DIALOG     
         $(document).on('click', '#guar_sig', function () {
         var txt_cedu_sig = $("#txt_cedu_sig").text();
             txt_cedu_sig = txt_cedu_sig.trim();
//                alert("INGRESE EL NUMERO DE CEDULA DEL TRABAJADOR" + txt_cedu_sig);
//                return false;
          $.ajax({
              type: "POST",
              dataType: "json",
            url: "/sigdu/salida/guardar_sig",
            data: {
                txt_cedu_sig: txt_cedu_sig
            },
            async: false,
            success: function (json) {
                alert(json.mens);
                location.reload();
            }
        });

    });



    $(document).on("click", ".reg_sig", function() {
        $.fancybox.open({
            type: "ajax",
            ajax: {
                dataType: "html",
                type: "POST"
            },
            href: "/sigdu/trabajadores/detalles_sig",
            success: function() {
                refreshGrid();
            }
        });
    });
    
    
    

    $(document).on('click', "#a_repo_impr", function() {
        redireccion("reportes");
    });
    $(document).on('focus', ".calendar", function() {
        id = $(this).attr('id');
        RANGE_CAL_1 = new Calendar({
            inputField: id,
            trigger: id,
            dateFormat: "%Y-%m-%d",
            weekNumbers: false,
            onSelect: function() {
                this.hide();
            }
        });
    });
    $(document).on('focus', ".calendar2", function() {
        id = $(this).attr('id');
        RANGE_CAL_1 = new Calendar({
            inputField: id,
            trigger: id,
            dateFormat: "%Y-%m-%d",
            weekNumbers: false,
            onSelect: function() {
                this.hide();
                filtrar();
            }
        });
    });
    $(document).on('focus', ".calendar3", function() {
        id = $(this).attr('id');
        RANGE_CAL_1 = new Calendar({
            inputField: id,
            trigger: id,
            dateFormat: "%Y-%m-%d",
            weekNumbers: false,
            onSelect: function() {
                this.hide();
                filtrar_sal();
            }
        });
    });
//cambio de contreseña
    function edit_pass() {
        $.fancybox.open({
            type: "ajax",
            ajax: {
                dataType: "html",
                type: "POST"
            },
            href: "/sigdu/usuarios/cambiarpwd"
        });
    }

//agregar un producto
    $(document).on("click", ".pro_reg", function(event) {
        var id = $(this).attr("id");
        
//       alert (id);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sigdu/producto/setvartemp",
            data: {id: id},
            success: function(data) {
                switch (parseInt(data)) {
                    case 0:
                        /*$.fancybox.open({
                         type: "ajax",
                         ajax: {
                         dataType: "html",
                         type: "POST"
                         },
                         href: "/sigdu/producto/detalles",
                         /*success: function() {
                         refreshGrid();
                         }
                         
                         });
                         break;*/
                        redireccion('producto/detalles');
                        break;
                    case 1:
                        alert("Ud no tiene los permisos necesarios");
                        break;
                    default:
                        alert("Error de Conexión");
                }
            }
        });
    });
//Eliminar producto 
    $(document).on("click", ".pro_del", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        if (eliminar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/producto/eliminar",
                data: {id: id},
                success: function(json) {
                    alert(json.mens);
                    if (json.resu === 0) {
                        refreshGrid();
                    }
                }
            });
        }
    });
//Eliminar producto de una entrada 'entradaproducto'
//Eliminar producto 
    $(document).on("click", ".ent_pro_del", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        if (eliminar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/entrada_producto/eliminar",
                data: {id: id},
                success: function(json) {
                    alert(json.mens);
                    if (json.resu === 0) {
                        refreshGrid();
                    }
                }
            });
        }
    });
    $(document).on("click", ".sal_pro_del", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        if (eliminar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/salida_producto/eliminar",
                data: {id: id},
                success: function(json) {
                    alert(json.mens);
                    if (json.resu === 0) {
                        refreshGrid();
                    }
                }
            });
        }
    });


    $(document).on("click", ".sal_pro_upd", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        if (cambiar()) {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/salida_producto/setvartemp",
                data: {id: id,
                    acci: 0

                },
                success: function(json) {

                    $.fancybox.open({
                        type: "ajax",
                        ajax: {
                            dataType: "html",
                            type: "POST",
                            data: {id: id}
                        },
                        href: "/sigdu/nuevo_producto/cambio_prod",
                        success: function() {
                            refreshGrid();
                        }
                    });
                }});
        }
    });




    function redireccion(contr, meth) {
        location.replace("/sigdu/" + contr + (meth ? "/sigdu/" + meth : ""));
    }

    function cambiar() {
        return confirm('Esta seguro que desea cambiar el producto?');
    }
    function eliminar() {
        return confirm('Esta seguro que desea eliminar este registro?');
    }
    function finalizar() {
        return confirm('Esta seguro que desea finalizar este registro?');
    }

//validacion de campo cantidad solo numeros
    $(document).ready(function() {
        $("#txt_cant").keydown(function(event) {
            if (event.shiftKey)
            {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8) {
            }
            else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                }
                else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });
    })

// eliminar fila del arreglo modulo de entradas 
    $(document).on("click", ".ent_del", function(event) {
        var id = $(this).attr("id");
        event.preventDefault();
        //$('id').remove();                                       
        if (eliminar()) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/sigdu/entrada/elimina_fila",
                data: {id: id},
                success: function(data) {

                    alert('eliminado');
                    i = 0;
                    str = "";
                    tot_cant = null;
                    if (data[i] != null) {
                        while (data[i] != null) {
                            tot_cant = (tot_cant * 1) + (data[i].cantidad * 1);
                            str = str + '<div style="width:890px; border:0px solid grey; margin-top:5px;height:23px;"><div style="float:left; width:150px;">' + data[i].gene + '</div><div style="float:left; width:100px;">' + data[i].tipo + '</div><div style="float:left; width:350px;">' + data[i].prod + '</div><div style="float:left; width:100px;">' + data[i].talla + '</div><div style="float:left; width:100px;">' + data[i].cantidad + '</div><div style="float:left; width:80px;" ><img id = "' + i + '" class="ent_del" src="/sigdu/public/img/eliminar.png" width="20" height="20" border="0" title="Eliminar" style="cursor:pointer;cursor:hand;"></div></div>';
                            $("#html_arreglo").html(str);
                            i++;
                        }
                        $("#txt_canti").val(tot_cant);
                    } else {
                        $("#html_arreglo").html('');
                        $("#txt_canti").val('');
                    }
                }
            });
        }
    });



    $(document).on("click", "#btn-ima-upl", function(event) {
        //event.preventDefault();
        habilitar_subir_imagen();
    });

    //este es el que se encarga de subir imagenes para los productos... articulos
    function habilitar_subir_imagen() {
        new AjaxUpload('#btn-ima-upl', {
            action: '/imagenes/upload',
            onSubmit: function(file, ext) {
                if (!(ext && /^(jpg|png|jpeg)$/.test(ext))) {
                    alert('Error: Solo se permiten imagenes');
                    return false;
                } else {
                    $('#cont').html("<img src='/public/img/loader.gif' width='16' height='16'>");
                }
            },
            onComplete: function(file, response) {

                switch (response) {
                    case "0":
                        $('#upload').html('<div id="cont"><b>Dimensiones mínimas permitidas: 640 x 480 px.</b></div>');
                        break;
                    default:
                        //TODO: Resolver la validación, esta dando error cuando la imagen es pequeña y se vuelve a cargar una de mayor tamaño
                        $('#upload').html(response);
                        alert("Por favor, seleccione un area de la imagen y luego haga clic en el botón Cortar para confirmar.");
                        $('#cropbox').Jcrop({
                            bgFade: true,
                            aspectRatio: 5 / 5,
                            minSize: [20, 20],
                            bgOpacity: .1,
                            setSelect: [0, 0, 10, 10],
                            onSelect: updateCoords
                        });
                        $("#btn-ima-gua").removeAttr("disabled");
                }
            }
        });
    }

    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }



    $(document).on("click", "#btn-ima-gua", function(event) {
        event.preventDefault();
        if (parseInt($('#w').val())) {
            var x = $('#x').val();
            var y = $('#y').val();
            var w = $('#w').val();
            var h = $('#h').val();
            var data = {
                img: $('#upload').find("img").attr("src"),
                x: x,
                y: y,
                w: w,
                h: h
            };
            $("#upload").load("/sigdu/imagenes/crop2", data);
        } else {
            alert('por favor seleccione un area de la imagen');
        }
    });



    $(document).on("click", "#pro_det_gua", function(event) {
        if ($("#formID").validationEngine('validate')) {
            $(".guardar").html("<img src='/public/img/loader.gif' width='16' height='16' style='float:right; margin-right: 168px;'>");
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/code3_10/producto/guardar",
                data: {
                    txt_nomb: $("#txt_nomb").val(),
                    cmb_gene: $("#cmb_gener :selected").val(),
                    cmb_tipo: $("#cmb_tipo :selected").val(),
                    ima_base: $("#upload img").attr("src"),
                    ima_alto: $("#upload img").attr("height"),
                    ima_anch: $("#upload img").attr("width")
                },
                success: function(json) {
                    alert(json.mens);
                    if (parseInt(json.resu) === 0) {
                        redireccion("producto");
                    }
                }
            });
        }
    });


});

