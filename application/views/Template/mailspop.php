<?php  
foreach($qresult as $teacher){
	$email[] = $teacher['email'];
	$phone[] = $teacher['phone'];
}
$emails = json_encode($email);
$phones = json_encode($phone);

?>

<div class="row center">
	<form class="col-xs-12 col-md-12" method="post" data-action='sendteachermails' onsubmit='return form.req(this);'  data-res='Materialize.toast("Messages Sent", 4000, "green");mohit.popup_close("mailpopup");'  autocomplete="off" >
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