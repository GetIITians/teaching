<?php 
load_view("popup.php",array("name"=>"editthingsapopup", "title" => "Edit Details" )); 
?>
<div class="container" id="main_container">
  <ul class="row nav nav-tabs mt10">
    <li class="active"><a data-toggle="tab" href="#thingsa">Things To do</a></li>
    <li><a data-toggle="tab" href="#thingse">Things Done</a></li>
  </ul>
  <div class="row tab-content" style="">
  	<div class="tab-pane fade in active" id="thingsa" >
  <div class="row mt5">
  <?php if(User::isloginas('a')): ?>
  <div class="col-sm-2">
    <div id="thingsa_regform" data-action="thingsa_regiform">
      <?php handle_disp(array(),"thingsa_regiform"); ?>
    </div>
    <button class="btn" onclick='mohit.popup("addthingsapopup")'>Add Things To do</button> 
  </div>
    <?php endif; ?>
  
  <div class="col-sm-2.5" style="float:right;" >
     <form method="post" id="thingsasearch" class="mb0">
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsatbl')[0]);" >
    <option value="0" selected disabled>Filter By</option>
      <option value="1">ID (Low to High)</option>
      <option value="2">ID (High to Low)</option>
      <option value="3">Category (A to Z)</option>
      <option value="4">Category (Z to A)</option>
      <option value="5">Responsibility (A to Z)</option>
      <option value="6">Responsibility (Z to A)</option>
      <option value="7">Due Date (Low to High)</option>
      <option value="8">Due Date (High to Low)</option>
    </select>
  </form>
  </div>
  </div>
     <div class="row" id="thingsatbl" data-action="thingsatbl" data-eparams='thingsasearch()'>
     <?php
      handle_disp(array(), "thingsatbl");
    ?>
    </div>
    </div>
    <div class="tab-pane fade" id="thingse" >
    <div class="row mt5">
  <div class="col-sm-2">
    <div id="thingse_regform" data-action="thingse_regiform">
      <?php handle_disp(array(),"thingse_regiform"); ?>
    </div>
    <button class="btn" onclick='mohit.popup("addthingsepopup")'>Add Things Done</button> 
  </div>
  
  <div class="col-sm-2.5" style="float:right;" >
     <form method="post" id="thingsesearch" class="mb0">
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsetbl')[0]);" >
    <option value="0" selected disabled>Filter By</option>
      <option value="1">ID (Low to High)</option>
      <option value="2">ID (High to Low)</option>
      <option value="3">Category (A to Z)</option>
      <option value="4">Category (Z to A)</option>
      <option value="5">Responsibility (A to Z)</option>
      <option value="6">Responsibility (Z to A)</option>
      <option value="7">Date (Low to High)</option>
      <option value="8">Date (High to Low)</option>
    </select>
  </form>
  </div>
  </div>
    <div class="row" id="thingsetbl" data-action="thingsetbl" data-eparams='thingsesearch()'>  
    <?php
      handle_disp(array(), "thingsetbl");
    ?>
    </div>
    </div>
   </div>
 
</div>
