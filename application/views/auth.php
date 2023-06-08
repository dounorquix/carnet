<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sistema de Carnetización</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url('public/login/images/icons/favicon.ico') ?>" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/bootstrap/css/bootstrap.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/fonts/iconic/css/material-design-iconic-font.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/animate/animate.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/sweetalert2/sweetalert2.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/animsition/css/animsition.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/select2/select2.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/vendor/daterangepicker/daterangepicker.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/css/util.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/login/css/main.css') ?>">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-53 p-r-53 p-t-63 p-b-52">
				<form class="login100-form validate-form" name="frm_login" id="frm_login" method="post">
				<img id="logo" src="<?= base_url('public/login/images/logo.png') ?>" style="width: 180px; margin-left: 98px;  margin-top: -53px">
					<span class="login100-form-title p-b-5">
						<p><b>Sistema de Carnetización</b></p>
					</span>
					<span style="margin-top:5px; height:5px; color: red; font-weight: bold; font-size:medium; margin-left: 55px" id="spa_erro"></span>
					<div class="wrap-input100 validate-input m-b-23" data-validate="Usuario requerido">
						<span class="label-input100">Usuario</span>
						<input class="input100" type="text" id="txt_usua" name="txt_usua" placeholder="Usuario">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Contraseña Requerido">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" id="txt_pass" name="txt_pass" placeholder="Contraseña">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" id="">
								Login
							</button>
						</div>
						
						<p><br><span class="txt1 p-b-5">
							Sistema de Carnetización Version 2.0
						</span></p>

					</div>

					
				</form>
			</div>
		</div>
	</div>


	

	<!--===============================================================================================-->
	<script src="<?= base_url('public/login/js/jquery/jquery-3.2.1.min.js') ?>"></script>
	<!--===============================================================================================-->

	<script src="<?= base_url('public/js/jquery/jquery-3.3.1.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/login/vendor/animsition/js/animsition.min.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/login/vendor/bootstrap/js/popper.js') ?>"></script>
	<script src="<?= base_url('public/login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/login/vendor/select2/select2.min.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/login/vendor/daterangepicker/moment.min.js') ?>"></script>
	<script src="<?= base_url('public/login/vendor/daterangepicker/daterangepicker.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/sweetalert2/sweetalert2.all.min.js')?>"></script>
	<script src="<?= base_url('public/login/vendor/countdowntime/countdowntime.js') ?>"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('public/js/sha1/core-min.js') ?>"></script>
	<script src="<?= base_url('public/js/sha1/sha1.js') ?>"></script>
	<script src="<?= base_url('public/js/sha1/main.js') ?>"></script>
	<script src="<?= base_url('public/js/login.js') ?>"></script>
