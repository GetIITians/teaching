	<script src="<?php echo site_url('ckeditor/ckeditor.js'); ?>"></script>
	<script src="<?php echo site_url('ckeditor/js/sample.js'); ?>"></script>
<?php 
	load_view("Template/top.php");
	load_view("Template/navbarnew.php");
	$this->load->view($view_name, $view_data);
	load_view("Template/footer.php"); 
	load_view("Template/bottom.php");
?>
<script>
	initSample();
</script>
