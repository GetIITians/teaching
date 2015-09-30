<?php $this->load->view('Template/top', $top) ?>
<?php $this->load->view('Template/navbarnew', $navbar) ?>
<main id="blog" class="container">
	<?php foreach ($records as $post) : ?>
	<div class="miniBlogPost">
		<h1 class="postTitle">
			<a href="<?php echo site_url('blog/'.$post['slug']); ?>">
				<?php echo $post['title'] ?>
			</a>
		</h1>
		<p class="timeAndAuthor">
			<?php echo date('j F Y',strtotime($post['timestamp'])); ?>&nbsp;|&nbsp;<?php echo $post['author'] ?>
		</p>
		<ul>
			<?php
				$tags = explode("-", $post['tags']);
				foreach ($tags as $tag)
				{
					echo "<li>".$tag."</li>"; 
				}
			?>
		</ul>
		<img src="<?php echo site_url($post['imgLink']); ?>">
		<p><?php echo $post['imgTitle']; ?></p>
	</div>
	<?php endforeach; ?>
	<ul class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</ul>
</main>
<?php $this->load->view('Template/footer') ?>
<script src="js/helper.js"></script>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>