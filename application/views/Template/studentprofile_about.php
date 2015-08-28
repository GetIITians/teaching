<br><br>
<div class="row">
  <div class="col-xs-12">
    <h5 class="teal-text text-darken-1">Profile Details</h5>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <img class="materialboxed" height="100" width="100" src="<?php  echo $sinfo["profilepic"]; ?>">
    <br>
    <!-- Change Profile Picture -->
    <?php
      if(User::loginId() == $sid){
    ?>
    <form method="post" enctype="multipart/form-data"> 
      <a onclick='uploadfile(this,"profilepic");' style="cursor:pointer;" >Change Profile Picture</a>
    </form>
    <?php
      }
    ?>
    <!--
    <div id="pic_upload" class="modal">
      <div class="modal-content">
        <h6 class="teal-text">Change Profile Picture</h6>
      </div>

      <div class="row">
        <form action="#" class="col-xs-12 col-sm-8 offset-l2">
          <div class="row">
            <div class="file-field input-field col-xs-12">
              <input class="file-path validate" type="text">
              <div class="btn waves-effect waves-light blue">
                <span>Open</span>
                <input type="file">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn waves-effect waves-light white grey-text">Change</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    -->
  </div>
</div>
<div id="profile_info">
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      Name
    </div>
    <div class="col-xs-12 col-sm-6">
      <span class="grey-text text-darken-1"><?php echo $sinfo["name"]; ?></span>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      Email
    </div>
    <div class="col-xs-12 col-sm-6">
      <span class="grey-text text-darken-1"><?php echo $sinfo["email"]; ?></span>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      Mobile Number
    </div>
    <div class="col-xs-12 col-sm-6">
      <span class="grey-text text-darken-1"><?php echo $sinfo["phone"]; ?></span>
    </div>
  </div>
</div>

<div class="row" style='display:none;' >
  <div class="col-xs-12">
    <h6>
      <a onclick="editProfile();" style="cursor:pointer;">
        <i class="mdi-editor-mode-edit left"></i>Edit Profile&nbsp;&nbsp;
        <i id="edit_prefix_arrow" class="mdi-hardware-keyboard-arrow-up"></i>
      </a>
    </h6>
  </div>
</div>

<div id="edit_profile_info">
<br>
  <form onsubmit='form.req(this);return false;' data-action="saveuserdetails">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        Name
      </div>
      <div class="col-xs-12 col-sm-4">
        <input name="name" placeholder="Enter your full name" type="text" value="<?php echo convchars($sinfo["name"]); ?>" class="validate">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        Email
      </div>
      <div class="col-xs-12 col-sm-4">
        <input name="email" placeholder="Enter your email address" type="email" value="<?php echo $sinfo["email"]; ?>" class="validate">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        Mobile Number
      </div>
      <div class="col-xs-12 col-sm-4">
        <input name="phone" placeholder="Enter your mobile number" type="text" value="<?php echo convchars($sinfo["phone"]); ?>" class="validate">
      </div>
    </div>
    <div class="row" style="<?php dit(false); ?>">
      <div class="col-xs-12 col-sm-4">
        Gender
      </div>
      <div class="col-xs-12 col-sm-4">
        <select name="gender" class="browser-default">
          <option value="" disabled selected>Select gender</option>
           <?php
              $olist=array("Male","Female");
              $sinfo["gender"]="M";
              foreach($olist as $i=>$disp){
            ?>
              <option value="<?php echo $disp[0]; ?>">
                <?php echo $disp; ?>
              </option>
            <?php
              }
            ?>
        </select>
      </div>
    </div>
    <div class="row" style="<?php dit(false); ?>" >
      <div class="col-xs-12 col-sm-4">
        Date Of Birth
      </div>
      <div class="col-xs-12 col-sm-4">
        <input name="dob" placeholder="Add date of birth" type="date" value="" class="datepicker">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <button type="submit" class="btn blue waves-effect waves-light" ><i class="mdi-content-save left"></i>Save Edit</button>
        <a class="btn white grey-text waves-effect waves-grey" onclick='hideshowdown("edit_profile_info", "profile_info", 1000);'  >Cancel Edit</a>
      </div>
    </div>
  </form>
</div>