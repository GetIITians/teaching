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
<?php if(User::isloginas('a') || (User::loginId()==76)): ?>
        <th>Edit </th>
        <th>Delete </th>
<?php endif; ?>        
        </tr>
    </thead>
    <tbody>
<?php  
$data = getpaginval($thingsa_info,$pagval,$pagin_limit);
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
    <td><a href="<?php echo HOST.'things/view/'.$row['id']; ?>" >View</a></td>
<?php if(User::isloginas('a') || (User::loginId()==76)): ?>
    <td><a onclick='yogy.edit_thingsainfo(this)' data-action="thingsa_editpopup" data-thingsa='<?php echo json_encode($row); ?>'>Edit</a></td>
    <td><a class="complete" onclick="adminThings.complete(this)" data-delname="This Thing"; data-id="<?php echo $row['id']; ?>" data-action="thingsahisdetails" data-res="success.push('Task status changed to Completed.');div.reload($('#thingsatbl')[0]);">Complete</a></td>
    </tr>
 <?php endif; } ?>     
      <tr><td colspan="15">
	      	<ul class="pagination">
<?php
    for($i=1;$i<=getpaginrows(count($thingsa_info),$pagin_limit);$i++):
 ?>
			<li><a onclick="div.pagin(this,$('#thingsatbl')[0]);" data-paginval="<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php endfor; ?>
      </ul>
		</td>
      </tr>
    </tbody>
  </table>
