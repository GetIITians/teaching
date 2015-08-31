<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);
?>
	<main>
		<div class="container">
		<br>
			<div class="card-panel">
			<br>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-sm-offset-1 center">
						<img class="materialboxed" height="100" width="100" src="<?php  echo $ainfo["profilepic"]; ?>">
						<br>
						<!-- Change Profile Picture -->
					 <form method="post" enctype="multipart/form-data"> 
						<a onclick='uploadfile(this,"profilepic");' style="cursor:pointer;" >Change Profile Picture</a>
					 </form>

					</div>
					<div class="col-xs-12 col-sm-7">
						<div class="row">
							<div class="col-xs-12">
								<h5 class="green-text left"><?php echo convchars($ainfo["name"]); ?></h5>
							</div>
							<div class="col-xs-12">
								<h6 class="grey-text left"><?php echo $ainfo["email"]; ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-panel">
				<div class="row">
					<div class="col-xs-12">
						<ul class="tabs">
							<li class="tab col-xs-3"><a class="active" href="#tab_profile">Profile</a></li>
							<li class="tab col-xs-3"><a class="active" href="#tab_users">Users</a></li>
							<li class="tab col-xs-3"><a href="#tab_account">Account</a></li>
						</ul>
					</div>
					<div id="tab_profile" class="col-xs-12 col-sm-offset-2">
					<?php
						load_view("Template/adminprofile_about.php", $inp);
					?>
					</div>
					<div id="tab_users" class="col-xs-12" data-action='adminprofile_users'  >
					<?php
							handle_disp(array(), "adminprofile_users");
					?>
					</div>
					<div id="tab_account" class="col-xs-12" data-action='moneyaccount' >
					<?php
						handle_disp(array(), "moneyaccount");
//            load_view("Template/moneyaccount.php", $inp);
					?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php
load_view("Template/footer.php",$inp);

load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
</body>
</html>