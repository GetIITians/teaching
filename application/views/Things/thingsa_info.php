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
        <td>Category</td>
        <td>Details</td>
        <td>Responsibility</td>
        <td>Due date</td>
        <td>Last Status</td>
        <td style="width:25%">Last Comment</td> 
       <td style="width:5%">Comment Date</td>
        <th >View </th>
        <th >Edit </th>
        <th >Delete </th>
        </tr>
    </thead>
    <tbody>
<?php  
$data = getpaginval($thingsa_info,$pagval,$pagin_limit);

foreach($data as $key=>$row) { ?>      
      <tr>
 	 	<td><?php echo $row['id']; ?></td>
 	 	<td><?php echo $row['category']; ?></td>
    <td><?php echo $row['details']; ?></td>
    <td><?php echo $row['responsibility']; ?></td>
    <td><?php echo $row['due_date']; ?></td>
    <td ><?php echo $row['status']; ?></td>
    <td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['comment_date'])) echo date("d/m/y",$row['comment_date']); ?></td>

    <td><a href="<?php echo HOST.'things/view/'.$row['id']; ?>" >View</a></td>
    <?php $popupdata = json_encode($row) ?>
    <td><a onclick='yogy.edit_callerinfo(this)' data-action="caller_editpopup" data-caller='<?php echo json_encode($row); ?>' >Edit</a></td>
    <td><a onclick='yogy.confirm(this)' data-delname="This Thing"; data-id="<?php echo $row['id']; ?>" data-action="thingsa_delete_info" data-res="success.push('Data Deleted Successfully!!');div.reload($('#thingsatbl')[0]);"> Delete</a></td>
    </tr>
 <?php } ?>     
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
