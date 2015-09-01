<?php

//echo "<pre>";print_r($reviews);echo "</pre>";

?>

<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Student</th>
					<th>Feedback</th>
					<th>Teacher</th>
					<th></th>
					<th></th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($reviews as $review) : ?>
				<tr>
				<td><?php echo $review["student"] ?></td>
				<td><?php echo $review["feedback"] ?></td>
				<td><?php echo $review["teacher"] ?></td>
				<td>
					<a href='<?php echo BASE."profile/".$review["tid"] ?>'>
						<?php echo $review["profilepic"] ?>
					</a>
				</td>
				<td>
					<a target="_blank" href="" onclick="adminPage.approve(this);return false;" tid="<?php echo $review["tid"] ?>" starttime="<?php echo $review["starttime"] ?>">
						<button class="btn waves-effect waves-light" >
							Approve
						</button>
					</a>
				</td>
				<td></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>