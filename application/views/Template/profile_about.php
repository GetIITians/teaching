<div class="row">
	<div class="col-md-3 col-xs-12">
		<img class="materialboxed" height="200" width="200" src="
			<?php
			if ($aboutinfo['profilepic'] != '')
				echo $aboutinfo['profilepic']; 
			else
				echo 'photo/human1.png';
			?>"
		>
		<!-- Change Profile Picture -->
		<?php if(User::loginId() == $tid) : ?>
			<form method="post" enctype="multipart/form-data"> 
				<a onclick='uploadfile(this,"profilepic");' style="cursor:pointer;" >Change Profile Picture</a>
			</form>
			<a class="modal-trigger " href="#editProfile">Edit Profile</a>
		<?php endif; ?>

		<div id="pic_upload" class="modal">
			<div class="modal-content">
				<h6 class="teal-text">Change Profile Picture</h6>
			</div>
			<div class="row">
				<form action="#" class="col s12 l6 offset-l3">
					<div class="row">
						<div class="file-field input-field col s12">
							<input class="file-path validate" type="text">
							<div class="btn waves-effect waves-light blue">
								<span>Upload</span>
								<input type="file">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<button type="submit" class="btn waves-effect waves-light white grey-text">Change</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End -->
	</div>
	<div class="col-md-5 col-xs-12" >
		<div class="row">
			<h4 class="teal-text text-darken-3 left col-xs-12"><?php echo ucfirst($aboutinfo["name"]); ?></h4>
			<form class="col-xs-12" onsubmit='form.req(this);return false;' data-action='updatebio' data-res='hideshowdown("bioedit", "biodisp");$("#biodisptext").html($("#biography").val());' >
				<div id='biodisp' >
						<div data-onhover='hovercss(this, {"display":""}));' >
							<!-- Narayan Waraich -->							
							<?php $teachermoto = Fun::smilymsg($aboutinfo["teachermoto"]); ?>
							<span id='biodisptext' ><?php echo $teachermoto; ?></span>
							<?php if(User::loginId() == $tid) :	?>
								<?php if (empty($teachermoto)) echo "Write a small description about yourself."; ?>
							<span onclick='hideshowdown("biodisp", "bioedit");' class='glyphicon glyphicon-edit teal-text text-darken-3' ></span>
							<?php endif; ?>
							<!-- ############### -->						
						</div>
				</div>
				<div style='display:none;' id='bioedit'>
					<div class="input-field">
						<textarea name="teachermoto" id="biography" class="materialize-textarea" placeholder="Write a small description about yourself." length="200"; ><?php echo convchars($aboutinfo["teachermoto"]); ?></textarea>
						<label for="biography">Bio</label>
					</div>
					<div class="input-field">
						<button class="btn waves-effect waves-light blue" type="submit"><i class="material-icons left" data-waittext='Saving..' ></i>Save Changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4">
		<h4><i class="material-icons left">subject</i>Teaching Details</h4>
		<hr class="lightscale">
		<div class="row">
			<div class="col-xs-6">
				Subjects :
				<span class="grey-text text-darken-1">
					<ul>
						<?php foreach ($subArray as $value) echo '<li>'.$value.'</li>';	?>
					</ul>
				</span>
			</div>
			<div class="col-xs-6">
				Grades :
				<span class="grey-text text-darken-1">
					<ul>
						<?php foreach ($gradeArray as $value)	echo '<li>'.convgrade($value).'</li>'; ?>
					</ul>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				Languages :
				<span class="grey-text text-darken-1">
					<ul>
						<?php foreach ($langArray as $value) echo '<li>'.convlang($value).'</li>'; ?>
					</ul>
				</span>
			</div>
			<div class="col-xs-6">
				Minimum Fees :
				<span class="grey-text text-darken-1">
					<ul>
						<?php echo '<li>'.digrupee($jsonArray['minfees']).'</li>'; ?>
					</ul>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12 mb25">
		<h4><i class="material-icons left">perm_identity</i>Basic</h4>
		<hr class="lightscale">
		<div>
			Name :
			<span class="grey-text text-darken-1">
				<?php echo Fun::smilymsg($firstName) ." ". Fun::smilymsg($lastName); ?>
			</span>
		</div>
		<div>
			<?php if($cansee) : ?>
				Email :
				<span class="grey-text text-darken-1">
					<?php echo $aboutinfo['email']; ?>
				</span>
			<?php endif; ?>
		</div>
		<div>
			Birthday :
			<span class="grey-text text-darken-1">
				<?php echo date('d-m-Y',$aboutinfo['dob']); ?>
			</span>
		</div>
		<div>
			Gender :
			<span class="grey-text text-darken-1">
				<?php
					$gender = Fun::smilymsg($aboutinfo['gender']);
					echo (($gender=='m') ? 'Male' : ( ($gender=='f') ? 'Female' : 'Other' ) );
				?>
			</span>
		</div>
		<div>
			City :
			<span class="grey-text text-darken-1">
				<?php echo $jsonArray['city']; ?>
			</span>
		</div>
		<?php  if((User::isloginas('t') || User::isloginas('a') )  && !empty($ejsoninfo["resume"])) : ?>
		<div>
			Resume :
			<span class="grey-text text-darken-1">
				<a target="_new" href="<?php echo $ejsoninfo["resume"] ; ?>">Click to see</a>
			</span>
		</div>
		<?php endif;  ?>
	</div>
	<div class="col-md-4 col-xs-12 mb25">
	<?php if($cansee) : ?>
		<h4><i class="material-icons left">perm_phone_msg</i>Contact</h4>
		<hr class="lightscale">
		<div>
			Address :
			<span class="grey-text text-darken-1">
				<?php echo Fun::smilymsg($jsonArray['city']) ."<br>". Fun::smilymsg($jsonArray['state']) .", ". Fun::smilymsg($jsonArray['zipcode']) ."<br>". Fun::smilymsg($jsonArray['country']); ?>
			</span>
		</div>
		<div>
			Mobile Number :
			<span class="grey-text text-darken-1">
				<?php echo Fun::smilymsg($aboutinfo['phone']); ?>
			</span>
		</div>
	<?php endif; ?>
	</div>
	<div class="col-md-4 col-xs-12 mb25">
		<h4><i class="material-icons left">school</i>Education and Qualifications</h4>
		<hr class="lightscale">
		<div>
			<span class="grey-text text-darken-1">
				<?php
					if ($jsonArray['degreeother'] != '') {
						echo Fun::smilymsg($jsonArray['degreeother']);
					} else {
						echo convert_degree(Fun::smilymsg($jsonArray['degree']));
					}
					echo " in ";
					echo Fun::smilymsg($jsonArray['branch']);
					echo " from ";
					echo 'IIT '. $jsonArray['college'];
					echo ".";
				?>
			</span>
		</div>
		<?php
			if (isset($jsonArray['ex_branch1']) || array_key_exists('ex_branch1',$jsonArray)) {
				$countExtra = count(preg_grep("/^ex_branch/", array_keys($jsonArray)));
				for ($i=1; $i <= $countExtra ; $i++) {
					echo "<div><span class='grey-text text-darken-1'>";
					if ($jsonArray['ex_degreeother'.$i] != '') {
						echo Fun::smilymsg($jsonArray['ex_degreeother'.$i]);
					} else {
						echo convert_degree(Fun::smilymsg($jsonArray['ex_degree'.$i]));
					}
					echo " in ";
					echo Fun::smilymsg($jsonArray['ex_branch'.$i]);
					echo " from ";
					if ($jsonArray['ex_collegeother'.$i] != '') {
						echo $jsonArray['ex_collegeother'.$i];
					} else {
						echo 'IIT '.$jsonArray['ex_college'.$i];
					}
					echo ".</span></div>";
				}
			}
		?>
		<?php /* ?>
		<div>
			College :
			<span class="grey-text text-darken-1">
				<?php echo 'IIT '. $jsonArray['college']; ?>
			</span>
		</div>
		<div>
			Degree :
			<span class="grey-text text-darken-1">
				<?php
				echo Fun::smilymsg($jsonArray['degree']);
				if ($jsonArray['degreeother'] != '')
					echo ' , '.Fun::smilymsg($jsonArray['degreeother']);
				?>
			</span>
		</div>
		<div>
			Branch :
			<span class="grey-text text-darken-1">
				<?php echo Fun::smilymsg($jsonArray['branch']); ?>
			</span>
		</div>
		<?php  if((User::isloginas('t')|| User::isloginas('a')) && !empty($ejsoninfo["calvarification"]) ) : ?>
		<div>
			College Verification :
			<span class="grey-text text-darken-1">
				<a target="_new" href="<?php echo $ejsoninfo["calvarification"] ; ?>">Click to see</a>
			</span>
		</div>
		<?php endif; */ ?>
	</div>
