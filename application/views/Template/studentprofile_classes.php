<h4 class="teal-text text-darken-1">Upcoming Classes</h4>
<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Teacher</th>
					<th>Grade</th>
					<th>Subject</th>
					<th>Topic</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($newslots as $i => $row) { 
				?>
				<tr>
					<td><?php echo $row["teachername"] ?></td>
					<td><?php echo $row["classname"] ?></td>
					<td><?php echo $row["subjectname"] ?></td>
					<td><?php echo $row["topicname"] ?></td>
					<td><?php echo $row["startdate_disp"]; ?></td>
					<td><?php echo $row["starttime_disp"]; ?></td>
					<td><?php echo $row["duration_disp"]; ?> hrs</td>
					<td><a target="_blank" href="<?php echo Funs::wiziqurl($row); ?>" ><button class="btn waves-effect waves-light" >Start Class</button></a></td>


				</tr>
				<?php
					}
				?>
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
					<th>Teacher</th>
					<th>Grade</th>
					<th>Subject</th>
					<th>Topic</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($oldslots as $i => $row) {
				?>
				<tr>
					<td><?php echo $row["teachername"] ?></td>
					<td><?php echo $row["classname"] ?></td>
					<td><?php echo $row["subjectname"] ?></td>
					<td><?php echo $row["topicname"] ?></td>
					<td><?php echo $row["startdate_disp"]; ?></td>
					<td><?php echo $row["starttime_disp"]; ?></td>
					<td><?php echo $row["duration_disp"]; ?> hrs</td>
					<td><a target="_blank" href="<?php echo Funs::wiziqurl($row); ?>" ><button class="btn waves-effect waves-light" >Start Class</button></a></td>
					<?php
						if($row["feedback"] == "") {
					?>
					<td><a><button class="btn waves-effect waves-light" onclick="reviewbtnobj = this; ms.openreviewform(this,<?php echo $row["tid"]; ?>, <?php echo $row["starttime"]; ?> );" >Review</button></a></td>
					<?php
						} else {
					?>
					<td>Reviewed!</td>
					<?php
						}
					?>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>