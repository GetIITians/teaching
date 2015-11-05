<?php 
$teacher_info = Sqle::getA("SELECT * from caller_teacher");
load_view("popup.php",array("name"=>"addcollerpopup", "title" => "New Entry Registration Form","body" =>"Caller/addcaller.php","bodyinfo" => array("teacher_info" => $teacher_info,"caller_details" => array("id"=>"","action"=>"callerinfo","popup_close"=>"addcollerpopup","name"=>"","email"=>"","phone"=>"","address"=>"","class"=>"","subject"=>"","board"=>"","tution_type"=>"","caller_name"=>"","caller_rel"=>"","created_at"=>"","updated_at"=>"","caller_date"=>"","comments"=>"")) )); 
load_view("popup.php",array("name"=>"addteacherpopup", "title" => "Add A Teacher","body" =>"Caller/addteacher.php","bodyinfo" => array() )); 
load_view("popup.php",array("name"=>"editcollerpopup", "title" => "Edit Details" )); 
?>
<div class="container" id="main_container">
  <div class="row">
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addcollerpopup")'>Add New Entry</button> 
  </div>
  <div class="col-sm-2" style="margin-top:10px">
  <a href="#" class="btn">Send Message</a>
  </div>
  <div class="col-sm-2" style="margin-top:10px">
  <a  class="btn" onclick='mohit.popup("addteacherpopup")'>Add A Teacher</a>
  </div>
  </div>
  <div class="row" style="margin-top:10px" id="callertlb" data-action="callertbl">
  	<?php
   		handle_disp(array(), "callertbl");
   	?>
  </div>
</div>