</div>

<?php

//fb($jsonArray,'$jsonArray',FirePHP::LOG);

?>

<form class="col-xs-12 col-md-10 col-md-offset-1" enctype="multipart/form-data"  method="post" action="<?php echo BASE."edit1" ?>">
<div id="editProfile" class="modal modal-fixed-footer">
	<div class="modal-content">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<span class="grey-text text-darken-1">
						Subjects
						<span class="red-text">
							*
						</span>
					</span>
					<br />
					<span class="grey-text text-lighten-1" style="font-size: 13px;">
						You would like to teach
					</span>
				</div>
				<div class="col-xs-12 col-md-8">
					<div class="row" id="editSubject">
						<div class="col-xs-6">
							<input id="math" type="checkbox" value="1" name="sub1" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Mathematics', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="math">
								Mathematics
							</label>
						</div>
						<div class="col-xs-6">
							<input id="physics" type="checkbox" value="2" name="sub2" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Physics', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="physics">
								Physics
							</label>
						</div>
						<div class="col-xs-6">
							<input id="chemistry" type="checkbox" value="3" name="sub3" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Chemistry', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="chemistry">
								Chemistry
							</label>
						</div>
						<div class="col-xs-6">
							<input id="biology" type="checkbox" value="4" name="sub4" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Biology', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="biology">
								Biology
							</label>
						</div>
						<div class="col-xs-6">
							<input id="science" type="checkbox" value="5" name="sub5" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Science(6-10)', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="science">
								Science (6-10)
							</label>
						</div>
						<div class="col-xs-6">
							<input id="subject_other" type="checkbox" value="sub6" name="sub6" data-condition="checkbox" data-group="sub" onchange="specifySubOther()" <?php if(!empty($jsonArray['subother'])) { echo "checked";} ?> />
							<label for="subject_other">
								Other
							</label>
						</div>
					</div>
				</div>
			</div>
	<div class="row" id="specify_sub_other">
		<div class="col-xs-12 col-md-8 col-md-offset-4">
			<input placeholder="Please specify if other" type="text" class="validate" name="subother" value="<?php echo $jsonArray['subother']; ?>" />
		</div>
	</div>
	<div class="divider"></div>
	<div class="row" id="editGrade">
		<div class="col-xs-12 col-md-4">
			<span class="grey-text text-darken-1">
				Grade
				<span class="red-text">
					*
				</span>
			</span>
		</div>
		<div class="col-xs-12 col-md-4">
			<div>
				<input id="6to8" type="checkbox" value="1" name="grade1" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('1', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?>  />
				<label for="6to8">
					6
					<sup>
						th
					</sup>
					to 8
					<sup>
						th
					</sup>
				</label>
			</div>
			<div>
				<input id="9to10" type="checkbox" value="2" name="grade2" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('2', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
				<label for="9to10">
					9
					<sup>
						th
					</sup>
					to 10
					<sup>
						th
					</sup>
				</label>
			</div>
		</div>
		<div class="col-xs-12 col-md-4">
			<div>
				<input id="11to12" type="checkbox" value="3" name="grade3" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('3', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
				<label for="11to12">
					11
					<sup>
						th
					</sup>
					to 12
					<sup>
						th
					</sup>
				</label>
			</div>
			<div>
				<input id="iitjee" type="checkbox" value="4" name="grade4" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('4', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
				<label for="iitjee">
					IIT JEE
				</label>
			</div>
		</div>
	</div>
	<div class="divider"></div>
	<div class="row"  id="editLanguage">
	<div class="col-xs-12 col-md-4">
		<span class="grey-text text-darken-1">
			Languages
			<span class="red-text">
				*
			</span>
		</span>
		<br />
		<span class="grey-text text-lighten-1" style="font-size: 13px;">
			You are comfortable to teach in
		</span>
	</div>
	<div class="col-xs-12 col-md-4">
		<div>
			<input id="lang1" type="checkbox" value="1" name="lang1" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('1', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang1">
				English
			</label>
		</div>
		<div>
			<input id="lang2" type="checkbox" value="2" name="lang2" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('2', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang2">
				Hindi
			</label>
		</div>
		<div>
			<input id="lang3" type="checkbox" value="3" name="lang3" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('3', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang3">
				Assamese
			</label>
		</div>
		<div>
			<input id="lang5" type="checkbox" value="4" name="lang4" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('4', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang5">
				Sanskrit
			</label>
		</div>
		<div>
			<input id="lang6" type="checkbox" value="5" name="lang5" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('5', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang6">
				Bengali
			</label>
		</div>
		<div>
			<input id="lang7" type="checkbox" value="6" name="lang6" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('6', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang7">
				Mayalayam
			</label>
		</div>
		<div>
			<input id="lang8" type="checkbox" value="7" name="lang7" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('7', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang8">
				Tamil
			</label>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div>
			<input id="lang9" type="checkbox" value="8" name="lang8" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('8', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang9">
				Gujarati
			</label>
		</div>
		<div>
			<input id="lang10" type="checkbox" value="9" name="lang9" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('9', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang10">
				Marathi
			</label>
		</div>
		<div>
			<input id="lang11" type="checkbox" value="10" name="lang10" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('10', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang11">
				Telugu
			</label>
		</div>
		<div>
			<input id="lang12" type="checkbox" value="11" name="lang11" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('11', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang12">
				Oriya
			</label>
		</div>
		<div>
			<input id="lang13" type="checkbox" value="12" name="lang12" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('12', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang13">
				Urdu
			</label>
		</div>
		<div>
			<input id="lang14" type="checkbox" value="13" name="lang13" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('13', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang14">
				Kannada
			</label>
		</div>
		<div>
			<input id="lang15" type="checkbox" value="14" name="lang14" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('14', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang15">
				Punjabi
			</label>
		</div>
	</div>
</div>
		<div class="row"  id="editName">
			<div class="col-xs-12 col-md-4">
				<span class="grey-text text-darken-1">
					Full Name
					<span class="red-text">
						*
					</span>
				</span>
				<br />
			</div>
			<div class="col-xs-6 col-md-4">
				<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $firstName ?>" placeholder="Full Name">
			</div>
			<div class="col-xs-6 col-md-4">
				<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lastName ?>" placeholder="Full Name">
			</div>
		</div>
		<div class="row"  id="editDob">
			<div class="col-xs-12 col-md-4">
				<span class="grey-text text-darken-1">
					Birthday
					<span class="red-text">
						*
					</span>
				</span>
				<br />
			</div>
			<div class="col-xs-12 col-md-8">
				<div class="row">
					<div class="col-md-12">
						<input type="date" class="datepicker" name="dob" value="<?php echo date('d',$aboutinfo['dob']).' '.date('F',$aboutinfo['dob']).', '.date('Y',$aboutinfo['dob']); ?>" class="form-control" id="day" placeholder="day">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-xs-12 col-md-4">
					<span class="grey-text text-darken-1">
						Address
						<span class="red-text">
							*
						</span>
					</span>
				</div>
				<div class="col-xs-12 col-md-4">
					<div>
						<input placeholder="City" type="text" class="validate" name="city" value="<?php echo $jsonArray['city']; ?>" data-condition="simple"  />
					</div>
					<div>
						<input placeholder="Postal/Zip Code" type="text" class="validate" name="zipcode" value="<?php echo $jsonArray['zipcode']; ?>" data-condition="simple" />
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<div>
						<input placeholder="State/Province" type="text" class="validate" name="state" value="<?php echo $jsonArray['state']; ?>" data-condition="simple"   />
					</div>
					<select name="country" class="browser-default" data-condition="simple">
						<option value="<?php echo $jsonArray['country']; ?>" selected="selected" >
							<?php echo $jsonArray['country']; ?>
						</option>
						<option value="Afghanistan"  >
							Afghanistan
						</option>
						<option value="Albania">
							Albania
						</option>
						<option value="Algeria">
							Algeria
						</option>
						<option value="American Samoa">
							American Samoa
						</option>
						<option value="Andorra">
							Andorra
						</option>
						<option value="Angola">
							Angola
						</option>
						<option value="Anguilla">
							Anguilla
						</option>
						<option value="Antigua and Barbuda">
							Antigua and Barbuda
						</option>
						<option value="Argentina">
							Argentina
						</option>
						<option value="Armenia">
							Armenia
						</option>
						<option value="Aruba">
							Aruba
						</option>
						<option value="Australia">
							Australia
						</option>
						<option value="Austria">
							Austria
						</option>
						<option value="Azerbaijan">
							Azerbaijan
						</option>
						<option value="The Bahamas">
							The Bahamas
						</option>
						<option value="Bahrain">
							Bahrain
						</option>
						<option value="Bangladesh">
							Bangladesh
						</option>
						<option value="Barbados">
							Barbados
						</option>
						<option value="Belarus">
							Belarus
						</option>
						<option value="Belgium">
							Belgium
						</option>
						<option value="Belize">
							Belize
						</option>
						<option value="Benin">
							Benin
						</option>
						<option value="Bermuda">
							Bermuda
						</option>
						<option value="Bhutan">
							Bhutan
						</option>
						<option value="Bolivia">
							Bolivia
						</option>
						<option value="Bosnia and Herzegovina">
							Bosnia and Herzegovina
						</option>
						<option value="Botswana">
							Botswana
						</option>
						<option value="Brazil">
							Brazil
						</option>
						<option value="Brunei">
							Brunei
						</option>
						<option value="Bulgaria">
							Bulgaria
						</option>
						<option value="Burkina Faso">
							Burkina Faso
						</option>
						<option value="Burundi">
							Burundi
						</option>
						<option value="Cambodia">
							Cambodia
						</option>
						<option value="Cameroon">
							Cameroon
						</option>
						<option value="Canada">
							Canada
						</option>
						<option value="Cape Verde">
							Cape Verde
						</option>
						<option value="Cayman Islands">
							Cayman Islands
						</option>
						<option value="Central African Republic">
							Central African Republic
						</option>
						<option value="Chad">
							Chad
						</option>
						<option value="Chile">
							Chile
						</option>
						<option value="People's Republic of China">
							People's Republic of China
						</option>
						<option value="Republic of China">
							Republic of China
						</option>
						<option value="Christmas Island">
							Christmas Island
						</option>
						<option value="Cocos (Keeling) Islands">
							Cocos (Keeling) Islands
						</option>
						<option value="Colombia">
							Colombia
						</option>
						<option value="Comoros">
							Comoros
						</option>
						<option value="Congo">
							Congo
						</option>
						<option value="Cook Islands">
							Cook Islands
						</option>
						<option value="Costa Rica">
							Costa Rica
						</option>
						<option value="Cote d'Ivoire">
							Cote d'Ivoire
						</option>
						<option value="Croatia">
							Croatia
						</option>
						<option value="Cuba">
							Cuba
						</option>
						<option value="Cyprus">
							Cyprus
						</option>
						<option value="Czech Republic">
							Czech Republic
						</option>
						<option value="Denmark">
							Denmark
						</option>
						<option value="Djibouti">
							Djibouti
						</option>
						<option value="Dominica">
							Dominica
						</option>
						<option value="Dominican Republic">
							Dominican Republic
						</option>
						<option value="Ecuador">
							Ecuador
						</option>
						<option value="Egypt">
							Egypt
						</option>
						<option value="El Salvador">
							El Salvador
						</option>
						<option value="Equatorial Guinea">
							Equatorial Guinea
						</option>
						<option value="Eritrea">
							Eritrea
						</option>
						<option value="Estonia">
							Estonia
						</option>
						<option value="Ethiopia">
							Ethiopia
						</option>
						<option value="Falkland Islands">
							Falkland Islands
						</option>
						<option value="Faroe Islands">
							Faroe Islands
						</option>
						<option value="Fiji">
							Fiji
						</option>
						<option value="Finland">
							Finland
						</option>
						<option value="France">
							France
						</option>
						<option value="French Polynesia">
							French Polynesia
						</option>
						<option value="Gabon">
							Gabon
						</option>
						<option value="The Gambia">
							The Gambia
						</option>
						<option value="Georgia">
							Georgia
						</option>
						<option value="Germany">
							Germany
						</option>
						<option value="Ghana">
							Ghana
						</option>
						<option value="Gibraltar">
							Gibraltar
						</option>
						<option value="Greece">
							Greece
						</option>
						<option value="Greenland">
							Greenland
						</option>
						<option value="Grenada">
							Grenada
						</option>
						<option value="Guadeloupe">
							Guadeloupe
						</option>
						<option value="Guam">
							Guam
						</option>
						<option value="Guatemala">
							Guatemala
						</option>
						<option value="Guernsey">
							Guernsey
						</option>
						<option value="Guinea">
							Guinea
						</option>
						<option value="Guinea-Bissau">
							Guinea-Bissau
						</option>
						<option value="Guyana">
							Guyana
						</option>
						<option value="Haiti">
							Haiti
						</option>
						<option value="Honduras">
							Honduras
						</option>
						<option value="Hong Kong">
							Hong Kong
						</option>
						<option value="Hungary">
							Hungary
						</option>
						<option value="Iceland">
							Iceland
						</option>
						<option value="India">
							India
						</option>
						<option value="Indonesia">
							Indonesia
						</option>
						<option value="Iran">
							Iran
						</option>
						<option value="Iraq">
							Iraq
						</option>
						<option value="Ireland">
							Ireland
						</option>
						<option value="Israel">
							Israel
						</option>
						<option value="Italy">
							Italy
						</option>
						<option value="Jamaica">
							Jamaica
						</option>
						<option value="Japan">
							Japan
						</option>
						<option value="Jersey">
							Jersey
						</option>
						<option value="Jordan">
							Jordan
						</option>
						<option value="Kazakhstan">
							Kazakhstan
						</option>
						<option value="Kenya">
							Kenya
						</option>
						<option value="Kiribati">
							Kiribati
						</option>
						<option value="North Korea">
							North Korea
						</option>
						<option value="South Korea">
							South Korea
						</option>
						<option value="Kosovo">
							Kosovo
						</option>
						<option value="Kuwait">
							Kuwait
						</option>
						<option value="Kyrgyzstan">
							Kyrgyzstan
						</option>
						<option value="Laos">
							Laos
						</option>
						<option value="Latvia">
							Latvia
						</option>
						<option value="Lebanon">
							Lebanon
						</option>
						<option value="Lesotho">
							Lesotho
						</option>
						<option value="Liberia">
							Liberia
						</option>
						<option value="Libya">
							Libya
						</option>
						<option value="Liechtenstein">
							Liechtenstein
						</option>
						<option value="Lithuania">
							Lithuania
						</option>
						<option value="Luxembourg">
							Luxembourg
						</option>
						<option value="Macau">
							Macau
						</option>
						<option value="Macedonia">
							Macedonia
						</option>
						<option value="Madagascar">
							Madagascar
						</option>
						<option value="Malawi">
							Malawi
						</option>
						<option value="Malaysia">
							Malaysia
						</option>
						<option value="Maldives">
							Maldives
						</option>
						<option value="Mali">
							Mali
						</option>
						<option value="Malta">
							Malta
						</option>
						<option value="Marshall Islands">
							Marshall Islands
						</option>
						<option value="Martinique">
							Martinique
						</option>
						<option value="Mauritania">
							Mauritania
						</option>
						<option value="Mauritius">
							Mauritius
						</option>
						<option value="Mayotte">
							Mayotte
						</option>
						<option value="Mexico">
							Mexico
						</option>
						<option value="Micronesia">
							Micronesia
						</option>
						<option value="Moldova">
							Moldova
						</option>
						<option value="Monaco">
							Monaco
						</option>
						<option value="Mongolia">
							Mongolia
						</option>
						<option value="Montenegro">
							Montenegro
						</option>
						<option value="Montserrat">
							Montserrat
						</option>
						<option value="Morocco">
							Morocco
						</option>
						<option value="Mozambique">
							Mozambique
						</option>
						<option value="Myanmar">
							Myanmar
						</option>
						<option value="Nagorno-Karabakh">
							Nagorno-Karabakh
						</option>
						<option value="Namibia">
							Namibia
						</option>
						<option value="Nauru">
							Nauru
						</option>
						<option value="Nepal">
							Nepal
						</option>
						<option value="Netherlands">
							Netherlands
						</option>
						<option value="Netherlands Antilles">
							Netherlands Antilles
						</option>
						<option value="New Caledonia">
							New Caledonia
						</option>
						<option value="New Zealand">
							New Zealand
						</option>
						<option value="Nicaragua">
							Nicaragua
						</option>
						<option value="Niger">
							Niger
						</option>
						<option value="Nigeria">
							Nigeria
						</option>
						<option value="Niue">
							Niue
						</option>
						<option value="Norfolk Island">
							Norfolk Island
						</option>
						<option value="Turkish Republic of Northern Cyprus">
							Turkish Republic of Northern Cyprus
						</option>
						<option value="Northern Mariana">
							Northern Mariana
						</option>
						<option value="Norway">
							Norway
						</option>
						<option value="Oman">
							Oman
						</option>
						<option value="Pakistan">
							Pakistan
						</option>
						<option value="Palau">
							Palau
						</option>
						<option value="Palestine">
							Palestine
						</option>
						<option value="Panama">
							Panama
						</option>
						<option value="Papua New Guinea">
							Papua New Guinea
						</option>
						<option value="Paraguay">
							Paraguay
						</option>
						<option value="Peru">
							Peru
						</option>
						<option value="Philippines">
							Philippines
						</option>
						<option value="Pitcairn Islands">
							Pitcairn Islands
						</option>
						<option value="Poland">
							Poland
						</option>
						<option value="Portugal">
							Portugal
						</option>
						<option value="Puerto Rico">
							Puerto Rico
						</option>
						<option value="Qatar">
							Qatar
						</option>
						<option value="Romania">
							Romania
						</option>
						<option value="Russia">
							Russia
						</option>
						<option value="Rwanda">
							Rwanda
						</option>
						<option value="Saint Barthelemy">
							Saint Barthelemy
						</option>
						<option value="Saint Helena">
							Saint Helena
						</option>
						<option value="Saint Kitts and Nevis">
							Saint Kitts and Nevis
						</option>
						<option value="Saint Lucia">
							Saint Lucia
						</option>
						<option value="Saint Martin">
							Saint Martin
						</option>
						<option value="Saint Pierre and Miquelon">
							Saint Pierre and Miquelon
						</option>
						<option value="Saint Vincent and the Grenadines">
							Saint Vincent and the Grenadines
						</option>
						<option value="Samoa">
							Samoa
						</option>
						<option value="San Marino">
							San Marino
						</option>
						<option value="Sao Tome and Principe">
							Sao Tome and Principe
						</option>
						<option value="Saudi Arabia">
							Saudi Arabia
						</option>
						<option value="Senegal">
							Senegal
						</option>
						<option value="Serbia">
							Serbia
						</option>
						<option value="Seychelles">
							Seychelles
						</option>
						<option value="Sierra Leone">
							Sierra Leone
						</option>
						<option value="Singapore">
							Singapore
						</option>
						<option value="Slovakia">
							Slovakia
						</option>
						<option value="Slovenia">
							Slovenia
						</option>
						<option value="Solomon Islands">
							Solomon Islands
						</option>
						<option value="Somalia">
							Somalia
						</option>
						<option value="Somaliland">
							Somaliland
						</option>
						<option value="South Africa">
							South Africa
						</option>
						<option value="South Ossetia">
							South Ossetia
						</option>
						<option value="Spain">
							Spain
						</option>
						<option value="Sri Lanka">
							Sri Lanka
						</option>
						<option value="Sudan">
							Sudan
						</option>
						<option value="Suriname">
							Suriname
						</option>
						<option value="Svalbard">
							Svalbard
						</option>
						<option value="Swaziland">
							Swaziland
						</option>
						<option value="Sweden">
							Sweden
						</option>
						<option value="Switzerland">
							Switzerland
						</option>
						<option value="Syria">
							Syria
						</option>
						<option value="Taiwan">
							Taiwan
						</option>
						<option value="Tajikistan">
							Tajikistan
						</option>
						<option value="Tanzania">
							Tanzania
						</option>
						<option value="Thailand">
							Thailand
						</option>
						<option value="Timor-Leste">
							Timor-Leste
						</option>
						<option value="Togo">
							Togo
						</option>
						<option value="Tokelau">
							Tokelau
						</option>
						<option value="Tonga">
							Tonga
						</option>
						<option value="Transnistria Pridnestrovie">
							Transnistria Pridnestrovie
						</option>
						<option value="Trinidad and Tobago">
							Trinidad and Tobago
						</option>
						<option value="Tristan da Cunha">
							Tristan da Cunha
						</option>
						<option value="Tunisia">
							Tunisia
						</option>
						<option value="Turkey">
							Turkey
						</option>
						<option value="Turkmenistan">
							Turkmenistan
						</option>
						<option value="Turks and Caicos Islands">
							Turks and Caicos Islands
						</option>
						<option value="Tuvalu">
							Tuvalu
						</option>
						<option value="Uganda">
							Uganda
						</option>
						<option value="Ukraine">
							Ukraine
						</option>
						<option value="United Arab Emirates">
							United Arab Emirates
						</option>
						<option value="United Kingdom">
							United Kingdom
						</option>
						<option value="United States">
							United States
						</option>
						<option value="Uruguay">
							Uruguay
						</option>
						<option value="Uzbekistan">
							Uzbekistan
						</option>
						<option value="Vanuatu">
							Vanuatu
						</option>
						<option value="Vatican City">
							Vatican City
						</option>
						<option value="Venezuela">
							Venezuela
						</option>
						<option value="Vietnam">
							Vietnam
						</option>
						<option value="British Virgin Islands">
							British Virgin Islands
						</option>
						<option value="Isle of Man">
							Isle of Man
						</option>
						<option value="US Virgin Islands">
							US Virgin Islands
						</option>
						<option value="Wallis and Futuna">
							Wallis and Futuna
						</option>
						<option value="Western Sahara">
							Western Sahara
						</option>
						<option value="Yemen">
							Yemen
						</option>
						<option value="Zambia">
							Zambia
						</option>
						<option value="Zimbabwe">
							Zimbabwe
						</option>
						<option value="other">
							Other
						</option>
					</select>
				</div>
			</div>
		<div class="row" >
			<div class="col-xs-12 col-md-12"> 
				<span class="grey-text text-darken-1">Total <?php echo $ttlclgcount=substr_count(implode("",array_keys($jsonArray)),"ex_collegeother")+1; if($ttlclgcount==1) echo " college"; else echo " colleges"; ?>  added at present</span>
			</div>
		</div>
		<div class="row" id="addAnotherCollege">
			<div class="col-xs-12 col-md-4"> 
				<span class="grey-text text-darken-1">[ Add another college ]</span>
			</div>
			<div class="col-xs-12 col-md-8"></div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" id="editProfileLink" class="btn btn-default">Save</button>
		<a href="<?php echo base_url()."profile"; ?>" role="button" class=" modal-action modal-close btn btn-default">Close</a>
	</div>
</div></form>

<?php  ?>