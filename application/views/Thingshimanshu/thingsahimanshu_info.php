<?php 
// pagin var
$pagin_limit = 100;

?>
  	 <table class="table table-bordered" >
    <thead>
      <tr class="subhead">
        <td style="width:4%">ID</td>
        <td>Category</td>
        <td>Details</td>
        <td>Responsibility</td>
        <td style="width:8%">Due date</td>
        <td style="width:8%">Last Status</td>
        <td style="width:25%">Last Comment</td> 
       <td style="width:8%">Comment Date</td>
        <th>View</th>
        <th>Edit </th>
        <th>Delete </th>
        </tr>
    </thead>
    <tbody>
<?php  
$data = getpaginval($thingsahimanshu_info,$pagval,$pagin_limit);
foreach($data as $key=>$row) { 
 $row['status']=Fun::getcomfortstatus($row['status'],$row['due_date']);
  ?>      
    <tr >
 	 	<td><?php echo $row['id']; ?></td>
 	 	<td><?php echo $row['category']; ?></td>
    <td><?php echo $row['details']; ?></td>
    <td><?php echo $row['responsibility']; ?></td>
    <td><?php if(!empty($row['due_date'])) echo date("d-M-Y",$row['due_date']); ?></td>
    <td style="background:<?php echo Fun::getstatuscolor($row['status'],'td') ?>"><?php echo $row['status']; ?></td>
    <td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['comment_date'])) echo date("d-M-Y",$row['comment_date']); ?></td>
    <td><a href="<?php echo HOST.'thingshimanshu/view/'.$row['id']; ?>" >View</a></td>
    <td><a onclick='yogy.edit_thingsahimanshuinfo(this)' data-action="thingsahimanshu_editpopup" data-thingsahimanshu='<?php echo json_encode($row); ?>'>Edit</a></td>
    <td><a onclick='yogy.confirm(this)' data-delname="This Thing"; data-id="<?php echo $row['id']; ?>" data-action="thingsahimanshu_delete_info" data-res="success.push('Data Deleted Successfully!!');div.reload($('#thingsahimanshutbl')[0]);"> Delete</a></td>
    </tr>
 <?php } ?>     
      <tr><td colspan="15">
	      	<ul class="pagination">
<?php
    for($i=1;$i<=getpaginrows(count($thingsahimanshu_info),$pagin_limit);$i++):
 ?>
			<li><a onclick="div.pagin(this,$('#thingsatbl')[0]);" data-paginval="<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php endfor; ?>
      </ul>
		</td>
      </tr>
    </tbody>
  </table>
