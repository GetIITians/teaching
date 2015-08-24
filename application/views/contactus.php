<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");
?>

<main>
	<div class="container">
	<br>
	  <div class="row">
	  	<div class="col-xs-12 col-sm-6">
	  		<div class="card-panel" style="height:520px;">
	  		  <div class="row">
            <div class="col-xs-12">
              <h4 class="teal-text text-darken-1 center">Contact Us</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <h6 class="teal-text text-darken-1">Address <i class="material-icons tiny">navigation</i></h6>
              <div class="grey-text">
                B-178<br>
                Shivalik<br>
                Malviya Nagar<br>
                New Delhi - 110017<br>
                India
              </div>
            </div>
            <div class="col-xs-6">
              <h6 class="teal-text text-darken-1">Mail <i class="material-icons tiny">mail</i></h6>
              <div class="grey-text">
                info@getiitians.com
              </div><br>
              <h6 class="teal-text text-darken-1">Call <i class="material-icons tiny">call</i></h6>
              <div class="grey-text">
                +91 931 339 4403
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
                <div id="map-canvas" style="height: 220px;"></div>
              </div>
            </div>
          </div>
	  		</div>
	  	</div>
	  	<div class="col-xs-12 col-sm-6">
        <div class="card-panel" style="height:520px;padding:2.5rem;">
	    		<div class="row">
		    		<?php
					    if(!empty($msg)) {
            ?>
            <div class="col-xs-12">
					    <div class="light-blue card-panel">
                <h6 class="white-text"><?php echo $msg;?></h6>
              </div>
            </div>
					  <?php
              }
					    else {
					  ?>
	    		  <form id="contact-form" class="col s12" method="post">
	    		  	<div class="row">
	    		  	  <div class="col-xs-12">
	    		  	  	<h5 class="teal-text">How can we help you?</h5><br>
	    		  	  </div>
	    		  	  <div class="input-field col-xs-12">
	    		  	  	<input id="name" name="name" type="text" class="validate" required>
	    		  	  	<label for="name">Name</label>
	    		  	  </div>
	    		  	  <div class="input-field col-xs-12">
	    		  	  	<input id="email" name="email" type="email" class="validate" required>
	    		  	  	<label for="email">Email</label>
	    		  	  </div>
	    		  	  <div class="input-field col-xs-12">
	    		  	  	<input id="phone_number" name="phone" type="text" class="validate" required>
	    		  	  	<label for="phone_number">Phone Number</label>
	    		  	  </div>
	    		  	  <div class="input-field col-xs-12">
	    		  	  	<textarea id="message" name="msg" class="materialize-textarea" required length="100"></textarea>
          				<label for="message">Your Message</label>
	    		  	  </div>
	    		  	  <div class="col-xs-12">
	    		  	  	<button type="submit" class="btn waves-light waves-effect">Send
	    		  	  	  <i class="material-icons right">send</i>
	    		  	  	</button>
	    		  	  </div>
	    		  	</div>
	    		  </form>
	    		  <?php
				      }
			      ?>
	    		</div>
	    	</div>
	  	</div>
	  </div>
	</div>
</main>

<?php
load_view("Template/footer.php");
load_view("Template/bottom.php",Fun::mergeifunset($inp,array("needbody"=>false)));
?>
  <script src="https://maps.googleapis.com/maps/api/js"></script>
  <script src="js/contactus.js"></script>
</body>
</html>