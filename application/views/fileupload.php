<?php 
echo '<table>';
foreach ($temp as $key => $value) {
	echo '<tr>';
	echo '<td>'.$value['starttime'].'</td>';
	if($value['testfiles']!='')
		$filesArray=explode(',', $value['testfiles']);
	if($value['solnfiles']!='')
		$solnFilesArray=explode(',', $value['solnfiles']);
?>
<td>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-xs-12 col-md-8">
		  <div class="file-field input-field">
		      <input type="file" name="timeslot_upload[]" multiple>
		  </div>
		</div>
	</div>	
	<input type="hidden" name="slotid[]" value="<?php echo $value['starttime'] ?>">
	<input type="submit" value="submit">
	<?php
	$m=1;
	if($value['testfiles']!='') {
		foreach ($filesArray as $file) {
			echo '<br><a href="../../../'.$file.'">Test - '.$m.'<a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href='.BASE.'deleteFile/'.$file.','.$value['starttime'].','.$tid.'/testfiles'.'>Delete</a>';
			$m++;
		}
	}
	?>
</form>
</td><td>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-xs-12 col-md-8">
		  <div class="file-field input-field">
		      <input type="file" name="timeslot_uploadsoln[]" multiple>
		  </div>
		</div>
	</div>	
	<input type="hidden" name="slotid[]" value="<?php echo $value['starttime'] ?>">
	<input type="submit" value="submit">
	<?php
	$m=1;
	if($value['solnfiles']!='') {
		foreach ($solnFilesArray as $file) {
			echo '<br><a href="../../../'.$file.'">Solution - '.$m.'</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href='.BASE.'deleteFile/'.$file.','.$value['starttime'].','.$tid.'/solnfiles'.'>Delete</a>';
			$m++;
		}
	}
	?>
	
</form>
</td>
<?php
echo '</tr>';
}
?>
</table>
