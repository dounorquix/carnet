<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Configuración de Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Inicio') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">


                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">

                                <div class=" row col-md-6">


                                    <button type='button' class=' btn btn-success btn-sm ' title='Agregar'
                                        data-toggle="modal" data-target="#exampleModal"><span
                                            class='fas fa-plus-circle'> Agregar</span></button>
                                </div><br>

                                <thead>

                                    <tr>

                                        <th>N°</th>
                                        <th>Usuario</th>
                                        <th>Cedula</th>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Usuario</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>

                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="sticky-top mb-3">


                    <div class="card-header">
                        <h3 class="card-title">Buscar Trabajador</h3>
                    </div>
                    <div class="card-body">

                        <div class="input-group">
                            <input id="txt_ced_tra" type="text" class="form-control"
                                placeholder="Cedula del trabajador">

                            <div class="input-group-append">
                                <button id="btn_busq_trab" type="button" class="btn btn-primary filt_trab"><i
                                        class="fa fa-search"></i> Buscar</button>
                            </div>

                        </div>

                    </div>



                    <div class="card-header">
                        <h3 class="card-title">Datos del Trabajador intrasarrhh</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6">
                                <label>NOMBRES</label>
                                <input type="text" class="form-control" name="txt_nom" id="txt_nom" disabled="disabled">
                            </div>

                            <div class="col-5">
                                <label>APELLIDOS</label>
                                <input type="text" class="form-control" name="pri_ape" id="pri_ape" disabled="disabled">
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-3">
                                <label>CEDULA</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" disabled="disabled">
                            </div>
                            <div class="col-4">
                                <label>USUARIO</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" disabled="disabled">
                            </div>
                            <div class="col-5">
                                <label>CONTRASEÑA</label>
                                <input type="text" class="form-control" name="clave" id="clave" disabled="disabled">
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TIPO DE USUARIO</label>
                                    <select class="form-control" name="tip_usu" id="tip_usu">
                                        <option selected="true" value=""> Tipo de Usuario </option>
                                        <?php foreach ($tip_usua as $tusu): ?>
                                        <option value="<?php print $tusu->id_tip_usu ?>">
                                            <?php print $tusu->des_tip_usu ?> </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <br>

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
                <button type="button" class="btn btn-primary ins_usu">Guardar</button>
            </div>
        </div>
    </div>
</div>