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
		<a class="modal-trigger " href="#editProfile">editProfile</a>
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
		<?php  if((User::isloginas('t')|| User::isloginas('a')) && !empty($ejsoninfo["resume"])) : ?>
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
		<?php endif;  ?>
	
	</div>
</div>

<?php
fb($langArray,'$inp',FirePHP::LOG);
?>


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
							<input id="math" type="checkbox" value="1" name="1" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Mathematics', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="math">
								Mathematics
							</label>
						</div>
						<div class="col-xs-6">
							<input id="physics" type="checkbox" value="2" name="2" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Physics', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="physics">
								Physics
							</label>
						</div>
						<div class="col-xs-6">
							<input id="chemistry" type="checkbox" value="3" name="3" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Chemistry', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="chemistry">
								Chemistry
							</label>
						</div>
						<div class="col-xs-6">
							<input id="biology" type="checkbox" value="4" name="4" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Biology', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="biology">
								Biology
							</label>
						</div>
						<div class="col-xs-6">
							<input id="science" type="checkbox" value="5" name="5" data-condition="checkbox" data-group="sub" <?php $key = Funs::recursive_array_search('Science(6-10)', $subArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
							<label for="science">
								Science (6-10)
							</label>
						</div>
						<div class="col-xs-6">
							<input id="subject_other" type="checkbox" value="6" name="sub6" data-condition="checkbox" data-group="sub" onchange="specifySubOther()" />
							<label for="subject_other">
								Other
							</label>
						</div>
					</div>
				</div>
			</div>
	<div class="row" id="specify_sub_other">
		<div class="col-xs-12 col-md-8 col-md-offset-4">
			<input placeholder="Please specify if other" type="text" class="validate" name="subother" />
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
				<input id="6to8" type="checkbox" value="1" name="1" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('1', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?>  />
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
				<input id="9to10" type="checkbox" value="2" name="2" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('2', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
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
				<input id="11to12" type="checkbox" value="3" name="3" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('3', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
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
				<input id="iitjee" type="checkbox" value="4" name="4" data-condition="checkbox" data-group="grade" <?php $key = Funs::recursive_array_search('4', $gradeArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
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
			<input id="lang1" type="checkbox" value="1" name="1" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('1', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang1">
				English
			</label>
		</div>
		<div>
			<input id="lang2" type="checkbox" value="2" name="2" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('2', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang2">
				Hindi
			</label>
		</div>
		<div>
			<input id="lang3" type="checkbox" value="3" name="3" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('3', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang3">
				Assamese
			</label>
		</div>
		<div>
			<input id="lang5" type="checkbox" value="4" name="4" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('4', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang5">
				Sanskrit
			</label>
		</div>
		<div>
			<input id="lang6" type="checkbox" value="5" name="5" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('5', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang6">
				Bengali
			</label>
		</div>
		<div>
			<input id="lang7" type="checkbox" value="6" name="6" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('6', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang7">
				Mayalayam
			</label>
		</div>
		<div>
			<input id="lang8" type="checkbox" value="7" name="7" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('7', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang8">
				Tamil
			</label>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div>
			<input id="lang9" type="checkbox" value="8" name="8" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('8', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang9">
				Gujarati
			</label>
		</div>
		<div>
			<input id="lang10" type="checkbox" value="9" name="9" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('9', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang10">
				Marathi
			</label>
		</div>
		<div>
			<input id="lang11" type="checkbox" value="10" name="10" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('10', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang11">
				Telugu
			</label>
		</div>
		<div>
			<input id="lang12" type="checkbox" value="11" name="11" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('11', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang12">
				Oriya
			</label>
		</div>
		<div>
			<input id="lang13" type="checkbox" value="12" name="12" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('12', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang13">
				Urdu
			</label>
		</div>
		<div>
			<input id="lang14" type="checkbox" value="13" name="13" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('13', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
			<label for="lang14">
				Kannada
			</label>
		</div>
		<div>
			<input id="lang15" type="checkbox" value="14" name="14" data-condition="checkbox" data-group="lang" <?php $key = Funs::recursive_array_search('14', $langArray);echo ($key != false || $key === 0) ? 'checked' : ''; ?> />
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
			<div class="col-xs-12 col-md-8">
				<input type="text" class="form-control" id="Name" value="<?php echo $firstName.' '.$lastName ?>" placeholder="Full Name">
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
					<div class="col-md-4">
						<input type="text" value="<?php echo date('d',$aboutinfo['dob']); ?>" class="form-control" id="day" placeholder="day">
					</div>
					<div class="col-md-4">
						<input type="text" value="<?php echo date('m',$aboutinfo['dob']); ?>" class="form-control" id="month" placeholder="month">
					</div>
					<div class="col-md-4">
						<input type="text" value="<?php echo date('Y',$aboutinfo['dob']); ?>" class="form-control" id="year" placeholder="year">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="<?php echo HOST.'profile' ?>" class="" id="editProfileLink">Agree</a>
	</div>
</div>