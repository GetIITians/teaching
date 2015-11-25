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
  <?php if(User::isloginas('a') || (User::loginId()==76)): ?>
  <div class="col-sm-2">
    <div id="thingsa_regform" data-action="thingsa_regiform">
      <?php handle_disp(array(),"thingsa_regiform"); ?>
    </div>
    <button class="btn" onclick='mohit.popup("addthingsapopup")'>Add Things To do</button> 
  </div>
    <?php endif; ?>
  
     <form method="post" id="thingsasearch" class="mb0">
  <div class="col-sm-2.5" style="float:right;" >
    <label>Filter by</label>
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsatbl')[0]);" >
    <option value="0" selected disabled>Select</option>
      <option value="1">ID (Low to High)</option>
      <option value="2">ID (High to Low)</option>
      <option value="3">Category (A to Z)</option>
      <option value="4">Category (Z to A)</option>
      <option value="5">Responsibility (A to Z)</option>
      <option value="6">Responsibility (Z to A)</option>
      <option value="7">Due Date (Low to High)</option>
      <option value="8">Due Date (High to Low)</option>
    </select>
  </div>
  <div class="col-sm-2.5" style="float:right;" >
    <label>Responsibility</label>
    <select  class="browser-default" name="viewbyres" onchange="div.reload($('#thingsatbl')[0]);" >
    <option value="" selected disabled>Select</option>
      <option value="">All</option>
      <option value="Himanshu Jain">Himanshu Jain</option>
      <option value="Ashish Anand">Ashish Anand</option>
      <option value="Narayan">Narayan</option>
      <option value="Yogesh Saini">Yogesh Saini</option>
      <option value="Yogendra">Yogendra</option>
      <option value="Anupriya Jain">Anupriya Jain</option>
    </select>
  </div>
  </form>
  </div>
     <div class="row" id="thingsatbl" data-action="thingsatbl" data-eparams='thingsasearch()'>
     <?php
      handle_disp(array("orderby"=>0,"viewbyres"=>""), "thingsatbl");
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
  
     <form method="post" id="thingsesearch" class="mb0">
  <div class="col-sm-2.5" style="float:right;" >
   <label>Filter by</label>
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsetbl')[0]);" >
    <option value="0" selected disabled>Select</option>
      <option value="1">ID (Low to High)</option>
      <option value="2">ID (High to Low)</option>
      <option value="3">Category (A to Z)</option>
      <option value="4">Category (Z to A)</option>
      <option value="5">Responsibility (A to Z)</option>
      <option value="6">Responsibility (Z to A)</option>
      <option value="7">Date (Low to High)</option>
      <option value="8">Date (High to Low)</option>
    </select>
  </div>
  <div class="col-sm-2.5" style="float:right;" >
    <label>Responsibility</label>
    <select  class="browser-default" name="viewbyres" onchange="div.reload($('#thingsetbl')[0]);" >
    <option value="" selected disabled>Select</option>
      <option value="">All</option>
      <option value="Himanshu Jain">Himanshu Jain</option>
      <option value="Ashish Anand">Ashish Anand</option>
      <option value="Narayan">Narayan</option>
      <option value="Yogesh Saini">Yogesh Saini</option>
      <option value="Yogendra">Yogendra</option>
      <option value="Anupriya Jain">Anupriya Jain</option>
    </select>
  </div>
  </form>
  </div>
    <div class="row" id="thingsetbl" data-action="thingsetbl" data-eparams='thingsesearch()'>  
    <?php
      handle_disp(array("orderby"=>0,"viewbyres"=>""), "thingsetbl");
    ?>
    </div>
    </div>
   </div>
 
</div>
