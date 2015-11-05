<?php 
load_view("popup.php",array("name"=>"addteacherpopup", "title" => "Add A Teacher","body" =>"Caller/addteacher.php","bodyinfo" => array() )); 
load_view("popup.php",array("name"=>"editcollerpopup", "title" => "Edit Details" )); 
?>
<div id="caller_regform" data-action="caller_regiform">
  <?php handle_disp(array(),"caller_regiform"); ?>
</div>
<div class="container" id="main_container">
  <div class="row">
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addcollerpopup")'>Add New Entry</button> 
  </div>
  <div class="col-sm-2" style="margin-top:10px">
  <a href="#" class="btn">Send Message</a>
  </div>
  <!-- <div class="col-sm-2" style="margin-top:10px">
  <a  class="btn" onclick='mohit.popup("addteacherpopup")'>Add A Teacher</a>
  </div> -->
  </div>
  <div class="row" style="margin-top:10px" id="callertlb" data-action="callertbl">
  	<?php
   		handle_disp(array(), "callertbl");
   	?>
  </div>
</div>
