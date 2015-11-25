<?php $thingsahimanshu_info['status'] = Fun::getcomfortstatus($thingsahimanshu_info['status'],$thingsahimanshu_info['due_date']); ?>
<div class="well mt10">
	<div class="row">
		<div class="col-sm-12">
			<h4>Details:</h4>
			<div class="row">
			 	<div class="col-sm-3">
			 		Category :
			 		<?php echo $thingsahimanshu_info['category']; ?>
				</div>
			 	<div class="col-sm-3">
			 		Responsibility :
			 		<?php echo $thingsahimanshu_info['responsibility']; ?>
				</div>
			 	<div class="col-sm-3">
			 		Due date :
			 		<?php if(!empty($thingsahimanshu_info['due_date'])) echo date("d-M-Y",$thingsahimanshu_info['due_date']);  ?>
				</div>
				<div class="col-sm-3" style="background:<?php echo Fun::getstatuscolor($thingsahimanshu_info['status']) ?>">
					Status : <?php 	echo $thingsahimanshu_info['status']; ?>
				</div>
			</div>
			<div class="row">
			 	<div class="col-sm-12">
			 		Details :
			 		<?php echo $thingsahimanshu_info['details']; ?>
			 	</div>
			</div>
		</div>
	</div>
	
</div>
<div class="well">
	<div class="row">
	<div class="col-xs-12 col-md-5">
		<h4 style="margin-top:-10px">Add New Comment:</h4>
		<form role="form" method="post" onsubmit="return form.req(this)" data-action="thingsahimanshuhisdetails" data-res="success.push('Call Details Added Successfully!!');window.location.href='<?php echo BASE."thingshimanshu"; ?>'">
	   		<input type="hidden" name="td_id" value="<?php echo $thingsahimanshu_info['id']; ?>">
				<div class="row">
	    			<div class="col-xs-12">
	      				<label>Comments:</label>
	      			<textarea name="comments" ><?php echo $thingsahimanshu_info['comments']; ?></textarea>
	    		</div>
			  </div><div class="row mt10">			
     <div class="col-xs-4">
     	<label>Status:</label>
         <select  class="browser-default" name="status" >
        <?php if(!empty($thingsahimanshu_info['status'])): ?>
            <option value="<?php echo $thingsahimanshu_info['status']; ?>"selected><?php echo $thingsahimanshu_info['status']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Status</option>
        <?php endif; ?>
<?php if(User::isloginas('a')): ?>
        <option value="Allotted">Allotted</option>
<?php endif;?>
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