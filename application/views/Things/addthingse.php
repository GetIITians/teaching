<form role="form" method="post" onsubmit="return form.req(this)" data-action="<?php echo $thingse_details['action'] ?>" data-res="div.reload($('#thingsetbl')[0]);success.push('Data Updated Successfully!!');mohit.popup_close('<?php echo $thingse_details['popup_close']  ?>');div.reload($('#thingse_regform')[0]);">
	<input type="hidden" name="id" value="<?php echo $thingse_details['id'] ?>">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<label>Category</label>
			<select  class="browser-default" name="category" >
				<?php if(!empty($thingse_details['category'])): ?>
				<option value="<?php echo $thingse_details['category']; ?>"selected><?php echo $thingse_details['category']; ?></option>  
				<?php else: ?>
				<option value="" disabled="disabled" selected="selected">Select</option>
				<?php endif; ?>
				<option value="Money transaction">Money transaction</option>
				<option value="Student">Student</option>
				<option value="Teacher">Teacher</option>
				<option value="Planning">Planning</option>
				<option value="Marketing">Marketing</option>
				<option value="Team">Team</option>
				<option value="Website">Website</option>
				<option value="Funding">Funding</option>
				<option value="PR">PR</option>
				<option value="Admin">Admin</option>
				<option value="Study">Study</option>
				<option value="Buy">Buy</option>
			</select>
		</div>
		<div class="col-xs-12 col-md-6">
			<label>Details</label>
			<textarea name="details"  placeholder="Write Ex. work1,,work2,,work3 etc."><?php echo $thingse_details['details']; ?></textarea>
		</div> 
	</div>
	<div class="row">
		<div class=" col-xs-12 col-md-6">
			<label>Responsibility</label>
			<select  class="browser-default" name="responsibility" >
				<?php if(!empty($thingse_details['responsibility'])): ?>
				<option value="<?php echo $thingse_details['responsibility']; ?>"selected><?php echo $thingse_details['responsibility']; ?></option>  
				<?php else: ?>
				<option value="" disabled="disabled" selected="selected">Select</option>
				<?php endif; ?>
				<option value="Himanshu Jain">Himanshu Jain</option>
				<option value="Narayan">Narayan</option>
				<option value="Yogendra">Yogendra</option>
				<option value="Anupriya Jain">Anupriya Jain</option>
				<option value="Sabita Jaiswal">Sabita Jaiswal</option>
				<option value="Krittika Saxena">Krittika Saxena</option>
				<option value="Gaurav Maan">Gaurav Maan</option>
			</select>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-6">
					<label>Start time</label>
					<input type="time" name="start" placeholder="00:00 24Hr Format">
				</div>
				<div class="col-xs-6">
					<label>End time</label>
					<input type="time" name="end" placeholder="00:00 24Hr Format">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-md-6 mt20">
			<button type="submit" class="btn">Submit</button>
		</div>
	</div>
</form>