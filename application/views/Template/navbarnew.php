<body>
  <!-- Dropdown for Create Account -->
  <ul id="dropdownaccount" class="dropdown-content">
    <li><a href="<?php echo BASE."signup" ;?>">Signup&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:13px;" class="grey-text">for Students</span></a></li>
    <li><a href="<?php echo BASE."joinus" ;?>">Joinus&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:13px;" class="grey-text">for Tutors</span></a></li>
  </ul>

  <!-- NavBar -->
  <div class="navbar-fixed">
    <nav class="blue darken-1" role="navigation">
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">getIITians</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="<?php echo BASE."aboutus"; ?>">About</a></li>
          <li><a href="<?php echo BASE."contactus"; ?>">Contact Us</a></li>

          <?php
          if (User::islogin()) {
          ?>
          <li><a href="<?php echo BASE."profile" ;?>">Profile</a></li>
          <li><a href="<?php echo BASE."?logout"; ?>">Logout</a></li>
          <?php
          }
          else {
          ?>
          <li><a href="<?php echo BASE."login"; ?>">Login</a></li>
          <li>
            <a class="dropdown-button" href="#" data-beloworigin="true" data-activates="dropdownaccount">
              Create Account <i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
          <?php
          }
          ?>

          <form class="right" action="<?php echo BASE."search"; ?>" >
            <div class="input-field">
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
    <li><a href="<?php echo BASE."aboutus"; ?>">About</a></li>
    <li><a href="<?php echo BASE."contactus"; ?>">Contact Us</a></li>

    <?php
    if (User::islogin()) {
    ?>
    <li><a href="<?php echo BASE."profile" ;?>">Profile</a></li>
    <li><a href="<?php echo BASE."?logout"; ?>">Logout</a></li>
    <?php
    }
    else {
    ?>
    <li><a href="<?php echo BASE."login"; ?>">Login</a></li>
    <li>
      <a href="<?php echo BASE."signup" ;?>">Signup&nbsp;&nbsp;&nbsp;&nbsp;
      <span style="font-size:13px;" class="grey-text">for Students</span></a>
    </li>
    <li>
      <a href="<?php echo BASE."joinus" ;?>">Joinus&nbsp;&nbsp;&nbsp;&nbsp;
      <span style="font-size:13px;" class="grey-text">for Tutors</span></a>
    </li>
    <?php
    }
    ?>

    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">search</i>
            <input id="sidenav_search" type="text" name="q">
            <label for="sidenav_search">Search Tutors</label>
            <button type="submit" style="display:none;" ></button>
          </div>
        </div>
      </form>
    </div>
  </ul>
