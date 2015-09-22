<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");

if(true || $aboutinfo["isselected"] == "a" || User::isloginas("a") ) {

?>
<script type="text/javascript">
	var user = <?php echo ($tid == User::loginId()) ? User::loginId() : '' ; ?>;
</script>
<div id="landingPageTab">
  <div class="closeIcon">
    <i class="material-icons">clear</i>
  </div>
  <div class="content right">
    <span>Step 2&nbsp;:&nbsp;Select a topic for the free class</span>
  </div>
</div>
	<main class="profile">
		<div class="container">
			<div id="profiletabs" class="row" role="tablist">
				<a <?php echo profile_tabs(1,$tabid,'tablist'); ?> role="presentation" id="profiletabs1" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
					Profile
				</a>
				<a <?php echo profile_tabs(5,$tabid,'tablist'); ?> role="presentation" id="profiletabs5" href="#topics" aria-controls="topics" role="tab" data-toggle="tab">
					Topics
				</a>
				<a <?php echo profile_tabs(2,$tabid,'tablist'); ?> role="presentation" id="profiletabs2" href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab">
					Calendar
				</a>
				<a <?php echo profile_tabs(4,$tabid,'tablist'); ?> role="presentation" id="profiletabs4" href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">
					Reviews
				</a>
				<a style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>" <?php echo profile_tabs(3,$tabid,'tablist'); ?> role="presentation" id="profiletabs3" href="#classes" aria-controls="classes" role="tab" data-toggle="tab">
					Classes
				</a>
				<a style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>" <?php echo profile_tabs(6,$tabid,'tablist'); ?> role="presentation" id="profiletabs6" href="#account" aria-controls="account" role="tab" data-toggle="tab">
					Account
				</a>
			</div>
			<div class="tab-content row">

				<div id="profile" <?php echo profile_tabs(1,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php  
					load_view("Template/profile_about.php", $inp);
					fb($inp,'$inp',FirePHP::LOG);
				?>
				</div>
				<div id="calendar" <?php echo profile_tabs(2,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php
					load_view("Template/profile_calendar.php",Fun::mergeifunset($calinfo,array("tid"=>$tid)) );
				?>
				</div>
				<div id="classes" <?php echo profile_tabs(3,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php
					load_view("Template/profile_classes.php", $myclasses);
				?>
				</div>
				<div id="reviews" <?php echo profile_tabs(4,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php
					
					load_view("Template/profile_reviews.php", Fun::mergeifunset($inp, array("reviewname" => "studentname")));
				?>
				</div>
				<div id="topics" <?php echo profile_tabs(5,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php 
				if(User::isloginas('s')){
					load_view("Template/profile_topics.php",Fun::mergeifunset($topicinfo,Fun::mergeifunset(array("tid"=>$tid,'minfees'=>$jsonArray['minfees'],"resignupmsg"=>$resignupmsg),$st_detail)));
				} else {
					load_view("Template/profile_topics.php",Fun::mergeifunset($topicinfo,array("tid"=>$tid,'minfees'=>$jsonArray['minfees'],"resignupmsg"=>$resignupmsg)));
				}
				?>
				</div>
				<div id="account" <?php echo profile_tabs(6,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php
					load_view("Template/moneyaccount.php", Fun::mergeifunset($inp, array("tid"=>$tid)));
				?>
				</div>
			</div>
		</div>
	</main>
<?php
} else {
	if($tid == User::loginId())
		echo "You Are not selected.";
}
?>

<?php
load_view("Template/footer.php",$inp);
//load_view("Template/footernew.php");
load_view("popup.php",array("name"=>"timeslot", "title" => "Please select your free slots"));
load_view("Template/bottom.php",array("needbody"=>false));
?>
	<script>
		var selectedtopic = "";
		function displaytext() {
			document.getElementById("displayte").style.visibility = "hidden";
		}
		function displaytext_t2() {
			document.getElementById("getText").style.visibility = "visible";
			document.getElementById("getText1").style.visibility = "visible";
		}
	</script>
	<script src="js/editProfile.js"></script>
	<script src="js/profile.js"></script>
	<script src="js/joinus.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>