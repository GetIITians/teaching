<form role="form" method="post" onsubmit="return form.req(this)" data-action="caller_addteacher" data-res="success.push('Teacher Added Successfully!!');mohit.popup_close('addteacherpopup');">
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
  <div class="row">
    <div class="col-xs-6">
      <button type="submit" class="btn">Submit</button>
    </div> 
  </div>
</form>