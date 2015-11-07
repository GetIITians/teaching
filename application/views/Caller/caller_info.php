<?php 
// pagin var
$pagin_limit = 100;

?>
  	 <table class="table table-bordered" >
    <thead>
      <tr>

      </tr>
      <tr class="subhead">
        <td style="width:4%">ID</td>
        <td>Student Name</td>
        <td>Class </td>
        <td>Subject </td>
        <td>Phone No.</td>
        <td>Teacher Name</td>
        <td>Demo</td>
        <td style="width:25%">Last Comment</td> 
       <td style="width:5%">Comment Date</td>
        <th >View </th>
        <th >Edit </th>
        <th >Delete </th>
        </tr>
    </thead>
    <tbody>
<?php  
$data = getpaginval($caller_info,$pagval,$pagin_limit);

foreach($data as $key=>$row) { ?>      
      <tr>
 	 	<td><?php echo $row['id']; ?></td>
 	 	<td><?php echo $row['name']; ?></td>
    <td><?php echo $row['class']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td ><?php echo $row['phone']; ?></td>
    <td><?php echo $row['teacher_name']; ?></td>    
    <td><?php echo $row['demo']; ?></td>
    <td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['caller_date'])) echo date("d/m/y",$row['caller_date']); ?></td>

    <td><a href="<?php echo HOST.'caller/view/'.$row['id']; ?>" >View</a></td>
    <?php $popupdata = json_encode($row) ?>
    <td><a onclick='yogy.edit_callerinfo(this)' data-action="caller_editpopup" data-caller='<?php echo json_encode($row); ?>' >Edit</a></td>
    <td><a onclick='yogy.confirm(this)' data-delname="Student : <?php echo $row['name']; ?>"; data-id="<?php echo $row['id']; ?>" data-action="caller_delete_info" data-res="success.push('Data Deleted Successfully!!');div.reload($('#callertlb')[0]);"> Delete</a></td>
    </tr>
 <?php } ?>     
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
