<script>	var topics=<?php echo json_encode($cst_tree); ?>;	</script>

<?php

$defopen="signupwindow";

    load_view('Template/form_errors.php',array("msg"=>$resignupmsg));
 if(empty($phone) && (User::isloginas('s'))): ?>
<div class="alert alert-success alert-dismissible fade in" role="alert">
	Please register Your Mobile Number to book a class.<a id="mob_update_link" data-toggle="modal" data-target="#myModal">click here!</a>
</div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <a data-dismiss="modal">X</a>
        <div class="modal-dialog" role="document">
<div class="row center">
              <form class="col s12 l12" method="post" onsubmit='return ms.mobregisterform(this,<?php echo tf($_ginfo["needsignupotp"]); ?>,true);' <?php if($_ginfo["needsignupotp"]) { ?>  data-action='resignupotp' data-param='{"phone":$("#signupwindow").find("input[name=phone]").val(), type: "s"}' data-res='hideshowdown("signupwindow","otpwindow");'  <?php }else{ ?>  <?php } ?>  autocomplete="off" >
                <div id="signupwindow" style='<?php dit($defopen=="signupwindow"); ?>' >
                  <div class="row">
                    <div class="input-field col s12">
                      <input name="name" type="hidden" value="<?php echo $name; ?>">
                      <input id="phone" name="phone" type="text" data-condition="phone" value="1254124512" >
                      <label for="phone">Mobile Number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn waves-effect waves-light" name="resignup" type="submit" id="submit_button">
                        Submit<i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
                <div id="otpwindow" style='<?php dit($defopen=="otpwindow"); ?>' >

                  <div class="col s12">
                    An OTP has been sent to your phone. Please enter it below.
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="otp" name="otp" type="text" data-condition="simple" class="validate" >
                      <label for="otp">One Time Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn waves-effect waves-light"  name="resignup" type="submit" >Submit
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
        </div>
        </div>
	</div>       
<?php endif; 
$_SESSION['isdonedemo']= $isdonedemo;
if(!$isdonedemo) { 
?>
<div class="alert alert-success alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	Choose a course for free class.
</div>
<?php
}
?>

<div class="row">
	<?php

	 if(User::loginId()==$tid) : ?>
	<div class="col-md-3 col-xs-12">
		<h5 class="grey-text text-darken-2">Please add your topics</h5>
		<hr class="underlined">
		<div class="row">
			<form method="post" class="col-xs-12" onsubmit='if(submitForm(this)){ form.req(this) };return false;' data-action="addtopics" data-res='div.reload($("#teacherdisptopics")[0]);' >
					<div class="form-group">
						<select name='class' class="browser-default form-control" onchange='topicssubtopic(this);' id="selectclass" data-condition='simple' style='' >
							<?php
								 disp_olist($class_olist,array('selectalltext'=>"Select Grade"));
							?>
						</select>
					</div>
					<div class="form-group">
						<select name='subject'  class="browser-default form-control" id='selectsubject' onchange='topicssubtopic(this);' data-condition='simple' >
							<option value="" >Please select grade first</option>
						</select>
					</div>
					<div class="form-group">
						<select name='topic' class="browser-default form-control" id='selecttopic' data-condition='simple' >
							<option value="" >Please select subject first</option>
						</select>
					</div>
					<div class="form-group" style="display:none">
						<input id="duration" type="text" class="validate form-control" name="timer">
						<label for="duration">Class duration (in hrs)</label>
					</div>
					<div class="form-group">
						<input id="fees" type="text" class="validate form-control" name="price" data-condition='simple' value='<?php echo $minfees; ?>' >
						<label for="fees">Fees per hour (in &#8377;)</label>
					</div>
					<div class="input-field">
						<button type="submit" class="btn waves-effect waves-light blue"><i class="material-icons left">add_circle_outline</i>Add</button>
					</div>
			</form>
		</div>
	</div>
	<?php endif; ?>
	<div class="col-md-9 col-xs-12" style="margin-top:1rem;">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th data-field="class">Grade</th>
						<th data-field="subject">Subject</th>
						<th data-field="topic" >Topic</th>
						<th data-field="duration" style="display:none">Duration (hrs)</th>
						<th data-field="fees">Fees/hr</th>
						<th data-field=""></th>
					</tr>
				</thead>
				<tbody data-tid="<?php echo $tid; ?>" data-action="disptopics" id="teacherdisptopics" >
					<?php if(User::isloginas('s')){ 
						load_view("Template/teacher_topiclist.php", array("mysubj" => $mysubj, "tid" => $tid,"user_mob"=>$phone));
					} else {
						load_view("Template/teacher_topiclist.php", array("mysubj" => $mysubj, "tid" => $tid));
					}

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
