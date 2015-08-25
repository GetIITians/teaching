<?php
load_view("Template/top.php");
load_view("Template/navbar.php");
?>
  <main>
    <div class="container">
      <div class="container">
      <div class="card-panel">
        <div class="row">
          <div align='center' style='color:red;' ><p></p></div>
          <div class="col-xs-12">
            <h4 class="teal-text text-darken-1 center" style="font-weight:bold; font-variant: small-caps;">RESET PASSWORD</h4>
          </div>
        </div>
        <div class="row center">
          <form class="col-xs-12" method="post">
            <div class="row">
              <div class="input-field col-xs-12">
                <input id="pass" name="pass" type="text" class="validate">
                <label for="pass">New Password</label>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="input-field col-xs-12">
                <input id="cpass" name="cpass" type="text" class="validate">
                <label for="cpass">Confirm Password</label>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="input-field col-xs-12">
                <button class="btn waves-effect waves-light" name="signup" type="submit">Submit
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
    </div>
  </main>
<?php
load_view("Template/footer.php",$inp);
load_view("Template/bottom.php",$inp);
?>