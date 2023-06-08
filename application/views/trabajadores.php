<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registro y Emision de Carnet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('Inicio')?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Trabajador</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="col-md-7">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Buscar Trabajador</h3>
                            </div>
                            <div class="card-body">

                                <div class="input-group">
                                    <input id="txt_trab" name ="txt_trab" type="text" class="form-control"
                                        placeholder="Cedula del trabajador">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn_bus_tra"><i
                                                class="fa fa-search"></i> Buscar</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>



                    <!-- Profile Image -->
                    <div id="fich_trab" class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div id="fot_tra" class="text-center">
							<div id="fot_tra" class="text-center">
                                <?php if (@$filtr != null || @$filtr == null and @$filtr->fot_tra != null) {?>
                                <img src="<?php print pg_unescape_bytea(@$filtr->fot_tra);?>" width="100"
                                    height="100">
                                <?php } else {?>
                                <img src='<?php print base_url() . "public/img/perfil.jpg";?>' alt="IMAGEN PRODUCTO"
                                    width="150" height="150">
                                <?php }?>
                            </div><br>

                            <input maxlength="50" type="text"
                                style="width: 100%; border: 0; margin:auto; font-weight: bold;" name="txt_pri_nom"
                                id="txt_pri_nom" disabled="disabled"><br>
                            <input maxlength="50" type="text"
                                style="width: 100%; border: 0; margin:auto; font-weight: bold;" name="txt_pri_ape"
                                id="txt_pri_ape" disabled="disabled"><br>


                            <ul class="list-group list-group-unbordered ">
                                <li class="list-group-item" style="">
                                    <b>Dependencia:</b> <br>
                                    <div id="texto" contenteditable="true"><input type="text"
                                            style=" border: 0; width: 100%; height: 100%;" name="cod_dep " id="cod_dep"
                                            disabled="disabled"></div>
                                    <br>
                                </li>

                                <li>
                                    <li class="list-group-item">
                <!-- <a id="val" class="list-group-item ver_mas" style="display:none; margin:center; ">&nbsp; VER MAS</a> -->

                   <button id='val' style="display:none;" type='button' class=' btn btn-info btn-sm ver_mas' title='Agregar'
                                            data-toggle="modal" data-target="#modal-default"><span
                                                class='fa fa-search'>Emitir</span></button> 

                  <button id='reg' style="display:none;" type='button' class=' btn btn-danger btn-sm reg_sig' title='Agregar'
                                            data-toggle="modal" data-target="#modal-default"><span
                                                class='fas fa-plus-circle'>Foto</span></button> 

                <!-- <a id="reg" class="list-group-item reg_sig" style="display:none; color: red; margin:center;"> <span
                                                class='fas fa-plus-circle'> Emitir</span></a> <br>  -->

                                    </li>

             
                                </li>

                            </ul>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</div>


<div class="modal fade" id="modal-xl" style="width: 100%;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalle de Salida</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Main content -->

            </div>
        
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ficha del Trabajador </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              <button id="guar_sig" value="Guardar" type="button" class="btn btn-danger">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


            <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Actualización de Tallas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            <button id="actu_talla" value="Guardar" type="button" class="btn btn-danger">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
