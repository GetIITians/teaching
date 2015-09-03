<?php
$trows = add(
				array(array("Name", "Email", "Joined", "Phone", "Action", "Add money"))
				,
				map(
					$allusers["teachers"], function ($row) {
						return Fun::get_key_values(Fun::getflds(array("name", "email", "create_time", "phone"), $row));
					}
				)
			);
$srows = add(array(array("Name", "Email", "Joined", "Phone", "Action", "Add money")), map( $allusers["students"], function ($row) { 
	return Fun::get_key_values(Fun::getflds(array("name", "email", "create_time", "phone"), $row)); 
}));
$addmoney = function($uid) {
?>
	<form onsubmit="form.req(this);return false;" data-action='addmoney' data-res='success.push("Added Successfully");div.reload($("#account")[0]);' >
		<?php
			hidinp("uid", $uid);
		?>
		<div class="input-field col s12 l3">
			<input type="text" name="money" data-condition='simple' placeholder="Add money in account" >
		</div>
		<button type="submit" class="btn blue waves-effect waves-light" >Add</button>
	</form>
<?php
};

$tfunc = function($r, $c) use($addmoney, $allusers) {
	if($c == 4 && $r > 0 ) {
		$row = $allusers["teachers"][$r-1];
		if($row["isselected"] != "a") {
		?>
		<button type="button" onclick='button.sendreq_v2(this);' data-isselected='a' data-tid="<?php echo $row["id"]; ?>" data-action="acceptrej" class="btn blue waves-effect waves-light" data-res='div.reload($("#users")[0]);' >Accept</button>
		<?php
		}
		if($row["isselected"] != "r" ) {
		?>
		<button type="button" class="btn blue waves-effect waves-light" onclick='button.sendreq_v2(this);' data-isselected='r' data-tid="<?php echo $row["id"]; ?>" data-action="acceptrej" data-res='div.reload($("#users")[0]);' >Reject</button>
		<?php
		} ?>
<a data-deleteid="<?php echo $row["id"]; ?>" data-action='delteachers' onclick='button.sendreq_v2(this);' class="btn waves-effect waves-light red darken-1" data-res='success.push("Deleted");div.reload($("#users")[0])' >
			Delete
		</a><?php		
		return true;
	} else if ($c == 5 && $r > 0) {
		$addmoney( $allusers["teachers"][$r-1]["id"] );
	} else if ($c == 0 && $r > 0) {
		?>
			<a href='<?php echo BASE."profile/".$allusers["teachers"][$r-1]["id"]; ?>' ><?php echo $allusers["teachers"][$r-1]["name"]; ?></a>
		<?php
		return true;
	}
	return null;
};
$sfunc = function($r, $c) use ($addmoney, $allusers) {
	if($c == 4 && $r > 0 ) {
		$row = $allusers["students"][$r-1];
	?>
<a data-deleteid="<?php echo $row["id"]; ?>" data-action='delstudents' onclick='button.sendreq_v2(this);' class="btn waves-effect waves-light red darken-1" data-res='success.push("Deleted");div.reload($("#users")[0])' >
			Delete
		</a>
	<?php	
	} else
	if($c == 5 && $r > 0 ) {
		$addmoney( $allusers["students"][$r-1]["id"] );
		return true;
	}
	return null;
};

?>

<br><br>
<div class="row" >
	<div class="col s12">
		<h5 class="teal-text text-darken-1">Teachers</h5>
	</div>
</div>
<div class="row">
	<div class="col s12">
<?php
load_view("Template/table.php", array("rows" => $trows, "func" => $tfunc));
?>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<h5 class="teal-text text-darken-1">Students</h5>
	</div>
</div>
<div class="row" >
	<div class="col s12">
<?php
load_view("Template/table.php", array("rows" => $srows, "func" => $sfunc));
?>
	</div>
</div>
