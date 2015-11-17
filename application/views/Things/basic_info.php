 <div class="well mt10">
<div class="row">
			<div class="col-sm-12">
				<h4>Things Details:</h4>
				 	<div class="row">
					 	<div class="col-sm-2">
					 		Category :
					 	</div>
					 	<div class="col-sm-1">
					 		<?php echo $thingsa_info['category']; ?>
					 	</div>
					 	<div class="col-sm-2">
					 		Responsibility :
					 	</div>
					 	<div class="col-sm-1">
					 		<?php echo $thingsa_info['responsibility']; ?>
					 	</div>
					 	<div class="col-sm-2">
					 		Due date :
					 	</div>
					 	<div class="col-sm-1">
					 		<?php echo $thingsa_info['due_date']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-2">
					 		Details :
					 	</div>
					 	<div class="col-sm-1">
					 		<?php echo $thingsa_info['details']; ?>
					 	</div>
					</div>
			</div>
			
		</div>
</div>
<div class="well">
	<div class="row">
	<div class="col-xs-12 col-md-5">
		<h4 style="margin-top:-10px">Add New Comment:</h4>
		<form role="form" method="post" onsubmit="return form.req(this)" data-action="thingsahisdetails" data-res="success.push('Call Details Added Successfully!!');window.location.href='<?php echo BASE."things"; ?>'">
	   		<input type="hidden" name="td_id" value="<?php echo $thingsa_info['id']; ?>">
				<div class="row">
	    			<div class="col-xs-12">
	      				<label>Comments:</label>
	      			<textarea name="comments" ><?php echo $thingsa_info['comments']; ?></textarea>
	    		</div>
			  </div><div class="row mt10">			
     <div class="col-xs-4">
     	<label>Status:</label>
         <select  class="browser-default" name="status" >
        <?php if(!empty($thingsa_info['status'])): ?>
            <option value="<?php echo $thingsa_info['status']; ?>"selected><?php echo $thingsa_info['status']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Status</option>
        <?php endif; ?>
        <option value="Started">Started </option>
        <option value="WIP">WIP</option>
        <option value="Completed">Completed </option>
        </select>
    </div>
    </div><div class="row mt10">
    <div class="col-xs-12">
      		<button type="submit" class="btn">Submit</button>
    </div> 
  </div>	

</form>
	</div>
	
</div>
</div>
