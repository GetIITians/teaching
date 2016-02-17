<body style="padding-top:45px;">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://getiitians.com">
				<img src="images/logo_horizontal.png" class="img-responsive">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar">
			<form class="navbar-form navbar-right" action="<?php echo BASE."search"; ?>" role="search" >
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="material-icons" >search</i></div>
						<input id="search" type="search" placeholder="Search Tutors" autocomplete="off" name="q" class="form-control">
					</div>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
			<!--	<li><a href="<?php // echo BASE."blog"; ?>">Blog</a></li> -->
				<li><a href="<?php echo BASE."aboutus"; ?>">About Us</a></li>
				<li><a href="<?php echo BASE."contactus"; ?>">Contact Us</a></li>
				<?php if (User::islogin()) : ?>
					<li><a href="<?php echo BASE."profile"; ?>">Profile</a></li>
					<li><a href="<?php echo BASE."?logout"; ?>">Logout</a></li>
				<?php else : ?>
					<li><a href="<?php echo BASE."login"; ?>">Login</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Create Account <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="<?php pit('active', $page==='signup');?>"><a href="<?php echo BASE."signup" ;?>">Signup<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STUDENT</span></a></li>
							<li class="<?php pit('active', $page==='joinus');?>"><a href="<?php echo BASE."joinus" ;?>">Joinus<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TUTOR</span></a></li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>