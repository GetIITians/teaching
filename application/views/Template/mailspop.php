<div class="row center">
	<form class="col-xs-12 col-md-12" method="post" data-action='sendteachermails' onsubmit='return adminThings.sendMessage(this);'  data-res='Materialize.toast("Messages Sent", 4000, "green");mohit.popup_close("mailpopup");'  autocomplete="off" >
		<input type="hidden" name="emails" value='<?php echo $emails; ?>'>
		<input type="hidden" name="phones" value='<?php echo $phones; ?>'>
		<div id="signupwindow">
			<div class="row">
				<div class="col-xs-1">
					<input id="Email" type="checkbox" class="filled-in" name="cemail" checked  />
					<label style="padding-left:23px;" for="Email" >
						Email
					</label>
				</div>												
				<div class="col-xs-1">
					<input id="SMS" type="checkbox" class="filled-in" name="csms" checked  />
					<label style="padding-left:23px;" for="SMS" >
						SMS
					</label>
				</div>												
			</div>
			<div class="row no-margin-bottom">
				<div class="col-xs-12 col-md-12">
					<input id="fullname" name="title" type="text" placeholder="Subject"  data-condition='simple'>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<textarea placeholder="Message" name="msg" style="height:100px" required ></textarea>
				</div>
			</div>
			<div class="row" id="selectTeachers">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-6 eandp"><h3>Emails</h3></div>
						<div class="col-xs-6 eandp"><h3>Phones</h3></div>
					</div>
					<?php
						foreach($qresult as $teacher){
							echo "<div class='row'>";
								echo "<div class='col-xs-6 eandp'>";
									echo "<input class='email' type='checkbox' name='emails' value='".$teacher['email']."' id='".trim(strtolower($teacher['name']))."email'><label for='".trim(strtolower($teacher['name']))."email'>".$teacher['name']."</label>";
								echo "</div>";
								echo "<div class='col-xs-6 eandp'>";
									echo "<input class='phone' type='checkbox' name='phones' value='".$teacher['phone']."' id='".trim(strtolower($teacher['name']))."phone'><label for='".trim(strtolower($teacher['name']))."phone'>".$teacher['name']."</label>";
								echo "</div>";
							echo "</div>";
						}
					?>
				</div>
			</div>
			<div class="row">
				<div class="input-field col-xs-12">
					<button class="btn waves-effect waves-light" name="signup"  type="submit" id="submit_button" data-waittext="Waiting..." data-enablebutton=0>
						Send<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>