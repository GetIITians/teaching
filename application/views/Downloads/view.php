<?php $this->load->view('Template/top', $top) ?>
<?php $this->load->view('Template/navbarnew', $navbar) ?>
<?php//print_r($authorname);?>
<main id="downloads" class="container">
	<div class="row">
	<?php foreach($authorname as $downloads) : ?>	
		<div class="col-xs-3"> 
			<a href="<?php echo site_url('download/'.$this->uri->segment(2).'/'.$downloads); ?>"><img src="<?php echo site_url('images/pdf.png'); ?>" class="img-responsive" height="100" width="100">
			<p><?php echo $downloads ?></p>
			</a>
		</div>
	<?php endforeach; ?>
	</div>
</main>
<?php $this->load->view('Template/footer') ?>
<script src="js/helper.js"></script>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>