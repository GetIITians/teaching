<div class="container" >
	<div data-action="caller_basicinfo" id="caller_basic_info" data-id=<?php echo $thingsa_info['id']; ?>>
		<?php 
	  		handle_disp(array("id"=>$thingsa_info['id']), "thingsa_basicinfo");
		?>
	</div>
	<div class="well">
	<div class="row" >
	<div class="col-xs-12">
	<h4 style="margin-top:-10px">Comments &amp; Status:</h4>
	</div>
	</div>

	<div class="row" >
	<div class="col-sm-12" id="thingsahisdetail" data-action="thingsahisdetail" data-id=<?php echo $thingsa_info['id']; ?>>
	<?php
   		handle_disp(array("id"=>$thingsa_info['id']), "thingsahisdetail");
   	?>
	</div>
	</div>
	</div>
</div>	