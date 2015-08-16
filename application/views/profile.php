<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");

if(true || $aboutinfo["isselected"] == "a" || User::isloginas("a") ) {

?> 
<?php if(isset($_SESSION['referrer'])&&$_SESSION['referrer']) : ?>
<div id="landingPageTab">
  <div class="closeIcon">
    <i class="material-icons">clear</i>
  </div>
  
  <div class="content right">
    <span>Step 2&nbsp;:&nbsp;Select a topic for the free class</span>
  </div>
</div>
<?php endif; ?>

	<main class="profile">
		<div class="container">
			<ul id="profiletabs" class="row" role="tablist">
				<li role="presentation" <?php echo profile_tabs(1,$tabid,'tablist'); ?>>
					<a  id="profiletabs1" href="#profile" aria-controls="home" role="tab" data-toggle="tab">
						Profile
					</a>
				</li>
				<li role="presentation" <?php echo profile_tabs(5,$tabid,'tablist'); ?>>
					<a  id="profiletabs5" href="#topics" aria-controls="topics" role="tab" data-toggle="tab">
						Topics
					</a>
				</li>
				<li role="presentation" <?php echo profile_tabs(2,$tabid,'tablist'); ?>>
					<a id="profiletabs2" href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab">
						Calendar
					</a>
				</li>
				<li role="presentation" <?php echo profile_tabs(4,$tabid,'tablist'); ?>>
					<a id="profiletabs4" href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">
						Reviews
					</a>
				</li>
				<li role="presentation" <?php echo profile_tabs(3,$tabid,'tablist'); ?> style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>">
					<a id="profiletabs3" href="#classes" aria-controls="classes" role="tab" data-toggle="tab">
						Classes
					</a>
				</li>
				<li role="presentation" <?php echo profile_tabs(6,$tabid,'tablist'); ?> style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>">
					<a id="profiletabs6" href="#account" aria-controls="account" role="tab" data-toggle="tab">
						Account
					</a>
				</li>
			</ul>
			<div class="tab-content row">
				<div id="profile" <?php echo profile_tabs(1,$tabid,'tabpanel'); ?> role="tabpanel">
				<?php 
					load_view("Template/profile_about.php", $inp);
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
					load_view("Template/profile_topics.php",Fun::mergeifunset($topicinfo,array("tid"=>$tid,'minfees'=>$jsonArray['minfees'])));
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
load_view("Template/footernew.php");
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
	<script src="js/profile.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>