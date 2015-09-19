<?php load_view("Template/top.php",$inp); ?>
<link rel="stylesheet" href="css/custom-homestyle-v2.css">
<link rel="stylesheet" href="css/jquery.smartmenus.bootstrap.css">

<body id="homepage">
	<a id="top"></a>
	<!-- TOP button -->
	<a href="<?php echo BASE; ?>#top" class="btn-large btn-floating waves-effect waves-light  blue-grey darken-4" id="top_arrow" title="TOP">
		<i class="material-icons" style="font-size:3rem;">keyboard_arrow_up</i>
	</a>

<div id="landingPageTab">
	<div class="closeIcon">
		<i class="material-icons">clear</i>
	</div>
	
	<div class="content right">
		<span>Attend a free class by an IITian</span>
		<a href="<?php echo BASE."search"; ?>" class="glyphicon glyphicon-play"></a>
	</div>
</div>

	<div id="index-banner">
		<?php
		load_view("Template/navbarhome.php",$inp);
		?>
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row ">
					<div class="col-xs-12">
						<h1 class="header center white-text">Better Marks are just the beginning!</h1>
					</div>
					<div class="col-xs-12">
						<h5 class="sub-title">Private tutoring by IITians, at home &amp; online</h5>
					</div>
				</div><br>

				<form class="row center" action="<?php echo BASE."search"; ?>" >
					<!-- Main Search Bar -->
					<div class="col-xs-12 col-sm-8 col-sm-offset-1" style="margin-bottom:10px;">
						<input placeholder="Search Tutors: Mathematics, Physics, Science etc." type="search" autocomplete="off" name="q" id="main_search_bar">
					</div>
					<div class="col-xs-12 col-sm-2">
						<button type="submit" class="btn waves-effect waves-light teal darken-3" id="main_search_button">
							Search
						</button>
					</div>
				</form>
				<ul class="nav navbar-nav row" id="homeDropdown">
					<li class="col-xs-3"><a href="">9th to 12th <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php foreach ($cst as $class_id => $class) : ?>
							<?php if($class_id == 8) break; ?>
							<li><a href="<?php echo HOST.'search/'.$class['name']; ?>"><?php echo $class['name']; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach ($class['children'] as $subject_id => $subject) : ?>
									<li><a href="<?php echo HOST.'search/'.$class['name'].'/'.$subject['name']; ?>"><?php echo $subject['name']; ?> <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<?php foreach ($subject['children'] as $topic_id => $topic) : ?>
												<li><a href="<?php echo HOST.'search/'.$class['name'].'/'.$subject['name'].'/'.str_replace(' ', '_', $topic['name']);?>"><?php echo $topic['name']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									</li>
								<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
						</ul>
					</li>
					<li class="col-xs-3"><a href="">Engineering Entrance <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php foreach ($cst as $class_id => $class) : ?>
							<?php if($class_id == 9 || $class_id == 10) : ?>
							<li><a href="<?php echo HOST.'search/'.$class['name']; ?>"><?php echo $class['name']; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach ($class['children'] as $subject_id => $subject) : ?>
									<li><a href="<?php echo HOST.'search/'.$class['name'].'/'.$subject['name']; ?>"><?php echo $subject['name']; ?> <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<?php foreach ($subject['children'] as $topic_id => $topic) : ?>
												<li><a href="<?php echo HOST.'search/'.$class['name'].'/'.$subject['name'].'/'.str_replace(' ', '_', $topic['name']);?>"><?php echo $topic['name']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									</li>
								<?php endforeach; ?>
								</ul>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
						</ul>
					</li>
					<li class="col-xs-3"><a href="<?php echo HOST.'search/'.$cst[10]['name']; ?>"><?php echo $cst[10]['name']; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a>A - B <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($cst[10]['children'] as $engg_id => $engg_subject) : ?>
									<?php $check = strtolower($engg_subject['name'][0]); if( $check == 'a' || $check == 'b') : ?>
										<li><a href="<?php echo HOST.'search/'.$cst[10]['name'].'/'.$engg_subject['name']; ?>"><?php echo $engg_subject['name']; ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							</li>
							<li><a>C - D <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($cst[10]['children'] as $engg_id => $engg_subject) : ?>
									<?php $check = strtolower($engg_subject['name'][0]); if( $check == 'c' || $check == 'd') : ?>
										<li><a href="<?php echo HOST.'search/'.$cst[10]['name'].'/'.$engg_subject['name']; ?>"><?php echo $engg_subject['name']; ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							</li>
							<li><a>E - I <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($cst[10]['children'] as $engg_id => $engg_subject) : ?>
									<?php $check = strtolower($engg_subject['name'][0]); if( $check == 'e' || $check == 'f' || $check == 'g' || $check == 'h' || $check == 'i') : ?>
										<li><a href="<?php echo HOST.'search/'.$cst[10]['name'].'/'.$engg_subject['name']; ?>"><?php echo $engg_subject['name']; ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							</li>
							<li><a>M - N <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($cst[10]['children'] as $engg_id => $engg_subject) : ?>
									<?php $check = strtolower($engg_subject['name'][0]); if( $check == 'm' || $check == 'n') : ?>
										<li><a href="<?php echo HOST.'search/'.$cst[10]['name'].'/'.$engg_subject['name']; ?>"><?php echo $engg_subject['name']; ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							</li>
							<li><a>P - T <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<?php foreach($cst[10]['children'] as $engg_id => $engg_subject) : ?>
									<?php $check = strtolower($engg_subject['name'][0]); if( $check == 'p' || $check == 'q' || $check == 'r' || $check == 's' || $check == 't') : ?>
										<li><a href="<?php echo HOST.'search/'.$cst[10]['name'].'/'.$engg_subject['name']; ?>"><?php echo $engg_subject['name']; ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</li>
					<li class="col-xs-3"><a href="<?php echo HOST.'search/'.$cst[11]['name']; ?>"><?php echo $cst[11]['name']; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php foreach ($cst[11]['children'] as $key => $value): ?>
							<li><a href="<?php echo HOST.'search/'.$cst[11]['name'].'/'.$value['name']; ?>"><?php echo $value['name']; ?></a></li>
						<?php endforeach ?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="header center grey-text text-darken-4">How it Works</h3>
				</div>
			</div>
			<div class="row">
			<!--
				<div class="col s6 l2 offset-l1">
					<div class="card-panel center hoverable" style="height:200px;padding:10px;">
						<div class="work-step-number">1</div>
						<div><i class="material-icons blue-grey-text text-darken-3" style="font-size:5rem;">list</i></div>
						<div class="blue-grey-text" style="font-size:18px;">Select <br><b>Topics</b></div>
					</div>
				</div>
			-->
				<div class="col-md-2 col-md-offset-2 col-sm-3 col-xs-6">
					<div class="card-panel center hoverable icon-panel">
						<div class="work-step-number">1</div>
						<div><i class="material-icons grey-text text-darken-3" >search</i></div>
						<div class="grey-text text-darken-3" >Search for <br><b class="teal-text">Tutors</b></div>
					</div>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<div class="card-panel center hoverable icon-panel">
						<div class="work-step-number">2</div>
						<div><i class="material-icons grey-text text-darken-3" >filter_list</i></div>
						<div class="grey-text text-darken-3" >Shortlist your <br><b class="teal-text">Tutor</b></div>
					</div>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<div class="card-panel center hoverable icon-panel">
						<div class="work-step-number">3</div>
						<div><i class="material-icons grey-text text-darken-3" >event</i></div>
						<div class="grey-text text-darken-3" >Book his <br><b class="teal-text">Slot</b></div>
					</div>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<div class="card-panel center hoverable icon-panel">
						<div class="work-step-number">4</div>
						<div><i class="material-icons grey-text text-darken-3" >desktop_windows</i></div>
						<div class="grey-text text-darken-3" >Start <br><b class="teal-text">Free Class  </b></div>
					</div>
				</div>
			</div>
