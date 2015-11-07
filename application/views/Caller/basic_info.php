<?php $sdetails = array("name"=>$caller_info['name'],"email"=>$caller_info['email'],"phone"=>$caller_info['phone']);
	  $tdetails = array("name"=>$teaching_info['name'],"email"=>$teaching_info['email'],"phone"=>$teaching_info['phone']);	
 		
 ?>
 <div class="well mt10">
<div class="row">
			<div class="col-sm-3">
				<h4>Personal Details:</h4>
				 	<div class="row">
					 	<div class="col-sm-5">
					 		Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['name']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Mobile No :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['phone']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Email-Id :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['email']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Source :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['source']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Created :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php if(!empty($caller_info['created_at'])) echo date("d-M-Y",$caller_info['created_at']); ?>
					 	</div>
					</div>
			</div>
			<div class="col-sm-3">
			 	<h4>Academic Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Class :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['class']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Subject :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['subject']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Board :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['board']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Tution Type :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['tution_type']; ?>
					 	</div>
					</div>
			</div>
			<div class="col-sm-3">
			 	<h4>Teacher Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['name']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Mobile No. :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['phone']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Email-Id  :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['email']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		City  :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php if(!empty($teaching_info['city'])) echo $teaching_info['city']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Demo :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['demo']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Fees :
					 	</div>
					 	<div class="col-sm-7">
					 		Rs. <?php echo $teaching_info['fees']; ?>
					 	</div>
					</div>

			</div>
			<div class="col-sm-3">
			 	<h4>Caller Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Caller Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['caller_name']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Relation :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['caller_rel']; ?>
					 	</div>
					</div>
			</div>
		</div>
</div>
<div class="well">
	<div class="row">
	<div class="col-xs-5">
		<h4 style="margin-top:-10px">Add New Call Comment:</h4>
		<form role="form" method="post" onsubmit="return form.req(this)" data-action="calldetails" data-res="success.push('Call Details Added Successfully!!');window.location.href='<?php echo BASE."caller"; ?>'">
			<input type="hidden" name="sdetails" value='<?php echo json_encode($sdetails);?>'>
	   		<input type="hidden" name="st_id" value="<?php echo $caller_info['id']; ?>">
				<div class="row">
	    			<div class="col-xs-12">
	      				<label>Comments:</label>
	      			<textarea name="comments" ><?php echo $teaching_info['comments']; ?></textarea>
	    		</div>
			  </div><div class="row mt10">			
    <div class="col-xs-4">
    	<label>Demo:</label>
      <input type="hidden" name="demo_old_id" value="<?php echo $teaching_info['demo_id']; ?>">
      <select  class="browser-default" name="demo_id">
        <option value="0" disabled="disabled" selected="selected">Demo Fixed</option>
        <?php if(!empty($teaching_info['demo'])): ?>
        <option value="<?php echo $teaching_info['demo_id']; ?>" selected="selected"><?php echo $teaching_info['demo']; ?></option>	
        <?php endif; ?>
            <?php foreach($demo_info as $row): ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
        <?php endforeach; ?>
      </select>    
    </div> 
    <div class="col-xs-4">
      <label>Teacher:</label>
      <select  class="browser-default" name="teacher_id">
        <?php if(!empty($teaching_info['name'])): ?>
        <option value="<?php echo $teaching_info['teacher_id']; ?>" selected><?php echo $teaching_info['name']; ?> </option>
        <?php else: ?>
        <option value="0" disabled="disabled" selected="selected">Select A teacher</option>
        <?php endif; ?>	
        <option value="0"  style="color:#002ACC;">Not Selected</option>
        <?php foreach($teacher_info as $row): ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
        <?php endforeach; ?>
      </select>  

    </div>
     <div class="col-xs-4">
     	<label>Fees agreed:</label>
       <input type="text" name="fees"  value="<?php echo $teaching_info['fees']; ?>" placeholder="Rs.">
    </div>
    </div><div class="row mt10">
    <div class="col-xs-12">
      		<button type="submit" class="btn">Submit</button>
    </div> 
  </div>	

</form>
	</div>
	<div class="col-xs-4">
		<h4 style="margin-top:-10px">Send A Message:</h4>
    <form role="form" method="post" onsubmit="return form.req(this)" data-action="caller_sendmsg" data-res="success.push('Message Sent Successfully!!');">
    
    <input type="hidden" name="sdetails" value='<?php echo json_encode($sdetails);?>'>
    <input type="hidden" name="tdetails" value='<?php echo json_encode($tdetails);?>'>
    <div class="row">
    <div class="col-xs-4">
       <input type="checkbox" class="filled-in" id="teacher" name="teacherc" checked />
        <label for="teacher">Teacher</label>
    </div>
    <div class="col-xs-4">
       <input type="checkbox" class="filled-in" id="student" name="studentc" checked />
        <label for="student">Student</label>
    </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
      <label>Subject:</label>
      <input type="text" name="sub">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
      <label>Message</label>
  	      	<textarea name="msg" ></textarea>
  	   </div>
			</div>
        <div class="row mt10">			
        <div class="col-xs-3">
       <input type="checkbox" class="filled-in" id="sms" name="sms" checked />
        <label for="sms">SMS</label>
    </div>
    <div class="col-xs-3">
       <input type="checkbox" class="filled-in" id="email" name="email" checked />
        <label for="email">Email</label>
    </div>
        <div class="col-xs-5">
      		<button type="submit" class="btn">Send</button>

	</div>
	</div>
</form>
</div>
<div class="col-xs-3">
<h4 style="margin-top:-10px">Send Prefix Mails:</h4>

<form role="form" method="post" onsubmit="return form.req(this)" data-action="caller_prefixmails" data-res="success.push('Mail Sent Successfully!!');" >
    <input type="hidden" name="sdetails" value='<?php echo json_encode($sdetails);?>'>
    <input type="hidden" name="tdetails" value='<?php echo json_encode($tdetails);?>'>
    <div class="row">
      <div class="col-xs-12">
      <select class="browser-default" name="mailtype" >
        <option value="intro">Introduction</option>
        <option value="demoschedule">Demo Schedule</option>
        <option value="demoscheduleonline">Demo Online Schedule</option>
        <option value="demoaccept">Demo Accepted</option>
        <option value="demoreject">Demo Rejected</option>
        <option value="feedbackp">Feedback Positive</option>
        </select>
    </div>
</div>
    <div class="row mt20">
    <div class="col-xs-6 ">
       <input type="checkbox" class="filled-in" id="teacherc" name="teacherc" checked />
        <label for="teacherc">Teacher</label>
    </div>
    <div class="col-xs-6">
       <input type="checkbox" class="filled-in" id="studentc" name="studentc" checked />
        <label for="studentc">Student</label>
    </div>
    </div>
    <div class="row mt20">
          <div class="col-xs-12">
          <button type="submit" class="btn">Send</button>
          </div>
    </div>
   </form>
</div>
</div>
</div>
