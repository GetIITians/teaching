<?php
//require_once('FirePHPCore/fb.php');
//ob_start();
load_view("Template/top.php");
load_view("Template/navbarnew.php");
?>
<script>
	var topics=<?php echo json_encode($cst_tree); ?>;
</script>
	<a id="top"></a>
	<a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>#top" class="btn-large btn-floating waves-effect waves-light  blue-grey darken-4" id="top_arrow" title="TOP" style="display:none;">
		<i class="material-icons" style="font-size:3rem;">keyboard_arrow_up</i>
	</a>
<div id="landingPageTab">
	<div class="closeIcon">
		<i class="material-icons">clear</i>
	</div>
	
	<div class="content right">
		<span>Step 1&nbsp;:&nbsp;Select a teacher</span>
	</div>
</div>

<main class="whitebg">
	<div class="container">
		<div id="wrapper" class="row searchwrapper">
			<!-- Begin Filter Panel -->
			<div id="sideBar" class="col-md-3">
				<div class="" id="sticker_panel"> <!-- Don't add a class -->
					<h3 class="blue-grey-text text-darken-1">Filter<i class="material-icons right">filter_list</i></h5>
						<form method="post" id="searchform">
							<?php
							hidinp("search",htmlspecialchars($search));
							?>
							<div class="form-group">
									<select name="class" class="browser-default form-control" onchange='topicssubtopic_t2(this);' id="selectclass" data-condition="simple">
										<?php
											disp_olist($class_olist,array('selectalltext'=>"Select Class"));
										?>
									</select>
							</div>
							<div class="form-group">
									<select name='subject'  class="browser-default form-control" id='selectsubject' onchange='topicssubtopic_t2(this);' data-condition='simple'>
										<option value="" disabled selected>Subject</option>
										<option value="">Select class first</option>
									</select>
							</div>
									<ul class="collapsible" data-collapsible="accordion">
										<li>
											<div class="collapsible-header">Topics</div>
											<div class="collapsible-body" id="selecttopic" style="padding:10px;">
												<div style="padding:5px;">Select Class and Subject first.</div>
												<input type='checkbox' style='display:none' name='topic' value=''/>
											</div>
										</li>
										<?php
											if(true) {
										?>
										<li>
											<div class="collapsible-header">Time</div>
											<div class="collapsible-body" style="padding:6px;">
												<div class="row">
												<?php
													foreach($allts as $i=>$val) {
														foreach($val as $j=>$val1) {
												?>
													<div class="col-xs-6">
														<input id="timesearch<?php echo $i."-".$j; ?>" type="checkbox" name="timeslot" class="filled-in" value="<?php echo $val1[1]; ?>" checked/>
														<label style="padding-left:23px;" for="timesearch<?php echo $i."-".$j; ?>"><?php echo $val1[0]; ?></label>
													</div>
												<?php
														}
													}
												?>
												</div>
											</div>
										</li>
										<li>
											<div class="collapsible-header">Languages</div>
											<div class="collapsible-body" style="padding:6px;">
												<div class="row">
												<?php
													$count=1;
													foreach($lang as $i=>$val1) {
														foreach($val1 as $j=>$val2) {
												?>
													<div class="col-xs-6">
														<input id="lang<?php echo $count; ?>" type="checkbox" class="filled-in" name="lang" value='<?php echo $count; ?>' checked />
														<label style="padding-left:23px;" for="lang<?php echo $count; ?>" >
															<?php echo $val2; ?>
														</label>
													</div>
												<?php
															$count++;
														}
													}
												?>
												</div>
											</div>
										</li>
										<li>
											<div class="collapsible-header">Fees per hour</div>
											<div class="collapsible-body" style="padding:10px;">
												<?php
													$count=1;
													foreach($price as $val) {
														foreach($val as $val1) {
															load_view("Template/check1.php",array('label'=>htmlspecialchars($val1[0]), 'value'=>$count,"id"=>"price".$count, "name"=>"price"));
															$count++;
														}
													}
												?>
											</div>
										</li>
										<li>
											<div class="collapsible-header" style="display:none">Duration</div>
											<div class="collapsible-body" style="padding:10px;">
												<?php
													$count=1;
													foreach($timer as $val) {
														foreach($val as $val1) {
															load_view("Template/check1.php",array('label'=>htmlspecialchars($val1[0]), 'value'=>$count,"id"=>"timer".$count, "name"=>"timer"));
															$count++;
														}
													}
												?>
											</div>
										</li>
										<?php
											}
										?>
									</ul>
									<ul class="collapsible uncollapsed" >
										 <li>
											<div style="padding:6px;">
												<div class="row">
													<div class="col-xs-12">
														<input id="home1" type="checkbox" class="filled-in" name="home" value='1' />
														<label style="padding-left:23px;" for="home1" >
															Home Tuition
														</label>
													</div>												
												</div>
											</div>
										</li>
										<li id="homeTutionPinCode" style="display:none;">
											<div>Pin Code</div>
											<div style="padding:6px;">
												<div class="row">
												
													<div class="col-xs-12">
														<input placeholder="Leave empty if search all" type="text" class="validate" name="pincode" data-condition="simple"   />
													</div>
												
												</div>
											</div>
										</li>
									 </ul>
							<button type="button" class="btn waves-effect waves-light" data-action="refinesearch" onclick="ms.orderrefine(this);">
								Refine Search
							</button>
						</form>
				</div>
			</div>
			<!-- End Filter Panel -->
			
			<!-- Begin Search Panel -->
			<div id="mainContent" class="col-md-9">
					<div class="row">
						<div class="col-sm-5 col-xs-7">
							<h3 class="blue-grey-text text-darken-1">Search Results</h3>
							</div>
				<div class="col-xs-3 col-xs-1">
				 <img src="photo/icons/loading2.gif" id="searchloadingimg" style="visibility:hidden;" class="right"/>
				</div>
				<form method="post" class="col-sm-4 col-xs-4 mt20">
									<select name="orderby" class="browser-default" data-action="orderby" onchange="ms.orderrefine(this)" >
										<option value="" >Sort By</option>
										<option value="1">Experience</option>
										<option value="2">Fees/hr (High to Low)</option>
										<option value="3">Fees/hr (Low to High)</option>
										<option value="4">Rating</option>
										
									</select>
				</form>
					</div>
		<div class="divider"></div>
						<div class="row" id="dispnoresult" style='display:none;' >
							<div class="col-xs-12 red-text text-lighten-1">
								Sorry. No results found.
							</div>
						</div>
							<div class="row">
								<div id="searchresultdiv" data-action='search' data-max='<?php echo $_ginfo["numsearchr"]["loadonce"]; ?>' data-maxl='<?php echo $_ginfo["numsearchr"]["loadadd"]; ?>' data-eparams='searchform()' data-ignoreloadonce='<?php echo $_ginfo["numsearchr"]["loadonce"]; ?>'>
								<?php
									handle_disp(array('class'=>$class, 'subject'=>$subject, 'topic'=>$topic, 'price'=>'', 'timer'=>'', 'lang'=>'', 'timeslot'=>'', 'orderby'=>'', 'search'=>$search, 'max'=>0, 'maxl'=>$_ginfo["numsearchr"]["loadonce"],'home'=>'1-2','pincode'=>''), "search");
								?>
							</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<img src='photo/icons/loading2.gif' id="loadmoreloadingimg" style='visibility:hidden;' /><br>
									<a onclick='ms.searchloadmore(this);' style="cursor:pointer;" id="loadmorebutton" >View More</a>
								</div>
							</div>
			</div>
			<!-- End Search Panel -->
		
		</div>
	</div>
</main>

<?php
load_view("Template/footer.php",$inp);
load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
	<script src="js/search.js"></script>
</body>
</html>
