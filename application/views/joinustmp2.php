<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");

//$issubmitted = false;
?>
<?php if (!$issubmitted) { ?>
<main>
	<div class="container">
	<br>
		<div class="row">
			<div class="col-xs-12">
				<div class="card-panel">
					<div class="row">
						<div class="col-xs-12 col-md-3 col-md-offset-1">
							<h3 class="teal-text text-darken-1 center">Join Us</h3>
						</div>
						<div class="col-xs-12 col-md-8">
							<div class="row grey-text">
								<div class="col-xs-12">
									<ul>
										<li><i class="material-icons left tiny">keyboard_arrow_right</i>
											This form is meant only for tutors.
										</li>
										<li><i class="material-icons left tiny">chevron_right</i>
											Star (<span class="red-text">*</span>) marked fields are mandatory.
										</li>
										<li><i class="material-icons left tiny">chevron_right</i>
											An OTP will be sent to your Mobile Phone after you submit the form.
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row" >
						<form class="col-xs-12 col-md-10 col-md-offset-1" enctype="multipart/form-data"  method="post" <?php if($_ginfo["needotp"]){?> data-action='signupotp' data-param='{"phone":$("#main_form_section").find("input[name=phone]").val(), "type":"t","email":$("#main_form_section").find("input[name=email]").val()}' <?php } else {?> <?php } ?> onsubmit="return ms.joinusform(this, <?php echo tf($_ginfo["needotp"]); ?>);" data-res="openOtpSection();"  >
							<?php
								load_view("Template/joinus_otp.php");
								load_view("Template/joinus_main.php");
							?>
						</form>
					</div>
			</div>
		</div>
	</div>
</div><br><br>
</main>
<?php
}
else{
?>

<main>
	<div class="container">
	<br>
		<div class="row">
			<div class="col-xs-12">
				<div class="card-panel"  >

					<div class="row">
						<div class="col-xs-12 l8">
							<div class="row grey-text">
								<div class="col-xs-12">
									<?php
										echo $msg;
									?>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div><br><br>
</main>


<?php
}
load_view("Template/footer.php");
load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
	<script src="js/joinus.js"></script>
</body>
</html>
