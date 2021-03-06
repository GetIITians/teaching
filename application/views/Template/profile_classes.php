<h4 class="teal-text text-darken-1">Upcoming Classes</h4>
<div class="row" >
	<div class="col-xs-12 table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Student</th>
					<th>Class</th>
					<th>Subject</th>
					<th>Topic</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($newslots as $i => $row) { ?>
				<tr <?php if($row["bookclassrqst"]==1): ?> id="bg-rqst" <?php endif; ?>>
				<td><?php echo $row["studentname"] ?></td>
				<td><?php echo $row["classname"] ?></td>
				<td><?php echo $row["subjectname"] ?></td>
				<td><?php echo $row["topicname"] ?></td>
				<td><?php echo $row["startdate_disp"]; ?></td>
				<td><?php echo $row["starttime_disp"]; ?></td>
				<td><?php echo $row["duration_disp"]; ?> hrs</td>
				<td>
					<?php if($row["confirm"]==0) { ?>	
					<a class="btn waves-effect waves-light"  onclick="button.sendreq_v2(this)" data-starttime="<?php echo $row["starttime"]; ?>" data-tid="<?php echo $row["tid"]; ?>" data-sid="<?php echo $row["sid"]; ?>" data-action='confirm_class' data-res='success.push("Class confirmed");div.reload($("#classes")[0]);' >Confirm</a>
					<a class="btn red accent-2 waves-effect waves-light"  onclick="button.sendreq_v2(this)" data-classcharge="<?php echo $row["classcharge"]; ?>" data-starttime="<?php echo $row["starttime"]; ?>" data-tid="<?php echo $row["tid"]; ?>" data-sid="<?php echo $row["sid"]; ?>" data-action='cancel_class' data-res='success.push("Class canceled");div.reload($("#classes")[0]);' >Cancel</a>					
					<?php } else { ?>
					<a target="_blank" href="<?php echo Funs::wiziqurl($row); ?>" ><button class="btn waves-effect waves-light" >Start Class</button></a>						 
					<?php } ?>
				</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<h4 class="teal-text text-darken-1">Previous Classes</h4>
<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
				<th>Student</th>
				<th>Class</th>
				<th>Subject</th>
				<th>Topic</th>
				<th>Date</th>
				<th>Time</th>
				<th>Duration</th>
				<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($oldslots as $i => $row) { ?>
				<tr>
				<td><?php echo $row["studentname"] ?></td>
				<td><?php echo $row["classname"] ?></td>
				<td><?php echo $row["subjectname"] ?></td>
				<td><?php echo $row["topicname"] ?></td>
				<td><?php echo $row["startdate_disp"]; ?></td>
				<td><?php echo $row["starttime_disp"]; ?></td>
				<td><?php echo $row["duration_disp"]; ?> hrs</td>
				<td><a target="_blank" href="<?php echo Funs::wiziqurl($row); ?>" ><button class="btn waves-effect waves-light" >Start Class</button></a></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>