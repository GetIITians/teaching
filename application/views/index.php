<?php
load_view("Template/top.php",$inp);
?>
<!--
mohit Saini11
Shivam Mamgain
-->
<link rel="stylesheet" href="css/custom-homestyle-v2.css">

<body id="homepage">
  <a id="top"></a>
  <!-- TOP button -->
  <a href="<?php echo BASE; ?>#top" class="btn-large btn-floating waves-effect waves-light red accent-2" id="top_arrow" title="TOP">
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

  <div id="index-banner" class="parallax-container">
    <?php
    load_view("Template/navbarhome.php",$inp);
    ?>
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row ">
          <div class="col-xs-12">
            <h1 class="header center white-text">Tuition by IITians</h1>
          </div>
          <div class="col-xs-12">
              <h5 class="sub-title">Get an IITian tutor for Any Subject! Any Class!</h5>
          </div>
        </div><br>

        <div class="row center">
          <form class="col s12" action="<?php echo BASE."search"; ?>" >
            <!-- Main Search Bar -->
            <div class="row center">
              <div class="col s12 l8 offset-l1" style="padding-left:0px;padding-right:0px;margin-bottom:10px;">
                <input placeholder="Search Tutors: Mathematics, Physics, Science etc." type="search" autocomplete="off" name="q" id="main_search_bar">
              </div>
              <div class="col s12 l2" style="padding-left:0px;">
                <button type="submit" class="btn waves-effect waves-light teal darken-3" id="main_search_button">
                  Search
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- DROPDOWN BEGIN -->
        <div id="dropdownnav" class="row" style="display:none;">
          <nav class="transparent col s12">
            <ul class="nav">
              <li><a>VI</a>
                <div>
                  <ul class="nav2">
                    <li><a href="#">Mathematics</a>
                      <div>
                      <div class="nav-column">
                        <ul>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">Algebric expression</a></li>
                          <li><a href="#">Calculas</a></li>
                          <li><a href="#">application of Trigonometry</a></li>
                          <li><a href="#">Algebra</a></li>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">Calculas</a></li>
                          <li><a href="#">Algebric expression</a></li>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">Calculas</a></li>
                        </ul>
                      </div>
                      </div>
                    </li>
                    <li><a href="#">Science</a>
                      <div>
                      <div class="nav-column">
                        <ul>
                          <li><a href="#">Calculas</a></li>
                          <li><a href="#">Algebric expression</a></li>
                          <li><a href="#">Calculas</a></li>
                          <li><a href="#">application of Trigonometry</a></li>
                          <li><a href="#">Algebra</a></li>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">Algebric expression</a></li>
                          <li><a href="#">introduction to Trigonometry</a></li>
                          <li><a href="#">Calculas</a></li>
                        </ul>
                      </div>
                      </div>
                    </li>
                    <li><a href="#">Civics</a></li>
                    <li><a href="#">Chemistry</a></li>
                    <li><a href="#">Physics</a></li>
                    <li><a href="#">English</a></li>
                    <li><a href="#">Computer</a></li>
                    <li><a href="#">Hindi</a></li>
                    <li><a href="#">Bussiness</a></li>
                    <li><a href="#">Accounts</a></li>
                    <li><a href="#">Psychology</a></li>
                    <li><a href="#">Sociology</a></li>
                  </ul>
                </div>
              </li>
              <li><a>VII</a></li>
              <li><a>VIII</a></li>
              <li><a>IX</a></li>
              <li><a>X</a></li>
              <li><a>XI</a></li>
              <li><a>XII</a></li>
              <li><a>JEE-mains</a></li>
              <li><a>JEE-advance</a></li>
            </ul>
          </nav>
        </div>
        <!-- DROPDOWN END -->
      </div>
    </div>
    <div class="parallax" height="100%"><img src="images/banner.png" width="85%" alt="Banner" ></div>
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
            <div class="opensans-font blue-grey-text" style="font-size:18px;">Select <br><b>Topics</b></div>
          </div>
        </div>
      -->
        <div class="col-md-2 col-md-offset-2 col-sm-3 col-xs-12">
          <div class="card-panel center hoverable" style="height:200px;padding:10px;">
            <div class="work-step-number">1</div>
            <div><i class="material-icons grey-text text-darken-4" style="font-size:5rem;">search</i></div>
            <div class="opensans-font grey-text text-darken-3" style="font-size:18px;">Search for <br><b class="red-text text-accent-2">Tutors</b></div>
          </div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-12">
          <div class="card-panel center hoverable" style="height:200px;padding:10px;">
            <div class="work-step-number">2</div>
            <div><i class="material-icons grey-text text-darken-4" style="font-size:4.5rem;">filter_list</i></div>
            <div class="opensans-font grey-text text-darken-3" style="font-size:18px;margin-top:6px;">Shortlist your <br><b class="red-text text-accent-2">Tutor</b></div>
          </div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-12">
          <div class="card-panel center hoverable" style="height:200px;padding:10px;">
            <div class="work-step-number">3</div>
            <div><i class="material-icons grey-text text-darken-4" style="font-size:5rem;">event</i></div>
            <div class="opensans-font grey-text text-darken-3" style="font-size:18px;">Book his <br><b class="red-text text-accent-2">Slot</b></div>
          </div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-12">
          <div class="card-panel center hoverable" style="height:200px;padding:10px;">
            <div class="work-step-number">4</div>
            <div><i class="material-icons grey-text text-darken-4" style="font-size:5rem;">desktop_windows</i></div>
            <div class="opensans-font grey-text text-darken-3" style="font-size:18px;">Start <br><b class="red-text text-accent-2">Free Class  </b></div>
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
    <div class="rows" id="numbers">
      <div class="col-sm-4">
        Registered Tutors
        <ul>
        <?php foreach(str_split(strval($teachers)) as $number) : ?>
          <li><?php echo $number; ?></li>
        <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-sm-4">
        Registered Students
        <ul>
        <?php foreach(str_split(strval($students)) as $number) : ?>
          <li><?php echo $number; ?></li>
        <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-sm-4">
        Topics
        <ul>
          <li>7</li>
          <li>7</li>
          <li>0</li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="row">
          <div class="col-xs-12">
            <h5 class="header grey-text text-darken-4 opensans-font">Why choose us</h5>
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
        <div class="row">
          <div class="col-xs-12">
            <h5 class="header grey-text text-darken-4 opensans-font">Students and Tutors love us</h5>
          </div>
        </div>
        <div>
          <div class="slider">
            <ul class="slides" id="review_slider">
              <?php
                $total = count($reviews); // 4
                $show = 3;
                $rand = [];
                while (count($rand) < $show) {
                  $random = mt_rand(0,$total-1);
                  if (!in_array($random, $rand))
                    $rand[] = $random;
                }
                for ($i=0; $i < $show; $i++) {
                  echo "<li><div class=\"row left-align\"><div class=\"col-xs-12\"><div class=\"review-comment\"><blockquote>";
                    echo "<p>".$reviews[$rand[$i]]['feedback']."</p>";
                    echo "<footer><cite>".$reviews[$rand[$i]]['name']."</cite></footer>";
                  echo "</blockquote></div></div></div></li>";
                }
              ?>
              <!--
              <li>
                <div class="row left-align">
                  <div class="col s12">
                    <div class="review-comment">
                      Getting the best tutors at one click.<br><a href="#">#WayToGo</a> <a href="#">@getIITians</a>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="row left-align">
                  <div class="col s12">
                    <div class="review-comment">
                      <a href="#">@getiitians</a> Excellent tutoring service.<br>The best I have seen so far.<br><a href="#">#FTW #getIITians</a>
                    </div>
                    -->
                    <!--
                    <div class="reviewer">
                      <div class="row">
                        <div class="col s3 right-align">
                          <img class="img-responsive circle" src="images/review2.jpg" style="max-width:60px;">
                        </div>
                        <div class="col s9">
                          <a href="#">Rajiv Air</a><br>
                          <div class="grey-text">CEO, Malvo.com</div>
                        </div>
                      </div>
                    </div>
                    -->
                    <!--
                  </div>
                </div>
              </li>
              <li>
                <div class="row left-align">
                  <div class="col s12">
                    <div class="review-comment">
                      website is user friendly and very intuitive. <a href="#">#keepitup</a>
                    </div>
                  </div>
                </div>
              </li>
              -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="divider"></div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col-sm-6 col-md-3 col-xs-12">
          <div class="card-panel" style="padding:0px;">
            <div class="courses-grade teal darken-3">
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
          <div class="card-panel" style="padding:0px;">
            <div class="courses-grade teal darken-3">
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
          <div class="card-panel" style="padding:0px;">
            <div class="courses-grade teal darken-3">
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
          <div class="card-panel" style="padding:0px;">
            <div class="courses-grade teal darken-3" style="font-size:15px;">
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



  <div style="width:100%;background:#ffffff;">
    <div class="section">
      <div class="row">
        <div class="col s12">
          <h5 class="center teal-text text-darken-4 opensans-font">Choose from a myriad of Topics</h5>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="divider"></div>
        </div>
      </div>
      <div class="row center" style="margin-bottom:0px">
        <div class="col s12" style="line-height:250%;">
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Chemical Reaction and Equatio</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Acides</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Bases</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Salts</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Metals</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Non-metals</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Real Number</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Polynomials</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Pair of Linear Eqations in Tw</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Sets</a>
        </div>
      </div>
      <div class="row center" style="margin-bottom:0px">
        <div class="col s12" style="line-height:250%;">
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Functions</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Relations</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Trigometric Functions</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Our Earth</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Some Basic Concepts of Chemist</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Structure of Atom</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Classification of Elements</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Physical World</a>
        </div>
      </div>
      <div class="row center" style="margin-bottom:0px">
        <div class="col s12" style="line-height:250%;">
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Units and Measurement</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Motion in a straight Line</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Matrices</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">The Solid State</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Solutions</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electrochemistry</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electric Charges and Fields</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Electrostatic potential and Cs</a>
        </div>
      </div>
      <div class="row center" style="margin-bottom:0px">
        <div class="col s12" style="line-height:250%;">
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Current Electricity</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Complex Number</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Deteerminants</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">States of Matter</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Physics and Measurement</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Kinematics</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Lawn of Motion</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Permutations</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Combinations</a>
        </div>
      </div>
      <div class="row center" style="margin-bottom:0px">
        <div class="col s12" style="line-height:250%;">
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Gaseous</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link">Liquid State</a>
          <a href="<?php echo BASE.'search'; ?>" class="hoverable course-link" style="background-color:#00796b;color:#ffffff;">
            And Many More +
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <br><br>
        </div>
      </div>
    </div>
  </div>

  <div style="width:100%;" class="attention">
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


  <div style="width:100%;margin-bottom:-20px;" class="feel-free">
    <div class="container">
      <div class="row" style="margin-bottom:0px;">
        <div class="col s12 l3">
          Feel free to <a href="#">Contact Us</a>
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
</body>
</html>
