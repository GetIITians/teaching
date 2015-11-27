<?php 
load_view("popup.php",array("name"=>"callerhistorypopup", "title" =>"Add ".$caller_info['name']."'s Caller Details","body" =>"Caller/calldetailsform.php","bodyinfo" => array("st_id"=>$caller_info['id']) )); 
?>
<div class="container" >
<div class="row mt5">
	<div class="col-sm-1" >
		<a class="btn btn-primary" href="<?php echo HOST.'caller/view/'.($caller_info['id']-1); ?>" >Pervious</a>
	</div>
	<div class="col-sm-1" style="float:right">	
		<a class="btn btn-primary" href="<?php echo HOST.'caller/view/'.($caller_info['id']+1); ?>" >Next</a>
	</div>
</div>
	<div data-action="caller_basicinfo" id="caller_basic_info" data-id=<?php echo $caller_info['id']; ?>>
		<?php 
	  		handle_disp(array("id"=>$caller_info['id']), "caller_basicinfo");
		?>
	</div>
	<div class="well">
	<div class="row" >
	<div class="col-xs-12">
	<h4 style="margin-top:-10px">Call Details:</h4>
	</div>
	</div>

	<div class="row" >
	<div class="col-sm-12" id="calldetail" data-action="calldetail" data-id=<?php echo $caller_info['id']; ?>>
	<?php
   		handle_disp(array("id"=>$caller_info['id']), "calldetail");
   	?>
	</div>
	</div>
	</div>
</div>	