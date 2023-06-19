<div class="row" id ="carnet">
	<div class="col-xs-12">

	  <img style="width: 100%;" src="<?=base_url('public/img/carnet_ife_1.png')?>">

	  <div class="qr"> <img style=" height: 80px; width: 80px;" src="<?=base_url("public/img/qrcode/$tra->ced_tra.png")?>"></div>

	  <div class="datos"><p class="p"><?php print $tra->pri_nom.' '.$tra->pri_ape?></p><p name="ced" id="cedu"><?php print "V-".$tra->ced_tra;?></p></div>
	
	  <!-- validacion cuando no se tiene el area registrada -->
	  <?php if ($tra->nom_dep2 == NULL): ?>
	<div class=" depe"><p style=""><?php print $tra->nom_dep;?></p></div>
    <?php else: ?>
	<div class=" depe"><p style=""><?php print $tra->nom_dep2;?></p></div>

    <?php endif; ?>

	

<!-- validacion de colores por tipo personal -->


<!-- contratados amarilla-->
	<?php if ($tra->id_tip_per == 26): ?>
		<div class="foto_c"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargo_c"><span style="color:black;"><?php print $tra->nom_tip_per;?></span></div>

	  <!-- empleados azul-->
<?php elseif ($tra->id_tip_per == 28): ?>

   <div class="foto_j"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargo_j"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>

<!-- obreros verde-->
	  <?php elseif ($tra->id_tip_per == 21): ?>

<div class="foto_e"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
   <div class="cargo_e"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>

   <!-- jubilados y pensionados morado -->
   <?php elseif ($tra->id_tip_per == 24 or 84): ?>

<div class="foto_o"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
   <div class="cargo_o"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>

      <!-- personal de seguridad gris-->
	  <?php elseif ($tra->id_tip_per == 11 or 12): ?>

<div class="foto_s"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
   <div class="cargo_s"><span style="color:black;"><?php print $tra->nom_tip_per;?></span></div>

<!-- personal con encargaduria rojo -->
<?php else: ?>
	<div class="foto"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargo"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>
<?php endif; ?>



	</div>
</div>


