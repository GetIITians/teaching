<div id="adminReviews">
	<div class="row">
		<div class="col-sm-2 hidden-xs">
			Student
		</div>
		<div class="col-sm-3 col-xs-4">
			Feedback
		</div>
		<div class="col-sm-1 col-xs-2">
			Date
		</div>
		<div class="col-sm-2 hidden-xs">
			Teacher
		</div>
		<div class="col-sm-1 hidden-xs">
			
		</div>
		<div class="col-sm-2 col-xs-6">
			
		</div>
		<div class="col-sm-1 hidden-xs">
			Status
		</div>
	</div>
	<?php foreach($reviews as $review) : ?>
	<div class="row">
		<div class="col-sm-2 hidden-xs">
			<?php echo $review["student"] ?>
		</div>
		<div class="col-sm-3 col-xs-4">
			<?php echo $review["feedback"] ?>
		</div>
		<div class="col-sm-1 col-xs-2 date">
			<?php echo date('j F, Y',$review["starttime"]); ?>
		</div>
		<div class="col-sm-2 hidden-xs">
			<?php echo ucwords($review["teacher"]) ?>
		</div>
		<div class="col-sm-1 img hidden-xs">
			<a href='<?php echo BASE."profile/".$review["tid"] ?>'>
				<img class="img-responsive center-block" src="<?php echo BASE.$review["profilepic"] ?>">
			</a>
		</div>
		<div class="col-sm-2 col-xs-4">
			<?php if ($review["feedbackStatus"] == "yes") : ?>
				<a role="button" class="btn btn-default disabled center-block" >Approved</a>
			<?php else : ?>
				<a role="button" class="btn btn-default center-block" onclick="adminPage.approve(event,this);" tid="<?php echo $review["tid"] ?>" starttime="<?php echo $review["starttime"] ?>">Approve</a>
			<?php endif; ?>
		</div>
		<div class="col-sm-1 col-xs-2">
			<?php if ($review["feedbackStatus"] == "yes") : ?>
				<i class="material-icons">done</i>
			<?php else : ?>
				<i class="material-icons">clear</i>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>