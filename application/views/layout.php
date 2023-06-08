<?php
    $this->load->view("header");  
	$this->load->view("banner");
	$this->load->view("menu"); 
?>
<div id="vw">
    <?php $this->load->view($content); //No modificar esta linea ?>
</div>
<?php 
    $this->load->view("footer");				
?>
