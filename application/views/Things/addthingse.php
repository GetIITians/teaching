<form role="form" method="post" onsubmit="return form.req(this)" data-action="<?php echo $thingse_details['action'] ?>" data-res="div.reload($('#thingsetbl')[0]);success.push('Data Updated Successfully!!');mohit.popup_close('<?php echo $thingse_details['popup_close']  ?>');div.reload($('#thingse_regform')[0]);">
  <input type="hidden" name="id" value="<?php echo $thingse_details['id'] ?>">
  <div class="row">
    <div class="col-xs-12 col-md-6">
           <select  class="browser-default" name="category" >
        <?php if(!empty($thingse_details['category'])): ?>
            <option value="<?php echo $thingse_details['category']; ?>"selected><?php echo $thingse_details['category']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Category</option>
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
      <textarea name="details"  placeholder="Details"><?php echo $thingse_details['details']; ?></textarea>
    </div> 
  </div>
  <div class="row">
    <div class=" col-xs-12 col-md-6">
           <select  class="browser-default" name="responsibility" >
        <?php if(!empty($thingse_details['responsibility'])): ?>
            <option value="<?php echo $thingse_details['responsibility']; ?>"selected><?php echo $thingse_details['responsibility']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Responsibility</option>
        <?php endif; ?>
        <option value="Himanshu Jain">Himanshu Jain</option>
        <option value="Ashish Anand">Ashish Anand</option>
        <option value="Narayan">Narayan</option>
        <option value="Yogesh Saini">Yogesh Saini</option>
        <option value="Yogendra">Yogendra</option>
        <option value="Anupriya Jain">Anupriya Jain</option>
        </select>
    </div>
    
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12 col-md-6 mt20">
      <button type="submit" class="btn">Submit</button>
    </div> 
  </div>
</form>