<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");

if(true || $aboutinfo["isselected"] == "a" || User::isloginas("a") ) { 

?> 
	<main class="profile">
		<div class="container">
			<ul class="row" role="tablist">
				<li role="presentation" class="active col-md-2 col-xs-4">
					<a href="#profile" aria-controls="home" role="tab" data-toggle="tab">
						Profile
					</a>
				</li>
				<li role="presentation" class="col-md-2 col-xs-4">
					<a href="#topics" aria-controls="topics" role="tab" data-toggle="tab">
						Topics
					</a>
				</li>
				<li role="presentation" class="col-md-2 col-xs-4">
					<a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab">
						Calendar
					</a>
				</li>
				<li role="presentation" class="col-md-2 col-xs-4">
					<a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">
						Reviews
					</a>
				</li>
				<li role="presentation" class="col-md-2 col-xs-4" style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>">
					<a href="#classes" aria-controls="classes" role="tab" data-toggle="tab">
						Classes
					</a>
				</li>
				<li role="presentation" class="col-md-2 col-xs-4" style="<?php pit("visibility:hidden", $tid != User::loginId()); ?>">
					<a href="#account" aria-controls="account" role="tab" data-toggle="tab">
						Account
					</a>
				</li>
			</ul>
			<div class="tab-content row">
				<div id="profile" class="tab-pane active col-md-12" role="tabpanel">
				<?php 
					load_view("Template/profile_about.php", $inp);
				?>
				</div>
				<div id="calendar" class="tab-pane col-md-12" role="tabpanel">
				<?php
					load_view("Template/profile_calendar.php",Fun::mergeifunset($calinfo,array("tid"=>$tid)) );
				?>
				</div>
				<div id="classes" class="tab-pane col-md-12" role="tabpanel">
				<?php
					load_view("Template/profile_classes.php", $myclasses);
				?>
				</div>
				<div id="reviews" class="tab-pane col-md-12" role="tabpanel">
				<?php
					load_view("Template/profile_reviews.php", Fun::mergeifunset($inp, array("reviewname" => "studentname")));
				?>
				</div>
				<div id="topics" class="tab-pane col-md-12" role="tabpanel">
				<?php
					load_view("Template/profile_topics.php",Fun::mergeifunset($topicinfo,array("tid"=>$tid,'minfees'=>$jsonArray['minfees'])));
				?>
				</div>
				<div id="account" class="tab-pane col-md-12" role="tabpanel">
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