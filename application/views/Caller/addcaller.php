<h5>Personal Details :</h5>
<form role="form" method="post" onsubmit="return form.req(this)" data-action="<?php echo $caller_details['action'] ?>" data-res="success.push('Data Updated Successfully!!');mohit.popup_close('<?php echo $caller_details['popup_close']  ?>');div.reload($('#callertlb')[0]);div.reload($('#caller_regform')[0]);">
  <input type="hidden" name="id" value="<?php echo $caller_details['id'] ?>">
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <input  type="text" name="name"   placeholder="Name" value="<?php echo $caller_details['name'] ?>">
    </div>
    <div class="col-xs-12 col-md-6">
      <input type="email" name="email"  placeholder="Email id" value="<?php echo $caller_details['email']; ?>">
    </div> 
  </div>
  <div class="row">
    <div class=" col-xs-12 col-md-3">
      <input type="text" name="phone" placeholder="Mobile No." value="<?php echo $caller_details['phone']; ?>">
    </div>
    <div class=" col-xs-12 col-md-3">
           <select  class="browser-default" name="source"  onchange="yogy.inserthtml(this,$('#source_other'))"  >
        <?php if(!empty($caller_details['source'])): ?>
            <option value="<?php echo $caller_details['source']; ?>"selected><?php echo $caller_details['source']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Source</option>
        <?php endif; ?>
        <option value="Pamplet">Pamphlet</option>
        <option value="Sunpack">Sunpack</option>
        <option value="Poster">Poster</option>
        <option value="Website">Website</option>
        <option value="Referal">Referral</option>
        <option value="other">Other</option>
        </select>
        <div id="source_other">
        </div>   
    </div>
    <div class="col-xs-12 col-md-6">
      <textarea name="address" placeholder="Address"><?php echo $caller_details['address']; ?></textarea>
    </div>
  </div>
  <hr>
  <h5>Academic  Details :</h5>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <select  class="browser-default" name="class">
        <?php if(!empty($caller_details['class'])): ?>
            <option value="<?php echo $caller_details['class']; ?>"selected><?php echo $caller_details['class']; ?></option>  
          <?php else: ?>
        <option value="" disabled="disabled" selected="selected">Class</option>
        <?php endif; ?>
        <option value="6th">6th</option>
        <option value="7th">7th</option>
        <option value="8th">8th</option>
        <option value="9th">9th</option>
        <option value="10th">10th</option>
        <option value="11th">11th</option>
        <option value="12th">12th</option>
        <option value="JEE">JEE</option>
        <option value="other">Other</option>
      </select>
    </div>
    <div class="col-xs-12 col-md-6">
      <select  class="browser-default" name="subject">
        <?php if(!empty($caller_details['subject'])): ?>
            <option value="<?php echo $caller_details['subject']; ?>"selected><?php echo $caller_details['subject']; ?></option>  
          <?php else : ?>
        <option value="" disabled="disabled" selected="selected">Subjects</option>
          <?php endif; ?>
        <option value="Physics">Physics</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Maths">Maths</option>
        <option value="Science">Science</option>
        <option value="Physics-Chemistry">Physics-Chemistry</option>
        <option value="Physics-Maths">Physics-Maths</option>
        <option value="Chemistry-Maths">Chemistry-Maths</option>
        <option value="Physics-Chemistry-Maths">Physics-Chemistry-Maths</option>
        <option value="Other">Other</option>
      </select>
    </div> 
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-6">
     <input type="text" name="board" placeholder="Board" value="<?php echo $caller_details['board']; ?>">
    </div>
    <div class="col-xs-12 col-md-6 mt20">
    <div class="row">
      <div class="col-xs-12 col-md-3">
        <input type="checkbox" class="filled-in" id="online" name="online_tution" <?php if(Fun::gettutiontypeex($caller_details['tution_type'])['online_tution']=='true') echo 'checked'; ?> />
        <label for="online">Online</label>
      </div>
      <div class="col-xs-12 col-md-3">
        <input type="checkbox" class="filled-in" id="home" name="home_tution"  <?php if(Fun::gettutiontypeex($caller_details['tution_type'])['home_tution']=='true') echo 'checked'; ?>/>
        <label for="home">Home</label>
      </div>
      <div class="col-xs-12 col-md-4">
        <input type="checkbox" class="filled-in" id="atcenter" name="atcenter_tution"  <?php if(Fun::gettutiontypeex($caller_details['tution_type'])['atcenter_tution']=='true') echo 'checked'; ?>/>
        <label for="atcenter">At Center</label>
      </div>
      </div>
    </div>
  </div>
  <hr>
  <?php if($caller_details['action']!='editcallerinfo'): ?>
  <h5>Teachers  Details :</h5>
  <div class="row">
    <div class="col-xs-12 col-md-6">
       <select  class="browser-default" name="teacher_id">
          <?php if(!empty($caller_details['teacher'])): ?>
            <option value="<?php echo $caller_details['teacher']; ?>"selected><?php echo $caller_details['teacher']; ?></option>  
          <?php else : ?>
        <option value="0"  selected="selected" disabled>Select A teacher</option>
        <option value="0"  style="color:#002ACC;">Not Selected</option>
      <?php endif; ?>
        <?php foreach($teacher_info as $row): ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
        <?php endforeach; ?>
      </select>  
    </div>
     <div class="col-xs-12 col-md-6">
       <input type="text" name="fees" placeholder="Fees agreed">
    </div>
  </div>
  <div class="row">  
    <div class="col-xs-12 col-md-6">
      <select  class="browser-default" name="demo_id">
        <option value="0" selected="selected" disabled>Demo Fixed</option>
          <?php foreach($demo_info as $row): ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
        <?php endforeach; ?>
      </select>    
    </div> 
  </div>
  <hr>
<?php endif; ?>
  <h5>Caller's  Details :</h5>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <input type="text" name="caller_name"  placeholder="Caller Name" value="<?php echo $caller_details['caller_name']; ?>">
    </div>
    <div class="col-xs-12 col-md-6">
      <select name="caller_rel" class="browser-default">
         <?php if(!empty($caller_details['caller_rel'])): ?>
            <option value="<?php echo $caller_details['caller_rel']; ?>"selected><?php echo $caller_details['caller_rel']; ?></option>  
          <?php else : ?>
        <option value="" disabled="disabled" selected="selected">Caller's Relationship</option>
        <?php endif; ?>
        <option value="Mother">Mother</option>
        <option value="Father">Father</option>
        <option value="Guardian">Guardian</option>
        <option value="Student">Student</option>
        <option value="Others">Others</option>
      </select>    
    </div> 
  </div>
  <?php if($caller_details['action']!='editcallerinfo'): ?>
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <textarea name="comments" placeholder="Comments"><?php echo $caller_details['comments']; ?></textarea>
    </div>
  </div>
<?php endif; ?>
  <div class="row">
    <div class="col-xs-12 col-md-6 mt20">
      <button type="submit" class="btn">Submit</button>
    </div> 
  </div>
</form>