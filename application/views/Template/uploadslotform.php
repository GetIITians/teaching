<form method="post" onsubmit="return form.valid.action(this);" action="<?php echo BASE."profile/".$tid."/2"; ?>" >
	<?php $slotid=1; ?>
	<div id="divtimeslotcheckbox" >
	<?php
		hidinp("time","",array("data-condition"=>"simple","data-unfilled"=>"Atleast one timeslot"));
		$divclass="";
		foreach($timeslots as $gid=>$group){
	?>
			<div class="col s12 l3" style='padding:0px;margin:0px;'>
				<?php
					if($gid==0)
						load_view("Template/cutecheckbox.php",array("id"=>"allts_repeat_upload","label"=>"Select All Slots","divattr"=>array("class"=>$divclass),"onchange"=>'selectallmatched(this,$(".alltimeslots"));ms.f1();'));
					else
						load_view("Template/cutecheckbox.php",array("id"=>"dummy","divattr"=>array("class"=>$divclass,"style"=>"visibility:hidden;")));
					foreach($group as $i=>$val){
						load_view("Template/cutecheckbox.php",array("id"=>"timeslot_".$gid."_".$i,"label"=>$val,"inpattr"=>array("class"=>"alltimeslots", "value"=>$slotid ),"divattr"=>array("class"=>$divclass),"onchange"=>"ms.f1();"));
				?>
				<?php
						$slotid++;
					}
				?>
			</div>
	<?php
		}
	?>
	</div>
	<div class="col s12 l3" style='margin:0px;padding:0px;'>
		<div id='divdayscheckbox' >
		<?php
			hidinp("days","",array("data-condition"=>"simple","data-unfilled"=>"Atleast one day"));
			load_view("Template/cutecheckbox.php",array("id"=>"allday_repeat_upload","label"=>"Select All Days","divattr"=>array("class"=>$divclass),"onchange"=>'selectallmatched(this,$(".alldayscheckbox"));ms.cbautofill("divdayscheckbox");'));
			foreach($weekdays as $i=>$day){
				load_view("Template/cutecheckbox.php",array("id"=>"days_".$i,"label"=>$day,"divattr"=>array("class"=>$divclass),"inpattr"=>array("class"=>"alldayscheckbox","value"=>$i+1),"onchange"=>'ms.cbautofill("divdayscheckbox");' ));
			}
		?>
		</div>
		<input type="date" id="startdate" class="datepicker" name="startdate" data-condition="simple" placeholder="Choose Start Date" data-unfilled='Starting Date' ><br>
		<input type="date" id="enddate" class="datepicker" name="enddate" data-condition="simple" placeholder="Choose End Date" data-unfilled="Ending Date" ><br>

		<button class="btn waves-effect waves-light" type="submit" name="add" value="add" >Add
			<i class="mdi-content-send right"></i> 
		</button>
		<br><br>
		<button class="btn waves-effect waves-light" type="submit" name="delete" value="delete" >Delete
			<i class="mdi-content-send right"></i>
		</button>
	</div>
</form>