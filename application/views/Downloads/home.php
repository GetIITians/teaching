<?php $this->load->view('Template/top', $top) ?>
<?php $this->load->view('Template/navbarnew', $navbar) ?>
<main id="downloads" class="container">
	<div class="row">
	<?php foreach($downloads as $authorname => $files) : ?>	
		<div class="col-xs-3"> 
			<a href="<?php echo site_url('downloads/'.$authorname); ?>"><img src="<?php echo site_url('images/folder.png'); ?>" class="img-responsive" height="100" width="100">
			<p><?php echo $authorname ?></p>
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