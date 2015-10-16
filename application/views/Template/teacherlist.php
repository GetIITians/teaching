<?php
if($isrelv==1) { echo "Relevent Results"; }
//fb($qresult,'row',FirePHP::LOG);

$searchPageRows = 0;
foreach($qresult as $row) {

/*------------------------------
  Processing for ratingBigBox
--------------------------------*/
//echo "<pre>";print_r($ratingBigBox);echo "</pre><br>";
$allRatings = [];
foreach ($ratingBigBox[0] as $bigBoxRating) {
	if ($bigBoxRating['teacher_id'] == $row['tid'])
		$allRatings[] = $bigBoxRating['rating'];
}

$arrangedRatings = ['5'=>0,'4'=>0,'3'=>0,'2'=>0,'1'=>0,];
foreach ($allRatings as $value) {
	switch ($value) {
		case 5:
			$arrangedRatings['5']++;
			break;
		case 4:
			$arrangedRatings['4']++;
			break;
		case 3:
			$arrangedRatings['3']++;
			break;
		case 2:
			$arrangedRatings['2']++;
			break;
		case 1:
			$arrangedRatings['1']++;
			break;
		default:
			break;
	}
}
$maxRating = max($arrangedRatings);
//echo "<pre>";print_r($arrangedRatings);echo "</pre><br>";

$allReviews = [];
foreach ($ratingBigBox[1] as $bigBoxReview) {
	if ($bigBoxReview['tid'] == $row['tid'] && $bigBoxReview['feedback'] != null){
		$allReviews[] = $bigBoxReview['feedback'];
	}
}
//echo "<pre>";print_r($allReviews);echo "</pre><br>";



/* --------------------------------- */





echo ($searchPageRows%4===0) ? '<div class="row">' : FALSE;
$searchPageRows++;
?>

<div class="col-md-3 col-xs-6">
	<div class="card teacherlistelm">
	<?php
		$joinus_data  = json_decode($row['jsoninfo']);
		$name   = convchars($row["name"]);
		$subject_list = implode(", ",myexplode(",", $row["subjectname"]));
		$fee_check  = $row["minprice"].rit(" - ".$row["maxprice"], $row["maxprice"]!=$row["minprice"]);
		if($fee_check != null)
		$fees   = $fee_check;
		else
		$fees   = convchars($joinus_data->{'minfees'});
		$age    =   date('Y')-date('Y', $row['dob']);
		$degree     = convert_degree($joinus_data->{'degree'});
	?>
		<div class="card-image waves-effect waves-block waves-light">
			<!-- <img class="activator" src="<?php // echo $row["profilepic"]; ?>"> -->
			<p class="grey-text text-darken-1"><?php echo $row["teachermoto"]; ?></p>
		</div>
		<div class="card-content">
			<p class="card-title activator"><?php echo $name; ?></p>
			<?php /*
			<p class="grey-text text-darken-2">
				Subjects
				<a class="tooltipped" data-placement="right" data-toggle="tooltip" title="<?php echo $subject_list; ?>">
					<i class="tiny material-icons">label</i>
				</a>
			</p>
			*/ ?>
			<p class="grey-text text-darken-2">Fees: <?php echo $fees; ?>/hr</p>
			<!--
			<p class="grey-text text-darken-2">
				Taught Time: <?php /* echo ($row['teachduration']==null?"None":($row['teachduration']/3600)." hr"); */ ?>
			</p>
			-->
			<p class="grey-text text-darken-2">
				<?php echo $degree." | IIT ".convchars($joinus_data->{'college'}); ?>
			</p>
			<?php if($row['rating_total']>0) : ?>
			<p class="grey-text text-darken-2 contentrating">
				Rating : <?php //echo round($row['rating'],2); ?>
				<?php
					for ($i=1; $i < 6; $i++)
					{
						if ($i<=ceil($row['rating']))
							echo "<span class='glyphicon glyphicon-star rated-star' aria-hidden='true'></span>";
						else
							echo "<span class='glyphicon glyphicon-star-empty rating-star' aria-hidden='true'></span>";
					}
				?>
			</p>
			<?php else: ?>
			<p class="grey-text text-darken-2">Rating : Not rated yet.</p>
			<?php endif; ?>
		</div>
		<div class="card-reveal">
			<p class="card-title">
				<?php
					if (isset($_SESSION['shortlist'])&&!empty($_SESSION['shortlist'])) {
						$profilelink = BASE."profile/".$row["tid"]."/5";
					} else {
						$profilelink = BASE."profile/".$row["tid"];
					}
				?>
				<a href="<?php echo $profilelink; ?>">
					<?php echo $name; ?>
				</a>
			</p>
			<p class="grey-text text-darken-2">
				Subjects
				<a class="tooltipped" data-placement="right" data-toggle="tooltip" title="<?php echo $subject_list; ?>">
					<i class="tiny material-icons">label</i>
				</a>
			</p>
			<p class="grey-text text-darken-1">Fees : <?php echo $fees; ?>/hr</p>
			<p class="grey-text text-darken-1">
				<?php echo $degree." | IIT ".convchars($joinus_data->{'college'}); ?>
			</p>
			<p class="grey-text text-darken-1">Experience : <?php echo (($row['teachingexp']==0)||($row['teachingexp']==1)?(($row['teachingexp']==0)?"None":$row['teachingexp'].' Year'):$row['teachingexp'].' Years'); ?> </p>
			<p class="grey-text text-darken-2">
				Languages
				<a class="tooltipped" data-placement="right" data-toggle="tooltip" title="<?php echo convert_lang($row['lang']); ?>">
					<i class="tiny material-icons">label</i>
				</a>
			</p>
			<?php if ($age > 0) : ?>
			<p class="grey-text text-darken-2">
				Age : <?php echo $age; ?>
			</p>
			<?php endif; ?>
			<p class="grey-text text-darken-2">
				Home Tution :
					<?php echo ($joinus_data->{'home'} == '1') ? ' Yes' : ' No'; ?>
			</p>
			<p class="grey-text text-darken-2">
				City : <?php echo $joinus_data->{'city'}; ?>
			</p>
			<p class="grey-text text-darken-2">
				<?php echo ($row['ttl_avlsolts']==null?"No timeslots available":"Available timeslots :".($row['ttl_avlsolts']/2)." hr"); ?>
			</p>
			<p class="lastp">
				<?php if(!$row["isdonedemo"]) : ?>
				<a href="<?php pit(BASE."profile/".$row["tid"]."/"."5", User::islogin(), BASE."login"); ?>" >
					<button type="button" class="btn waves-effect waves-light btn-small" >1 Hour Trial Class</button>
				</a>
				<?php endif; ?>
				<!--
				<span class="activator"><i class="material-icons right">toc</i></span>
				-->
			</p>
			<!-- <div class="divider"></div> -->
<!--
	**************************
	Rating system starts below 
	**************************
-->
			<div class="rating" data-tid="<?php echo convchars($row['tid']); ?>">
			Rating&nbsp;&nbsp;
				<?php if($user = User::loginId()) : ?>
				<?php
					$prev_rating = 0;
					$rating_id = NULL;
					foreach ($rating as $value)
					{
						if (intval($row['tid']) == $value['teacher_id'])
						{
							$prev_rating = $value['rating'];
							$rating_id = $value['id'];
						}
					}
				?>
				<div class="rating-system" data-uid="<?php echo convchars($user); ?>" previousRating="<?php echo $prev_rating; ?>" ratingId="<?php echo $rating_id; ?>">
				<?php
					if ($prev_rating !== 0) {
						for ($i=1; $i < 6; $i++)
						{
							if ($i<=$prev_rating)
								echo "<span class='glyphicon glyphicon-star personal-rated-star' aria-hidden='true' data-number='".$i."'></span>";
							else
								echo "<span class='glyphicon glyphicon-star-empty rating-star' aria-hidden='true' data-number='".$i."'></span>";
						}
					} else {
						for ($i=1; $i < 6; $i++)
						{
							if ($i<=round($row['rating'],2))
								echo "<span class='glyphicon glyphicon-star rated-star' aria-hidden='true' data-number='".$i."'></span>";
							else
								echo "<span class='glyphicon glyphicon-star-empty rating-star' aria-hidden='true' data-number='".$i."'></span>";
						}
					}
					
				?>
				</div>
				<?php endif; ?>
				<div class="rating-value" count="<?php echo $row['rating_total']; ?>" value="<?php echo round($row['rating'],2); ?>">
					<?php if($row['rating_total']>0) : ?>
					<p>
						<?php echo round($row['rating'],2)."/5"; ?>
						<span>
							<?php if($row['rating_total'] == 1) : ?>
								(<?php echo round($row['rating_total'],2); ?> rating)
							<?php else : ?>
								(<?php echo round($row['rating_total'],2); ?> ratings)
							<?php endif; ?>
						</span>
					</p>
					<?php else: ?>
						Not rated yet.
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if($row['rating'] > 0) : ?>
	<div id="ratingBigBox" class="col-md-4 hidden-xs">
		<div class="row arrow">
			<div class="col-md-3">
				<h4>RATING</h4>
				<h2><?php echo round($row['rating'],1); ?></h2>
			</div>
			<div class="col-md-9">
				<?php 
				foreach ($arrangedRatings as $key => $value)
				{
				$percent = ($value/$maxRating)*100;
				echo "<div class=\"row\">";
					echo "<div class=\"detail col-xs-3\">";
						echo "<h6>".$key." Star</h6>";
					echo "</div>";
					echo "<div class=\"detail col-xs-8\">";
						echo "<div class=\"progress\">
							<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"".$percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$percent."%;\">
								<span class=\"sr-only\">".$percent."% Complete</span>
							</div>
						</div>";
					echo "</div>";
					echo "<div class=\"detail col-xs-1\">";
					if ($value != 0)
					{
						echo "<h6>&nbsp;&nbsp;".$value."</h6>";
					}
					echo "</div>";
				echo "</div>";
				}
				?>
			</div>
			<?php if(!empty($allReviews)) : ?>
			<div class="col-md-12">
				<hr class="underlined">
				<h4>REVIEWS</h4>
				<?php
				foreach ($allReviews as $feedback)
				{
					echo "<blockquote>";
						echo "<p>".$feedback."</p>";
						//echo "<footer></footer>";
					echo "</blockquote>";
				}
				?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php 
echo ($searchPageRows%4===0) ? '</div>' : FALSE;
}
?>