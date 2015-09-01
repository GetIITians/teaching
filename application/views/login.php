<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);
?>

	<main>
		<div class="container">
		<br>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="card-panel">
						<?php
							load_view('Template/form_errors.php',array("msg"=>$loginmsg));
						?>

						<div class="row no-margin-bottom">
							<div class="col-xs-12 col-sm-4 col-sm-offset-1">
								<h3 class="teal-text text-darken-1">Login</h3>
							</div>
							<div class="col-xs-12 col-sm-7">
								<div class="row grey-text">
									<div class="col-xs-12">
										<ul>
											<li>Login for Students and Tutors.</li>
											<li>Don't have an account?</li>
											<li><h6><i class="material-icons left tiny">chevron_right</i>
												Student: Sign Up <a href="<?php echo BASE."signup"; ?>">here</a>.</h6>
											</li>
											<li><h6><i class="material-icons left tiny">chevron_right</i>
												Tutor: Join Us <a href="<?php echo BASE."joinus"; ?>">here</a>.</h6>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="login_section">
							<div class="row no-margin-bottom">
								<form class="col-xs-12 col-sm-offset-1" method="post">
									<div class="row no-margin-bottom">
										<div class="input-field col-xs-12 col-sm-10">
											<input id="email" name="email" type="email" class="validate" required>
											<label for="email">Email</label>
										</div>
									</div>
									<div class="row no-margin-bottom">
										<div class="input-field col-xs-12 col-sm-10">
											<input id="password" name="password" type="password" class="validate" required>
											<label for="password">Password</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col-xs-12 col-sm-10">
											<button class="btn waves-effect waves-light" type="submit">Login
												<i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<h6>
									<a onclick="forgotPass();" style="cursor:pointer;">
										<span id="forgot_prefix_arrow"><i class="material-icons tiny">keyboard_arrow_up</i></span>&nbsp;Forgot Password
									</a>
								</h6>
							</div>
							<form style="display: none;" class="col-xs-12 col-sm-10 col-sm-offset-1" id="forgot_pass_section" onsubmit='form.req(this);return false;' data-action="forgotpass" data-res='success.push("Password reseting link is sent. check your mail.");' >
								<div class="row">
									<div class="col-xs-12">
										<h6 class="grey-text text-darken-1">Reset password for getIITians</h6>
										<p class="grey-text">Enter your email to send verification link.</p>
									</div>
								</div>
								<div class="row">
									<div class="input-field col-xs-12">
										<input id="email_forgot_pass" name="email" type="email" class="validate" required>
										<label for="email_forgot_pass">Email</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col-xs-12">
										<button class="btn waves-effect waves-light" type="submit"  >Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6" style='' >
					<div class="card-panel">
					<br>
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<h5 class="teal-text">Log in with other platforms</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<h6 class="grey-text"><i class="material-icons tiny left">chevron_right</i>Only Students can sign up from this section.</h6>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<a href="<?php echo HOST.'fb2.php'; ?>" class="btn-large waves-effect waves-light blue darken-3" style="width:100%;">
									<img src="images/facebook-login-icon.png" width="30" height="35" class="left" style="margin-top:9px;">&nbsp;&nbsp;&nbsp;Log In with facebook
								</a>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<a href="<?php echo HOST.'gplus.php'; ?>" class="btn-large waves-effect waves-light red darken-1" style="width:100%;">
									<img src="images/googleplus-login-icon.png" width="35" height="40" class="left" style="margin-top:9px;">Log In with google+
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php
load_view("Template/footer.php",$inp);
load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
	<script src="js/login.js"></script>
</body>
</html>
