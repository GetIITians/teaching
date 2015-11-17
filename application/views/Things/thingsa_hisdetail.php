	 	<table class="table table-bordered">
      <thead>
      <tr>
       <th style="width:10%">
	       	Sr No.  
        </th>
        <th>Status</th>
        <th>Comments</th>
        <th>Time</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach($thingsa_hisdetail as $key=>$row): ?>
      <tr>
      <td>
	 	     <?php echo $key+1; ?>
      </td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['created_at'])) echo date("d-M-Y h:i:s",$row['created_at']); ?></td>
     </tr>
<?php endforeach; ?>
    </tbody>
  </table>
