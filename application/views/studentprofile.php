<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);
?>
  <main>
    <div class="container">
    <br>
      <div class="card-panel">
        <div class="row">
          <div class="col-xs-12">
            <ul class="tabs">
              <li class="tab col-xs-3"><a class="active" href="#tab_profile">Profile</a></li>
              <li class="tab col-xs-3"><a href="#tab_classes">Classes</a></li>
              <li class="tab col-xs-3"><a href="#tab_reviews">Reviews</a></li>
              <li class="tab col-xs-3"><a href="#tab_account">Account</a></li>
            </ul>
          </div>
          <div id="tab_profile" class="col-xs-12 col-md-offset-2">
          <?php
            load_view("Template/studentprofile_about.php", $inp);
          ?>
          </div>

          <div id="tab_classes" class="col-xs-12">
          <?php
            load_view("Template/studentprofile_classes.php", $inp);
          ?>
          </div>
          <div id="tab_reviews" class="col-xs-12">
          <?php
            load_view("Template/studentprofile_reviews.php", Fun::mergeifunset($inp, array("reviewname" => "teachername")));
          ?>
          </div>
          <div id="tab_account" class="col-xs-12">
          <?php
            load_view("Template/moneyaccount.php", $inp);
          ?>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php
load_view("Template/footer.php",$inp);
load_view("popup.php", array("name" => "writereview", "body" => "Template/reviewform.php", "divs" => "padding:0px;"));

load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
  <script src="js/studentprofile.js"></script>
  <script type="text/javascript">
    $("#review_stars").raty();
  </script>
</body>
</html>