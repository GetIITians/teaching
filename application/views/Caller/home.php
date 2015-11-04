<?php 
load_view("popup.php",array("name"=>"addcollerpopup", "title" => "New Entry Registeration Form","body" =>"Caller/addcaller.php","bodyinfo" => array() )); 
?>
<div class="container" id="main_container">
  <div class="row">
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addcollerpopup")'>Add New Entry</button> 
  </div>
  <div class="col-sm-2" style="margin-top:10px">
  <a href="#" class="btn">Send Message</a>
  </div>
  </div>
  <div class="row" style="margin-top:10px" id="callertlb" data-action="callertbl">
  	<?php
   		handle_disp(array(), "callertbl");
   	?>
  </div>
</div>
