<div class="row">
			<div class="col-sm-3">
				<h4>Personal Details:</h4>
				 	<div class="row">
					 	<div class="col-sm-5">
					 		Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['name']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Mobile No :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['phone']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Email-Id :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['email']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Created :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php if(!empty($caller_info['created_at'])) echo date("d-M-Y",$caller_info['created_at']); ?>
					 	</div>
					</div>
			</div>
			<div class="col-sm-3">
			 	<h4>Academic Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Class :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['class']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Subject :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['subject']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Grade :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['grade']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Board :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['board']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Tution Type :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['tution_type']; ?>
					 	</div>
					</div>
			</div>
			<div class="col-sm-3">
			 	<h4>Teacher Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['teacher']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Demo :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $teaching_info['demo']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Fees :
					 	</div>
					 	<div class="col-sm-7">
					 		Rs. <?php echo $teaching_info['fees']; ?>
					 	</div>
					</div>

			</div>
			<div class="col-sm-3">
			 	<h4>Caller Details:</h4>
			 		<div class="row">
					 	<div class="col-sm-5">
					 		Caller Name :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['caller_name']; ?>
					 	</div>
					</div>
					<div class="row">
					 	<div class="col-sm-5">
					 		Relation :
					 	</div>
					 	<div class="col-sm-7">
					 		<?php echo $caller_info['caller_rel']; ?>
					 	</div>
					</div>
			</div>
		</div>