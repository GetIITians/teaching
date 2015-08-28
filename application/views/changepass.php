<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");
?>

<main>
<div class="container">
  <div class="card-panel">
    <div class="row">
      <div class="col-xs-12">
        <h3 class="teal-text text-darken-1 center">Change Password</h3>
      </div>
    </div>
    <div class="row center">
      <form class="col-xs-12 col-sm-6 col-sm-offset-3" method="post" onsubmit='if(form.valid.action(this)){form.sendreq1(this, $(this).find("button[type=submit]")[0]);};return false;' data-action="changepassword" data-res='success.push("Password Changed!");' >
      	<?php
          disperror($cpmsg);
          load_view("Template/input.php",array('label'=>"Old password","name"=>"opassword","type"=>"password"));
          load_view("Template/input.php",array('label'=>"New password","name"=>"npassword","id"=>"password","type"=>"password"));
          load_view("Template/input.php",array('label'=>"Confirm","name"=>"rpassword","dc"=>"password","type"=>"password"));
      	?>
        <div class="row">
          <div class="input-field col-xs-12 col-sm-12">
            <button class="btn waves-effect waves-light" type="submit" name="changepassword" >Change Password
              <i class="mdi-content-send right"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
   
  </div>
</div>
</main>




<?php
load_view("Template/footernew.php");
load_view("Template/bottom.php",array("needbody"=>false));
?>
