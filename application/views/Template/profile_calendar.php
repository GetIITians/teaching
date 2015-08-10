<?php if ($tid == User::loginId()) : ?>
	<div class="row">
		<div class="col s12">
			<a onclick="$('#fillalltsform').slideToggle(500);">Click here</a> to book slots for multiple days.
			<div id="fillalltsform" style="display:none;padding:30px;">
				<?php load_view("Template/uploadslotform.php",$inp); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- Calendar -->
<div id="divforcalender">
	<?php load_view("dispcal.php",$inp); ?>
</div>