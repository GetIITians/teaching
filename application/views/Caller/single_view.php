<?php print_r($teaching_info);
load_view("popup.php",array("name"=>"callerhistorypopup", "title" =>"Add ".$caller_info['name']."'s Caller Details","body" =>"Caller/calldetailsform.php","bodyinfo" => array("st_id"=>$caller_info['id']) )); 
?>
<div class="container" >
	<div class="well mt10" data-action="caller_basicinfo" id="caller_basic_info" data-id=<?php echo $caller_info['id']; ?>>
		<?php 
	  		handle_disp(array("id"=>$caller_info['id']), "caller_basicinfo");
		?>
	</div>
<div class="well">
	<div class="row">
	<div class="col-xs-6">
		<h4 style="margin-top:-10px">Add New Call Comment:</h4>
		<form role="form" method="post" onsubmit="return form.req(this)" data-action="calldetails" data-res="success.push('Call Details Added Successfully!!');mohit.popup_close('callerhistorypopup');div.reload($('#calldetail')[0]);div.reload($('#caller_basic_info')[0]);">
			<input type="hidden" name="st_id" value="<?php echo $caller_info['id']; ?>">
			<div class="row">
	    		<div class="col-xs-12">
	      			<label>Comments:</label>
	      			<textarea name="comments" ></textarea>
	    		</div>
			  </div><div class="row mt10">			
    <div class="col-xs-4">
    	<label>Demo:</label>
      <select  class="browser-default" name="demo">
        <option value="" disabled="disabled" selected="selected">Demo Fixed</option>
        <?php if(!empty($teaching_info['demo'])): ?>
        <option value="<?php echo $teaching_info['demo']; ?>" selected="selected"><?php echo $teaching_info['demo']; ?></option>	
        <?php endif; ?>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        <option value="Accepted">Accepted</option>
        <option value="Rejected">Rejected</option>
        <option value="Rescheduled">Rescheduled</option>
        <option value="Others">Others</option>
      </select>    
    </div> 
    <div class="col-xs-4">
      <label>Teacher:</label>
      <input type="text" name="teacher"  p value="<?php echo $teaching_info['teacher']; ?>">
    </div>
     <div class="col-xs-4">
     	<label>Fees agreed:</label>
       <input type="text" name="fees"  value="<?php echo $teaching_info['fees']; ?>">
    </div>
    </div><div class="row mt10">
    <div class="col-xs-12">
      		<button type="submit" class="btn">Submit</button>
    </div> 
  </div>	

</form>
	</div>
	<div class="col-xs-6">
		<h4 style="margin-top:-10px">Send A Message:</h4>
		<div class="row">
		<div class="col-xs-12">
	      			<textarea name="comments" placeholder="Message"></textarea>
	    		</div>
			  </div><div class="row mt10">			
    <div class="col-xs-4">
      		<button type="submit" class="btn">Send</button>

	</div>
	</div>
</div>
</div>
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