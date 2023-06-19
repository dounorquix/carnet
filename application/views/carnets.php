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



	<?php if ($tra->id_tip_per == 26): ?>
		<div class="fotoc"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargoc"><span style="color:black;"><?php print $tra->nom_tip_per;?></span></div>

<?php elseif ($tra->id_tip_per = 21 or 51): ?>

   <div class="fotoe"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargoe"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>
<?php else: ?>
	<div class="foto"><img style="border-radius: 100%; height: 110px; width: 110px; border-color: #ffc107;" src="<?=base_url('public/img/perfil3.png')?>"></div>
	  <div class="cargo"><span style="color:beige;"><?php print $tra->nom_tip_per;?></span></div>
<?php endif; ?>



	</div>
</div>


