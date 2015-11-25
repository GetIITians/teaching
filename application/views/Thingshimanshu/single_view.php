<div class="container" >
	<div data-action="caller_basicinfo" id="caller_basic_info" data-id=<?php echo $thingsahimanshu_info['id']; ?>>
		<?php 
	  		handle_disp(array("id"=>$thingsahimanshu_info['id']), "thingsahimanshu_basicinfo");
		?>
	</div>
	<div class="well">
	<div class="row" >
	<div class="col-xs-12">
	<h4 style="margin-top:-10px">Comments & Status:</h4>
	</div>
	</div>

	<div class="row" >
	<div class="col-sm-12" id="thingsahimanshuhisdetail" data-action="thingsahimanshuhisdetail" data-id=<?php echo $thingsahimanshu_info['id']; ?>>
	<?php
   		handle_disp(array("id"=>$thingsahimanshu_info['id']), "thingsahimanshuhisdetail");
   	?>
	</div>
	</div>
	</div>
</div>	