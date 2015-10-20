<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3>Question</h3>
			<div class="row">
				<div class="col-xs-12">
					<h5><?php echo $question[0]['title']; ?></h5>
					<p><?php echo $question[0]['des']; ?></p>
				</div>
			</div>
			<h3>Answers</h3>
		<?php if(!User::isloginas('t')): ?>
			Tutor <a href="<?php echo base_url().'login'; ?>">signin</a> for answer
		<?php endif; ?>
			<?php foreach($answers as $key=>$data): ?>
			<h4 style="text-align: left">Answer <?php echo $key+1 ?> </h4>
			<div class="row">
				<div>
				<?php echo $data["ans"]; ?>
				</div>
				<div class="col-xs-2">
				<?php echo Fun::timepassed( time()-$data["anstime"] ); ?>
				</div>
				<div class="col-xs-2">
				<?php echo $data["teachername"]?>
				</div>
			</div>
			<?php endforeach; ?>			
		</div>
	</div>
	<?php if(User::isloginas('t')): ?>	
	<div class="row">
	<h4>Write Your Answer</h4>
	<form method="post" action="<?php echo site_url("forum/submitAns"); ?>">
	<input type="hidden" name="tid" value="<?php echo User::loginId(); ?>">
	<input type="hidden" name="qid" value="<?php echo $question[0]['id']; ?>">
	<textarea id="editor" name="ans"></textarea>
	<input type="submit" name="submit" value="Submit">
</div>
<?php endif; ?>
</div>

