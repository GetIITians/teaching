<?php 
load_view("popup.php",array("name"=>"editthingspopup", "title" => "Edit Details" )); 
?>
<div id="thingsa_regform" data-action="thingsa_regiform">
  <?php handle_disp(array(),"thingsa_regiform"); ?>
</div>
<div id="thingse_regform" data-action="thingse_regiform">
  <?php handle_disp(array(),"thingse_regiform"); ?>
</div>
<div class="container" id="main_container">
  <div class="row">
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addthingsapopup")'>Add Things To do</button> 
  </div>
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addthingsepopup")'>Add Things Done</button> 
  </div>
  <form method="post" id="callersearch" >
  <div class="col-sm-2.5" style="margin-top:10px;float:right;display:none" >
    <select  class="browser-default" name="orderby" onchange="yogy.caller_search()" >
    <option value="0" selected disabled>Filter By</option>
      <option value="1">ID (Low to High)</option>
      <option value="2">ID (High to Low)</option>
      <option value="3">Student Name(A to Z)</option>
      <option value="4">Student Name(Z to A)</option>
      <option value="5">Teacher Name(A to Z)</option>
      <option value="6">Teacher Name(Z to A)</option>
      <option value="7">Demo</option>
    </select>
  </div>
  </form>
  </div>
  <ul class="row nav nav-tabs mt10">
    <li class="active"><a data-toggle="tab" href="#thingsatbl">Things To do</a></li>
    <li><a data-toggle="tab" href="#thingsetbl">Things Done</a></li>
  </ul>

  <div class="row tab-content " style="margin-top:10px">
  	<div  class="tab-pane fade in active"  id="thingsatbl" data-action="thingsatbl">
     <?php
      handle_disp(array(), "thingsatbl");
    ?>
    </div>
    <div class="tab-pane fade"  id="thingsetbl" data-action="thingsetbl">
    <?php
      handle_disp(array(), "thingsetbl");
    ?>
    </div>
   </div>
 
</div>
