<script>	var topics=<?php echo json_encode($cst_tree); ?>;	</script>

<?php 
if(!$isdonedemo) {
?>
<div class="alert alert-success alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
	Choose a course for free demo.
</div>
<?php
}
?>
<div class="row">
	<?php if(User::loginId()==$tid) : ?>
	<div class="col-md-3 col-xs-12">
		<h5 class="grey-text text-darken-2">Please add your topics</h5>
		<hr class="underlined">
		<div class="row">
			<form method="post" class="col s12" onsubmit='if(submitForm(this)){ form.req(this) };return false;' data-action="addtopics" data-res='div.reload($("#teacherdisptopics")[0]);' >
					<div class="form-group">
						<select name='class' class="browser-default form-control" onchange='topicssubtopic(this);' id="selectclass" data-condition='simple' style='' >
							<?php
								 disp_olist($class_olist,array('selectalltext'=>"Select Grade"));
							?>
						</select>
					</div>
					<div class="form-group">
						<select name='subject'  class="browser-default form-control" id='selectsubject' onchange='topicssubtopic(this);' data-condition='simple' >
							<option value="" >Please select grade first</option>
						</select>
					</div>
					<div class="form-group">
						<select name='topic' class="browser-default form-control" id='selecttopic' data-condition='simple' >
							<option value="" >Please select subject first</option>
						</select>
					</div>
					<div class="form-group" style="display:none">
						<input id="duration" type="text" class="validate form-control" name="timer">
						<label for="duration">Class duration (in hrs)</label>
					</div>
					<div class="form-group">
						<input id="fees" type="text" class="validate form-control" name="price" data-condition='simple' value='<?php echo $minfees; ?>' >
						<label for="fees">Fees per hour (in &#8377;)</label>
					</div>
					<div class="input-field">
						<button type="submit" class="btn waves-effect waves-light blue"><i class="material-icons left">add_circle_outline</i>Add</button>
					</div>
			</form>
		</div>
	</div>
	<?php endif; ?>
	<div class="col-md-9 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th data-field="class">Grade</th>
						<th data-field="subject">Subject</th>
						<th data-field="topic" >Topic</th>
						<th data-field="duration" style="display:none">Duration (hrs)</th>
						<th data-field="fees">Fees/hr</th>
						<th data-field=""></th>
					</tr>
				</thead>
				<tbody data-tid="<?php echo $tid; ?>" data-action="disptopics" id="teacherdisptopics" >
					<?php
						load_view("Template/teacher_topiclist.php", array("mysubj" => $mysubj, "tid" => $tid));
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
