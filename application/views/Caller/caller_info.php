<?php 
// pagin var
$pagin_limit = 5;
?>
  	 <table class="table table-bordered" >
    <thead>
      <tr>

      </tr>
      <tr class="subhead">
      <td style="width:4%">
        <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
        <label for="filled-in-box"></label>       
      </td>
        <td style="width:5%">ID</td>
        <td>Student Name</td>
        <td>Class </td>
        <td>Subject </td>
        <td>Phone No.</td>
        <td>Caller Name</td>
        <td>Caller Relation</td>
        <td>Last Comment</td> 
       <td>Comment Date</td>
        <th rowspan="2">View Full Info</th>
        </tr>
    </thead>
    <tbody>
<?php 
$data = getpaginval($caller_info,$pagval,$pagin_limit);
//print_r($data);
foreach($data as $key=>$row) { ?>      
      <tr>
       <td>
	 	<input type="checkbox" class="filled-in" id="<?php echo $key; ?>" checked="checked" />
      	<label for="<?php echo $key; ?>"></label>
      	</td>
 	 	<td><?php echo $row['id']; ?></td>
 	 	<td><?php echo $row['name']; ?></td>
    <td><?php echo $row['class']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td ><?php echo $row['phone']; ?></td>
    <td><?php echo $row['caller_name']; ?></td>    
    <td><?php echo $row['caller_rel']; ?></td>
    <td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['caller_date'])) echo date("d-M-Y",$row['caller_date']); ?></td>
    <td><a  href="<?php echo HOST.'caller/view/'.$row['id']; ?>" >view Full Info</a></td>
    </tr>
 <?php }; ?>     
      <tr><td colspan="15">
	      	<ul class="pagination">
<?php
    for($i=1;$i<=getpaginrows(count($caller_info),$pagin_limit);$i++):
 ?>
			<li><a onclick="div.pagin(this,$('#callertlb')[0]);" data-paginval="<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php endfor; ?>
      </ul>
		</td>
      </tr>
    </tbody>
  </table>
