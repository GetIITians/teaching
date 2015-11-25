<form role="form" method="post" onsubmit="return form.req(this)" data-action="<?php echo $thingsahimanshu_details['action'] ?>" data-res="div.reload($('#thingsahimanshutbl')[0]);success.push('Data Updated Successfully!!');mohit.popup_close('<?php echo $thingsahimanshu_details['popup_close']  ?>');div.reload($('#thingsa_regform')[0]);">
  <input type="hidden" name="id" value="<?php echo $thingsahimanshu_details['id'] ?>">
  <div class="row">
    <div class="col-xs-12 col-md-6">
           <label>Category</label>
           <select  class="browser-default" name="category" >
        <?php if(!empty($thingsahimanshu_details['category'])): ?>
            <option value="<?php echo $thingsahimanshu_details['category']; ?>"selected><?php echo $thingsahimanshu_details['category']; ?></option>  
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
      <input type="text" name="details" value="<?php echo $thingsahimanshu_details['details']; ?>">
    </div> 
  </div>
  <div class="row">
    <div class=" col-xs-12 col-md-6">
           <label>Responsibility</label>
           <select  class="browser-default" name="responsibility" >
        <?php if(!empty($thingsahimanshu_details['responsibility'])): ?>
            <option value="<?php echo $thingsahimanshu_details['responsibility']; ?>"selected><?php echo $thingsahimanshu_details['responsibility']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Select</option>
        <?php endif; ?>
        <option value="Himanshu Jain">Himanshu Jain</option>
        <option value="Ashish Anand">Ashish Anand</option>
        <option value="Narayan">Narayan</option>
        <option value="Yogesh Saini">Yogesh Saini</option>
        <option value="Yogendra">Yogendra</option>
        <option value="Anupriya Jain">Anupriya Jain</option>
        </select>
    </div>
    <div class=" col-xs-12 col-md-6">
           <label>Due Date</label>
           <input type="date" class="browser-default" name="due_date" value="<?php if(!empty($thingsahimanshu_details['due_date'])) echo $thingsahimanshu_details['due_date']; ?>" >
      </div>
  </div>
  <?php if($thingsahimanshu_details['action']!='editthingsahimanshuinfo'): ?>
  <div class="row">
    <div class="col-xs-12 col-md-6">
           <label>Status</label>
           <select  class="browser-default" name="status" >
        <?php if(!empty($thingsahimanshu_details['status'])): ?>
            <option value="<?php echo $thingsahimanshu_details['status']; ?>"selected><?php echo $thingsahimanshu_details['status']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Select</option>
        <?php endif; ?>
        <option value="Allotted">Allotted</option>
        <option value="WIP">WIP</option>
        <option value="Completed">Completed</option>
        </select>
    </div>
        <div class="col-xs-12 col-md-6">
      <label>Comments</label>
      <textarea name="comments"><?php echo $thingsahimanshu_details['comment']; ?></textarea>
    </div>

  </div>
<?php endif; ?>
  <hr>
  <div class="row">
    <div class="col-xs-12 col-md-6 mt20">
      <button type="submit" class="btn">Submit</button>
    </div> 
  </div>
</form>