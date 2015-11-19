<?php $thingsa_info['status'] = Fun::getcomfortstatus($thingsa_info['status'],$thingsa_info['due_date']); ?>
<div class="well mt10">
	<div class="row">
		<div class="col-sm-12">
			<h4>Details:</h4>
			<div class="row">
			 	<div class="col-sm-3">
			 		Category :
			 		<?php echo $thingsa_info['category']; ?>
				</div>
			 	<div class="col-sm-3">
			 		Responsibility :
			 		<?php echo $thingsa_info['responsibility']; ?>
				</div>
			 	<div class="col-sm-3">
			 		Due date :
			 		<?php if(!empty($thingsa_info['due_date'])) echo date("d-M-Y",$thingsa_info['due_date']);  ?>
				</div>
				<div class="col-sm-3" style="background:<?php echo Fun::getstatuscolor($thingsa_info['status']) ?>">
					Status : <?php 	echo $thingsa_info['status']; ?>
				</div>
			</div>
			<div class="row">
			 	<div class="col-sm-12">
			 		Details :
			 		<?php echo $thingsa_info['details']; ?>
			 	</div>
			</div>
		</div>
	</div>
	
</div>
<?php if(User::isloginas('a')): ?>
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
        <option value="Allotted">Allotted</option>
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
<?php endif;?>