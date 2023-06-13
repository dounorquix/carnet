<div class="row">
	<div class="col-xs-12">

	  <img style="width: 100%;" src="<?=base_url('public/img/carnet_ife.png')?>">

	  <div class="qr"> <img src="<?=base_url('public/img/qrcode/24433002.png')?>"></div>

	  <div class="datos small"><p><?php print $tra->pri_nom.' '.$tra->pri_ape?></p><p name="ced" id="cedu"><?php print "V-".$tra->ced_tra;?></p></div>
	  <div class="foto"><img style="border-radius: 100%; height: 120px; width: 120px;" src="<?=base_url('public/img/img.jpeg')?>"></div>
	  <div class="cargo"><p><?php print $tra->nom_car;?></p></div>
	  <div class="depe"><p><?php print $tra->nom_dep;?></p></div>
	 
	</div>
</div>