<!--
			<div class="row">
				<div class="col s12">
					<div class="divider"></div>
				</div>
			</div>
-->
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="divider"></div>
			</div>
		</div>
		<div class="row center" id="numbers">
			<div class="col-xs-4">
				Teachers
				<ul class="count" data-count="<?php echo $teachers; ?>">
				</ul>
			</div>
			<div class="col-xs-4">
				Students
				<ul class="count" data-count="<?php echo $students; ?>">

				<?php // foreach(str_split(strval($students)) as $number) : ?>
				<!--	<li><?php //echo $number; ?></li> -->
				<?php // endforeach; ?>
				</ul>
			</div>
			<div class="col-xs-4">
				Topics
				<ul class="count" data-count="770">
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="row">
					<div class="col-xs-12">
						<h5 class="header grey-text text-darken-4">Why choose us</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<ul id="whyus_list" style="margin-top:0px;">
							<li>770+ Topics and 57+ Subjects to choose from</li>
							<li>Learn only from IITian Tutors</li>
							<li>Study from the comfort of your home</li>
							<li>Select the best tutor through reviews and ratings</li>
							<li>Because we care about Quality Education more<br>than anybody else</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<h5 class="header grey-text text-darken-4">Students feedback</h5>
				<div class="slider">
					<ul class="slides" id="review_slider">
					<?php
					$total = count($reviews); // 5 [0-4]
					$show = ($total > 3) ? 3 : $total; // 3
					$rand = [];
					$max = ($total !=0 ) ? ($total-1) : 0 ;
					while (count($rand) < $show) {
						$random = mt_rand(0,$max);
						if (!in_array($random, $rand))
							$rand[] = $random;
					}
					for ($i=0; $i < $show; $i++) { ?>
						<li>
							<div class="row">
								<div class="col-xs-8">
									<div class="review">
										<p class="grey-text text-darken-4">
											<?php echo $reviews[$rand[$i]]['feedback']; ?>
										</p>
										<p class="grey-text text-darken-2">
											&#45;
											<i>
												<?php echo ucwords($reviews[$rand[$i]]['student']); ?>
											</i>
										</p>
									</div>
								</div>
								<div class="col-xs-4 teacher">
									<img class="img-responsive circle" src="<?php echo $reviews[$rand[$i]]['profilepic']; ?>">
									<span class="grey-text text-darken-2"><?php echo ucwords($reviews[$rand[$i]]['teacher']); ?></span>
								</div>
							</div>
						</li>
					<?php }	?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="section">
			<div class="row grades">
				<div class="col-sm-6 col-md-3 col-xs-12">
					<div class="card-panel">
						<div class="courses-grade">
							6<sup>th</sup> - 8<sup>th</sup> Grade
						</div>
						<div class="courses-list">
							Topics
							<ul class="courses-list-ul">
								<li>Algebra</li>
								<li>Light</li>
								<li>Urban Livelihoods</li>
								<li><a href="<?php echo BASE.'search'; ?>">+ View More</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-xs-12">
					<div class="card-panel">
						<div class="courses-grade">
							9<sup>th</sup> - 10<sup>th</sup> Grade
						</div>
						<div class="courses-list">
							Topics
							<ul class="courses-list-ul">
								<li>Practical Geometry</li>
								<li>The Indian Subcontinent</li>
								<li>Heat and Thermodynamics</li>
								<li><a href="<?php echo BASE.'search'; ?>">+ View More</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-xs-12">
					<div class="card-panel">
						<div class="courses-grade">
							11<sup>th</sup> - 12<sup>th</sup> Grade
						</div>
						<div class="courses-list">
							Topics
							<ul class="courses-list-ul">
								<li>Semiconductors</li>
								<li>Plane Equations</li>
								<li>French</li>
								<li><a href="<?php echo BASE.'search'; ?>">+ View More</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-xs-12">
					<div class="card-panel">
						<div class="courses-grade">
							JEE Mains &amp; Advanced
						</div>
						<div class="courses-list">
							Topics
							<ul class="courses-list-ul">
								<li>Optics</li>
								<li>Kinematics</li>
								<li>In-Organics Chemistry</li>
								<li><a href="<?php echo BASE.'search'; ?>">+ View More</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="divider"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h5 class="center grey-text text-darken-4 topics">Choose from a myriad of Topics</h5>
				</div>
			</div>
			<div class="row center">
				<div class="col-xs-12">
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Chemical Reaction &amp; Equations</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Acids</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Bases</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Salts</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Metals</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Non-metals</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Real Number</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Polynomials</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Pair of Linear Eqations</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Sets</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Functions</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Relations</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Trignometric Functions</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Our Earth</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Some Basic Concepts of Chemistry</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Structure of Atom</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Classification of Elements</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Physical World</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Units &amp; Measurement</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Motion in a straight Line</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Matrices</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">The Solid State</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Solutions</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electrochemistry</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electric Charges and Fields</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electrostatic potential and Charge</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Current &amp; Electricity</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Complex Numbers</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Determinants</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">States of Matter</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Physics &amp; Measurement</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Kinematics</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Laws of Motion</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Permutations</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Combinations</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Gases</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Liquid State</a>
					<a href="<?php echo BASE.'search'; ?>" class="hoverable course-link" style="background-color:#00796b;color:#ffffff;border-color:#00796b;">
						And Many More +
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="jumbotron attention">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7">
					Are you an IITian?<br>Do you like tutoring students?<br>If yes, then be a part of our community. 
				</div>
				<div class="col-xs-12 col-sm-5">
					<br>
					<a class="valign btn-large waves-effect waves-light attention-joinus" href="<?php echo BASE.'joinus'; ?>">Join Us</a>
					<br>
				</div>
			</div>
		</div>
	</div>
	<div style="width:100%;display:none;" class="iit-logo-container">
		<div class="row">
			<div class="col s4 l1 offset-l1">
				<div class="card-panel hoverable center" style="padding:5px;">
					<a href="http://www.iitgn.ac.in/">
						<img src="logos/IITGandhinagar.png" title="IIT Gandhinagar" class="responsive-img">
					</a>
					<span class="iit-logo-names">Gandhinagar</span>
				</div>
			</div>
			<div class="col s4 l1">
				<div class="card-panel hoverable center" style="padding:5px;">
					<a href="">
						<img src="logos/IITGandhinagar.png" title="IIT Gandhinagar" class="responsive-img">
					</a>
					<span class="iit-logo-names">Gandhinagar</span>
				</div>
			</div>
		</div>
	</div>


	<div style="margin-bottom:0;">
		<div class="section">
			<div class="row">
				<div class="col s12">
				<div id="slider1_container" style="position: relative; height: 70px; overflow: hidden; ">
					<div u="slides" style="cursor: move; position: relative; width:1340px; height: 70px; overflow: hidden;">
						<div><a target="_blank" href="http://www.iitgn.ac.in/" ><img src="logos/IITGandhinagar.png" title="IIT Gandhinagar" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitr.ac.in" ><img src="logos/roorkee.png" title="IIT Roorkee" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitmandi.ac.in" ><img src="logos/mandi-iit.png" title="IIT Mandi" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iiti.ac.in" ><img src="logos/indore.png" title="IIT Indore" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitj.ac.in" ><img src="logos/IIT-JODHPUR-LOGO.png" title="IIT Jodhpur" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitg.ac.in" ><img src="logos/IIT-Guwahati-Logo.png" title="IIT Guwahati" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitd.ac.in" ><img src="logos/iit-delhi.png" title="IIT Delhi" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitb.ac.in" ><img src="logos/iit-bombay.png" title="IIT Bombay" height="70" width="70"></a></div>        
						<div><a target="_blank" href="http://www.iitk.ac.in" ><img src="logos/IIT_Kanpur_Logo.png" title="IIT Kanpur" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iith.ac.in" ><img src="logos/iit_hydrabad_logo.png" title="IIT Hydrabad" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitbhu.ac.in" ><img src="logos/iiit-varanasi.png" title="IIT Varanasi(BHU)" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitbbs.ac.in" ><img src="logos/bhuvneshwar.png" title="IIT Bhuvneshwar" height="70" width="70"></a></div>
						<div><a target="_blank" href="http://www.iitkgp.ac.in" ><img src="logos/IITKharagpurLogo.png" title="IIT Kharagpur" height="70" width="70"></a></div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>


	<div style="margin-bottom:-20px;" class="feel-free">
		<div class="container">
			<div class="row" style="margin-bottom:0px;">
				<div class="col-xs-12 col-sm-3">
					Feel free to <a href="<?php echo BASE.'contactus'; ?>">Contact Us</a>
				</div>
			</div>
		</div>
	</div>

<?php
load_view("Template/footer.php",$inp);
load_view("Template/bottom.php",Fun::mergeifunset($inp, array("needbody"=>false  )));
?>
	<script type="text/javascript" src="js/jssor.js"></script>
	<script type="text/javascript" src="js/jssor.slider.js"></script>
	<script src="js/home.js"></script>
	<script src="js/jquery.smartmenus.js"></script>
	<script src="js/jquery.smartmenus.bootstrap.js"></script>
</body>
</html>
