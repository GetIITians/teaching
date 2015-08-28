<div class="row calendarpopup">
	<div id="disppopupslots" >
	<?php
		$slotid=1;
		hidinp("popuptime","",array("id"=>"popuptimecheckbox"));
		$divclass="";
		foreach($timeslots as $gid=>$group){
		    ?>
			<div class="col s12 l4" style='padding:0px;margin:0px;'>
				<?php
				if(!$isguest){
					if($gid==0){
						load_view("Template/cutecheckbox.php",array("id"=>"popselall","label"=>"Select All Slots","divattr"=>array("class"=>$divclass),"onchange"=>'selectallmatched(this,$(".popuptimeslots"));ms.f2();'));
					}
					else{
						load_view("Template/cutecheckbox.php",array("id"=>"dummy","divattr"=>array("class"=>$divclass,"style"=>"visibility:hidden;")));
					}
				}
				foreach($group as $i=>$val){
					$inpattr=array("class"=>"popuptimeslots", "value"=>$slotid);
					if($dayslots[$slotid]["cansee"]){
						if($dayslots[$slotid]["blocked"]){
							$inpattr["disabled"]="";
						} else if($dayslots[$slotid]["checked"]) {
							$inpattr["checked"]="";
						}
						if($isguest){
							ocloset("div",$val);
						}
						else{
							load_view("Template/cutecheckbox.php",array("id"=>"popupts_".$gid."_".$i,"label"=>$val,"inpattr"=>$inpattr, "divattr"=>array("class"=>$divclass,"style"=>($dayslots[$slotid]["cansee"]?"":"display:none") ),"onchange"=>"ms.f2();"));
						}
					}
					$slotid++;
				}
				?>
			</div>
			<?php
		}
	?>
	</div>
	<div class='clear' ></div>

	<?php if(!$isguest) : ?>
		<?php if($isself) : ?>
			<button class='btn btn-default' type="button" data-datets="<?php echo $datets; ?>" data-eparams="{'slots':$('#popuptimecheckbox').val()}" data-action="teacherModifySlots" onclick="ms.f2();button.sendreq_v2(this);" data-waittext="Saving.." data-res='ms.calreq($("#calhomebutton")[0]);success.push("Timeslot Saved ! ");mohit.popup_close("timeslot");' >Save</button>
		<?php elseif($isstudent) : ?>
			<button class='btn btn-default' type="button" data-demo="<?php echo $_SESSION['isdonedemo']; ?>" data-datets="<?php echo $datets; ?>" data-eparams="{'slots':$('#popuptimecheckbox').val()}" data-tid="<?php echo $tid; ?>" data-action="studentBookSlots" onclick="ms.studentbookslot(this);" data-waittext="Booking.." data-res='Materialize.toast("Slots Booked ! ", 4000);mohit.popup_close("timeslot");' >Book</button>
		<?php endif; ?>
	<?php endif; ?>
</div>