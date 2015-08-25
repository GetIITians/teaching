<main>
  <div class="container">
    <?php
    if($tid==User::loginId()){
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="card-panel">
          <div class="row">
            <nav class="teal">
              <div align=center style='cursor:pointer;' onclick='$("#fillalltsform").slideToggle();' >Click to Add/Remove your free time Slot</div>
            </nav>
            <div class='row' style='padding:0px;margin:0px;display:none;margin-top:30px;' id="fillalltsform" >
              <?php
                load_view("Template/uploadslotform.php",$inp);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>

    <div class='row' >
      <div class="col-xs-12">
      <div class="col-xs-12"  id="divforcalender" >
        <?php
          load_view("dispcal.php",$inp);
        ?>
      </div>
    </div>
  </div>
</main>


