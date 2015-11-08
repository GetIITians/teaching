<?php 
load_view("popup.php",array("name"=>"addteacherpopup", "title" => "Add A Teacher","body" =>"Caller/addteacher.php","bodyinfo" => array() )); 
load_view("popup.php",array("name"=>"editcollerpopup", "title" => "Edit Details" )); 
?>
<div id="caller_regform" data-action="caller_regiform">
  <?php handle_disp(array(),"caller_regiform"); ?>
</div>
<div class="container-fluid" id="main_container">
  <div class="row">
  <div class="col-sm-2" style="margin-top:10px">
  <button class="btn" onclick='mohit.popup("addcollerpopup")'>Add New Entry</button> 
  </div>
  <form method="post" id="callersearch" >
  <div class="col-sm-2.5" style="margin-top:10px;float:right" >
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
  <div class="col-sm-4 mt10" style="float:right;">
    <div class="row">
      <div class="col-sm-5" style="float:right"> 
      <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo" >View By Demo</button>
      </div>
    </div>
  <div class="row mt10"  style="position: absolute;background:white">
    <div id="demo" class="col-sm-12 collapse">
          <div class="row">
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_all" name="demo0" onchange="yogy.caller_search()" />
              <label for="demo_all">All</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_open" name="demo1" onchange="yogy.caller_search()" />
              <label for="demo_open">Open</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_assigned" name="demo2" onchange="yogy.caller_search()" />
              <label for="demo_assigned">Assigned</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_scheduled" name="demo3" onchange="yogy.caller_search()" />
              <label for="demo_scheduled">Scheduled</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_done" name="demo4" onchange="yogy.caller_search()" />
              <label for="demo_done">Done</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_accepted" name="demo5" onchange="yogy.caller_search()" />
              <label for="demo_accepted">Accepted</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_rejected" name="demo6" onchange="yogy.caller_search()" />
              <label for="demo_rejected">Rejected</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_closed" name="demo7" onchange="yogy.caller_search()" />
              <label for="demo_closed">Close</label>
            </div>
            <div class="col-sm-4">
              <input type="checkbox" class="filled-in" id="demo_student" name="demo8" onchange="yogy.caller_search()" />
              <label for="demo_student">Student</label>
            </div>
          </div>
      </div>
  </div>
  
  </div>
  </form>
  </div>
  <div class="row" style="margin-top:10px" id="callertlb" data-action="callertbl" data-eparams='callersearch()'>
  	<?php
   		handle_disp(array(), "callertbl");
   	?>
  </div>
</div>
