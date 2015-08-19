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
		<?php if(User::islogin()) : ?>
		<div>
			Resume :
			<span class="grey-text text-darken-1">
				<a href="<?php echo $ejsoninfo["resume"] ; ?>">Click to see</a>
			</span>
		</div>
		<?php endif; ?>
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
	</div>
</div>