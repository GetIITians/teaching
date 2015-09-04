<?php
load_view("Template/top.php",$inp);
load_view("Template/navbarnew.php",$inp);
?>
	<main class="profile">
		<div class="container">
		<br>
			<?php /*
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
			*/ ?>
			<div class="container">
				<div id="profiletabs" class="row" role="tablist">
					<a role="presentation" class="col-sm-2 col-xs-6" href="#profile" aria-controls="Profile" role="tab" data-toggle="tab">
						Profile
					</a>
					<a  role="presentation" class="active col-sm-2 col-xs-6" href="#users" aria-controls="Users" role="tab" data-toggle="tab">
						Users
					</a>
					<a  role="presentation" class="col-sm-2 col-xs-6" href="#account" aria-controls="Account" role="tab" data-toggle="tab">
						Account
					</a>
					<a role="presentation" class="col-sm-2 col-xs-6" href="#reviews" aria-controls="Reviews" role="tab" data-toggle="tab">
						Reviews
					</a>
					<a role="presentation" class="col-sm-4 col-xs-12" href="#homepage" aria-controls="Homepage" role="tab" data-toggle="tab">
						Homepage Reviews
					</a>
				</div>
				<div class="tab-content row">
					<div id="profile" class="tab-pane col-xs-12" role="tabpanel">
					<?php
						load_view("Template/adminprofile_about.php", $inp);
					?>
					</div>
					<div id="users" class="tab-pane active col-xs-12" data-action='adminprofile_users' role="tabpanel">
					<?php
						handle_disp(array(), "adminprofile_users");
					?>
					</div>
					<div id="account" class="tab-pane col-xs-12" data-action='moneyaccount' role="tabpanel">
					<?php
						handle_disp(array(), "moneyaccount");
						//load_view("Template/moneyaccount.php", $inp);
					?>
					</div>
					<div id="reviews" class="tab-pane col-xs-12" data-action='adminprofile_reviews' role="tabpanel">
					<?php
						handle_disp(array(), "adminprofile_reviews");
					?>
					</div>
					<div id="homepage" class="tab-pane col-xs-12" data-action='adminprofile_homepage_reviews' role="tabpanel">
					<?php
						handle_disp(array(), "adminprofile_homepage_reviews");
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