<form role="form" method="post" onsubmit="return form.req(this)" data-action="calldetails" data-res="success.push('Call Details Added Successfully!!');mohit.popup_close('callerhistorypopup');div.reload($('#calldetail')[0]);">
  <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
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
        <option value="Girlfriend">Girlfriend</option>
        <option value="Boyfriend">Boyfriend</option>
        <option value="Others">Others</option>
      </select>    
    </div> 
  </div>
  <div class="row">
    <div class="col-xs-6">
      <input type="text" name="caller_no" placeholder="Caller No.">
    </div>
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