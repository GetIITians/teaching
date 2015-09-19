<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);

$defopen="otpwindow";
$defopen="signupwindow";

?>
	<main>
		<div class="container">
		<br>
			<div class="row">
				<div class="col-xs-12 col-md-7">
					<div class="card-panel">
						<?php
							load_view('Template/form_errors.php',array("msg"=>$signupmsg));
						?>

						<div class="row no-margin-bottom">
							<div class="col-xs-12 col-md-4">
								<h4 class="teal-text text-darken-1 center">Sign Up</h4>
							</div>
							<div class="col-xs-12 col-md-8">
								<div class="row grey-text">
									<div class="col-xs-12">
										<ul>
											<li><h6><i class="material-icons tiny left">chevron_right</i>
												All fields are mandatory.
											</h6></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row center">
							<form class="col-xs-12 col-md-12" method="post" onsubmit='return ms.signupform(this,<?php echo tf($_ginfo["needsignupotp"]); ?>,true);' <?php if($_ginfo["needsignupotp"]) { ?>  data-action='signupotp' data-param='{"phone":$("#signupwindow").find("input[name=phone]").val(), type: "s","email":$("#signupwindow").find("input[name=email]").val()}' data-res='hideshowdown("signupwindow","otpwindow");'  <?php }else{ ?>  <?php } ?>  autocomplete="off" >
								<div id="signupwindow" style='<?php dit($defopen=="signupwindow"); ?>' >
									<div class="row no-margin-bottom">
										<div class="input-field col-xs-12 col-md-6">
											<input id="fullname" name="name" type="text"  data-condition='simple'     >
											<label for="fullname">Full Name</label>
										</div>
										<div class="input-field col-xs-12 col-md-6">
											<input id="email" name="email" type="email" data-condition='email' data-action="emailexist" data-params='{"email":$("#email").val()}' onblur="button.sendreq_v2(this)"   >
											<label for="email">Email</label>
										</div>
									</div>
									<div class="row no-margin-bottom">
										<div class="input-field col-xs-12 col-md-6">
											<input id="password" name="password" type="password"  data-condition="simple"     >
											<label for="password">Password</label>
										</div>
										<div class="input-field col-xs-12 col-md-6">
											<input id="confirm_password" name="cpassword" type="password" data-condition="password"    >
											<label for="confirm_password">Confirm Password</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col-xs-12">
											<input id="phone" name="phone" type="text" data-condition="phone"  >
											<label for="phone">Mobile Number</label>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 grey-text">
											By clicking on Submit, you agree to our <a target="_blank" href="<?php echo BASE.'termsofuse'; ?>">Terms of use</a>.
										</div>
									</div>
									<div class="row">
										<div class="input-field col-xs-12">
											<button class="btn waves-effect waves-light" name="signup" type="submit" id="submit_button">
												Submit<i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</div>
								<div id="otpwindow" style='<?php dit($defopen=="otpwindow"); ?>' >

									<div class="col-xs-12">
										An OTP has been sent to your phone. Please enter it below.
									</div>
									<div class="row">
										<div class="input-field col-xs-12">
											<input id="otp" name="otp" type="text" data-condition="simple" class="validate" >
											<label for="otp">One Time Password (Phone)</label>
										</div>
									</div>
									<div class="col-xs-12" >
										An OTP has been sent to your Email. Please enter it below.
									</div>
									<div class="row">
										<div class="input-field col-xs-12" >
											<input id="otp" name="otp_mail" type="text" data-condition="simple" class="validate" >
											<label for="otp">One Time Password (Email)</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col-xs-12">
											<button class="btn waves-effect waves-light"  name="signup" type="submit" >Submit
												<i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-5" style="">
					<div class="card-panel">
						<div class="row no-margin-bottom">
							<div class="col-xs-12">
								<h5 class="teal-text">Sign up with other platforms</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<a href="<?php echo HOST.'fb2.php'; ?>" class="btn-large waves-effect waves-light blue darken-3" style="width:100%;">
									<img src="images/facebook-login-icon.png" width="30" height="35" class="left" style="margin-top:9px;">&nbsp;&nbsp;&nbsp;Sign Up with facebook
								</a>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-12">
								<a href="<?php echo HOST.'gplus.php'; ?>" class="btn-large waves-effect waves-light red darken-1" style="width:100%;">
									<img src="images/googleplus-login-icon.png" width="35" height="40" class="left" style="margin-top:9px;">Sign Up with google+
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<br><br>
		</div>
	</main>

<?php
load_view("Template/footer.php",$inp);
load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>

<!-- 
	<script src="js/signup.js"></script>
-->
</body>
</html>
