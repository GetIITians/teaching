<?php 
load_view("popup.php",array("name"=>"editthingsahimanshupopup", "title" => "Edit Details" )); 
?>
<div class="container" id="main_container">
  <ul class="row nav nav-tabs mt10">
    <li class="active"><a data-toggle="tab" href="#thingsahimanshu">Things To do</a></li>
    <li><a data-toggle="tab" href="#thingsehimanshu">Things Done</a></li>
  </ul>
  <div class="row tab-content" style="">
  	<div class="tab-pane fade in active" id="thingsahimanshu" >
  <div class="row mt5">
  <div class="col-sm-2">
    <div id="thingsahimanshu_regform" data-action="thingsahimanshu_regiform">
      <?php handle_disp(array(),"thingsahimanshu_regiform"); ?>
    </div>
    <button class="btn" onclick='mohit.popup("addthingsahimanshupopup")'>Add Things To do</button> 
  </div>
     <form method="post" id="thingsahimanshusearch" class="mb0">
  <div class="col-sm-2.5" style="float:right;" >
    <label>Filter by</label>
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsahimanshutbl')[0]);" >
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
    <select  class="browser-default" name="viewbyres" onchange="div.reload($('#thingsahimanshutbl')[0]);" >
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
     <div class="row" id="thingsahimanshutbl" data-action="thingsahimanshutbl" data-eparams='thingsahimanshusearch()'>
     <?php
      handle_disp(array("orderby"=>0,"viewbyres"=>""), "thingsahimanshutbl");
    ?>
    </div>
    </div>
    <div class="tab-pane fade" id="thingsehimanshu" >
    <div class="row mt5">
  <div class="col-sm-2">
    <div id="thingsehimanshu_regform" data-action="thingsehimanshu_regiform">
      <?php handle_disp(array(),"thingsehimanshu_regiform"); ?>
    </div>
    <button class="btn" onclick='mohit.popup("addthingsehimanshupopup")'>Add Things Done</button> 
  </div>
  
     <form method="post" id="thingsehimanshusearch" class="mb0">
  <div class="col-sm-2.5" style="float:right;" >
   <label>Filter by</label>
    <select  class="browser-default" name="orderby" onchange="div.reload($('#thingsehimanshutbl')[0]);" >
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
    <select  class="browser-default" name="viewbyres" onchange="div.reload($('#thingsehimanshutbl')[0]);" >
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
    <div class="row" id="thingsehimanshutbl" data-action="thingsehimanshutbl" data-eparams='thingsehimanshusearch()'>  
    <?php
      handle_disp(array("orderby"=>0,"viewbyres"=>""), "thingsehimanshutbl");
    ?>
    </div>
    </div>
   </div>
 
</div>
