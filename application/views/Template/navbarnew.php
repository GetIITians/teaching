<body style="padding-top:45px;">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo BASE; ?>">getIITians</a>
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

<?php /* ?>
<body>
	Dropdown for Create Account
	<ul id="dropdownaccount" class="dropdown-content">
		<li class="<?php  pit('active', $page==='signup');?>"><a href="<?php echo BASE."signup" ;?>">Signup<span style="font-size:13px;" class="grey-text right">STUDENT</span></a></li>
		<li class="<?php pit('active', $page==='joinus');?>"><a href="<?php echo BASE."joinus" ;?>">Joinus<span style="font-size:13px;" class="grey-text right">TUTOR</span></a></li>
	</ul>

	<!-- NavBar -->
	<div class="navbar-fixed">
		<nav class="teal darken-3" role="navigation">
			<div class="nav-wrapper">
				<a href="<?php echo BASE; ?>" class="brand-logo">getIITians</a>
				<a data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li class="<?php pit('active', $page==='aboutus');?>"><a href="<?php echo BASE."aboutus"; ?>">About Us</a></li>
					<li class="<?php pit('active', $page==='contactus');?>"><a href="<?php echo BASE."contactus"; ?>">Contact Us</a></li>

					<?php
					if (User::islogin()) {
					?>
					<li class="<?php pit('active', $page==='profile');?>"><a href="<?php echo BASE."profile" ;?>">Profile</a></li>
					<li><a href="<?php echo BASE."?logout"; ?>">Logout</a></li>
					<?php
					}
					else {
					?>
					<li class="<?php pit('active', $page==='login');?>"><a href="<?php echo BASE."login"; ?>">Login</a></li>
					<li>
						<a class="dropdown-button" href="" data-beloworigin="true" data-activates="dropdownaccount">
							Create Account <i class="material-icons right">arrow_drop_down</i>
						</a>
					</li>
					<?php
					}
					?>

					<form class="right" action="<?php echo BASE."search"; ?>" >
						<div class="input-field teal darken-4">
							<input id="search" type="search" placeholder="Search Tutors" autocomplete="off" name="q" >
							<label for="search"><i class="material-icons">search</i></label>
							<button type="submit" style="display:none;" ></button>
						</div>
					</form>
				</ul>
			</div>
		</nav>
	</div>

	<!-- SideNav -->
	<ul class="side-nav" id="mobile-demo">
		<li class="<?php pit('active', $page==='aboutus');?>"><a href="<?php echo BASE."aboutus"; ?>">About Us</a></li>
		<li class="<?php pit('active', $page==='contactus');?>"><a href="<?php echo BASE."contactus"; ?>">Contact Us</a></li>

		<?php
		if (User::islogin()) {
		?>
		<li class="<?php pit('active', $page==='profile');?>"><a href="<?php echo BASE."profile" ;?>">Profile</a></li>
		<li><a href="<?php echo BASE."?logout"; ?>">Logout</a></li>
		<?php
		}
		else {
		?>
		<li class="<?php pit('active', $page==='login');?>"><a href="<?php echo BASE."login"; ?>">Login</a></li>
		<li class="<?php pit('active', $page==='signup');?>">
			<a href="<?php echo BASE."signup" ;?>">Signup&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="font-size:13px;" class="grey-text">for Students</span></a>
		</li>
		<li class="<?php pit('active', $page==='joinus');?>">
			<a href="<?php echo BASE."joinus" ;?>">Joinus&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="font-size:13px;" class="grey-text">for Tutors</span></a>
		</li>
		<?php
		} 
		?>

		<div class="row grey lighten-3">
			<form class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input id="sidenav_search" type="text" name="q" autocomplete="off">
						<label for="sidenav_search">Search Tutors</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<button type="submit" class="btn waves-effect waves-light">Search
							<i class="material-icons right">search</i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</ul>
<?php */ ?>