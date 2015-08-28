<br><br>
<div class="row">
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<h5 class="teal-text text-darken-1">Reviews provided by you</h5>
	</div>
</div>

<?php
	load_view("Template/reviewlist.php", $inp);
?>


	<!-- Upvote Modal Structure -->
	<div id="upvote_modal" class="modal">
		<div class="modal-content">
			<h5 class="green-text"><i class="mdi-action-thumb-up left"></i>Upvotes</h5>
			<div class="smg-preloader"></div>
			<div class="smg">
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Babloo</a></p>
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Pickachu</a></p>
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Partap</a></p>
			</div>
		</div>
	</div>
	<!-- Downvote Modal Structure -->
	<div id="downvote_modal" class="modal">
		<div class="modal-content">
			<h5 class="green-text"><i class="mdi-action-thumb-down left"></i>Downvotes</h5>
			<div class="smg-preloader"></div>
			<div class="smg">
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Babloo</a></p>
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Pickachu</a></p>
				<p><a href="#"><i class="mdi-image-tag-faces left"></i>Partap</a></p>
			</div>
		</div>
	</div>
