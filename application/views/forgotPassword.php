<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);
?>



  <main>
    <div class="container">
    <br>
      <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
          <div class="card-panel">
            <div class="row">
              <div class="col-xs-12 col-md-12">
                <h4 class="teal-text text-darken-1 center">Choose new password</h4>
              </div>
            </div>

            <div class="row center">
              <form class="col-xs-12 col-md-10 col-md-offset-1" method="post" onsubmit='if( form.valid.action1(this) ){ form.req(this);}return false;'  data-action="resetpass" data-res='window.location.href="<?php echo BASE."profile"; ?>"' >
                  <div class="row">
                    <div class="input-field col-xs-12 col-md-6">
                      <input id="password" name="password" type="password"  data-condition="simple"  >
                      <label for="password">Password</label>
                    </div>
                    <div class="input-field col-xs-12 col-md-6">
                      <input id="confirm_password" name="cpassword" type="password" data-condition="password"  >
                      <label for="confirm_password">Confirm Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col-xs-12">
                      <button class="btn waves-effect waves-light" type="submit" id="submit_button">
                        Submit<i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <br><br>
    </div>
  </main>


<?php

load_view("Template/footer.php",$inp);
load_view("Template/bottom.php", $inp);

?>
