<form role="form" method="post" onsubmit="return form.req(this)" data-action="callerinfo" data-res="success.push('Ohk dear!!');mohit.popup_close('addcollerpopup');div.reload($('#callertlb')[0]);">
<h5>Personal Details :</h5>
  <div class="row">
    <div class="col-xs-6">
      <input  type="text" name="name"   placeholder="Name">
    </div>
    <div class="col-xs-6">
      <input type="email" name="email"  placeholder="Email id">
    </div> 
  </div>
  <div class="row">
    <div class="col-xs-6">
      <input type="text" name="phone" placeholder="Mobile No.">
    </div>
    <div class="col-xs-6">
      <textarea name="address" placeholder="Address"></textarea>
    </div>
  </div>
  <hr>
  <h5>Academic  Details :</h5>
  <div class="row">
    <div class="col-xs-6">
      <select  class="browser-default" name="class">
        <option value="" disabled="disabled" selected="selected">Class</option>
        <option value="6th">6th</option>
        <option value="7th">7th</option>
        <option value="8th">8th</option>
        <option value="9th">9th</option>
        <option value="10th">10th</option>
        <option value="11th">11th</option>
        <option value="12th">12th</option>
        <option value="JEE">JEE</option>
      </select>
    </div>
    <div class="col-xs-6">
      <select  class="browser-default" name="subject">
        <option value="" disabled="disabled" selected="selected">Subjects</option>
        <option value="6th">Physics</option>
        <option value="6th">Chemistry</option>
        <option value="6th">Maths</option>
        <option value="6th">Science</option>
        <option value="6th">Other</option>
      </select>
    </div> 
  </div>
  <div class="row">
    <div class="col-xs-6">
      <input type="text" name="grade" placeholder="Grade">
    </div>
    <div class="col-xs-6">
     <input type="text" name="board" placeholder="Board">
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <div class="col-xs-4">
        <input type="checkbox" class="filled-in" id="online" name="online_tution" />
        <label for="online">Online</label>
      </div>
      <div class="col-xs-5">
        <input type="checkbox" class="filled-in" id="home" name="home_tution"  />
        <label for="home">Home Tution</label>
      </div>
    </div>
  </div>
  <hr>
  <h5>Teachers  Details :</h5>
  <div class="row">
    <div class="col-xs-6">
      <input type="text" name="teacher"  placeholder="Teacher">

    </div>
     <div class="col-xs-6">
       <input type="text" name="fees" placeholder="Fees agreed">
    </div>
  </div>
  <div class="row">  
    <div class="col-xs-6">
      <select  class="browser-default" name="demo">
        <option value="" disabled="disabled" selected="selected">Demo Fixed</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        <option value="Accepted">Accepted</option>
        <option value="Rejected">Rejected</option>
        <option value="Rescheduled">Rescheduled</option>
        <option value="Others">Others</option>
      </select>    
    </div> 
  </div>
  <hr>
  <h5>Caller's  Details :</h5>
  <div class="row">
    <div class="col-xs-6">
      <input type="text" name="caller_name"  placeholder="Caller Name">
    </div>
    <div class="col-xs-6">
      <select name="caller_rel" class="browser-default">
        <option value="" disabled="disabled" selected="selected">Caller's Relationship</option>
        <option value="Mother">Mother</option>
        <option value="Father">Father</option>
        <option value="Guardian">Guardian</option>
        <option value="Student">Student</option>
        <option value="Others">Others</option>
      </select>    
    </div> 
  </div>
  <div class="row">
    <div class="col-xs-6">
      <textarea name="comments" placeholder="Comments"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <button type="submit" class="btn">Submit</button>
    </div> 
  </div>
</form>