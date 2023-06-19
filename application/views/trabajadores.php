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
						<li class="breadcrumb-item"><a href="<?= base_url('Inicio') ?>">Inicio</a></li>
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
					<div class="col-md-7" style="margin-left: 223px;">

						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title">Buscar Trabajador</h3>
							</div>
							<div class="card-body">

								<div class="input-group">
									<input id="txt_trab" name="txt_trab" type="text" class="form-control" placeholder="Cedula del trabajador">

									<div class="input-group-append">
										<button type="button" class="btn btn-primary btn_bus_tra"><i class="fa fa-search"></i> Buscar</button>
									</div>

								</div>

							</div>
						</div>
					</div>

					<!-- Profile Image -->
					<div id="fich_trab" class="card card-primary card-outline" style=" margin-left: 116px;">
						<div class="card-body box-profile">
							<div id="txt" class="text-center">
								<div id="fot_tra" class="text-center">
									<?php if (@$filtr != null || @$filtr == null and @$filtr->fot_tra != null) { ?>
										<img src="<?php print pg_unescape_bytea(@$filtr->fot_tra); ?>" width="100" height="100">
									<?php } else { ?>
										<img src='<?php print base_url() . "public/img/perfil.jpg"; ?>' alt="IMAGEN PRODUCTO" style="width:150px; height:150px;">
									<?php } ?>
								</div>
							
								<input maxlength="50" type="text" class="ficha" name="ced" id="cedu" disabled="disabled"><br>
								<input maxlength="50" type="text" class="ficha" name="txt_pri_nom" id="txt_pri_nom" disabled="disabled"><br>

								<input maxlength="50" type="text" class="ficha" name="txt_pri_ape" id="txt_pri_ape" disabled="disabled"><br>


								<ul class="list-group list-group-unbordered ">
									<li class="list-group-item">
										<b>Dependencia:</b> <br>
										<div id="texto" contenteditable="true"><input type="text" class="ficha" name="area" id="area" disabled="disabled"></div>
										<div id="texto" contenteditable="true"><input type="text" class="ficha" name="cod_dep" id="cod_dep" disabled="disabled"></div>
					
										<!-- &nbsp; -->
										<b>Tipo de Personal:</b> <br>
										<div id="texto" contenteditable="true"><input type="text" class="ficha" name="cargo" id="cargo" disabled="disabled"></div>
										<br>
										
									</li>

									<li>
									<li class="list-group-item">
										<!-- <a id="val" class="list-group-item ver_mas" style="display:none; margin:center; ">&nbsp; VER MAS</a> -->

										<button id='val' name='val' style="display:none;" type='button' class=' btn btn-info btn-sm emitir' title='Emitir' data-toggle="modal" data-target="#exampleModal1"><span class='fa fa-share-square'> Emitir </span></button>

										<button id='reg' name='reg' style="display:none;" type='button' class=' btn btn-danger btn-sm reg_sig' title='ver mas' data-toggle="modal" data-target="#modal-default"><span class='fas fa-search'> ver mas </span></button>

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





	<!-- Button trigger modal -->


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
                <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Emitir Carnet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 85px;">
              
                </div>
                <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

<button id="" value="Guardar" type="button" class="btn btn-danger btn-print"> Imprimir </button>
                </div>
           
        </div>
    </div>
</div>
