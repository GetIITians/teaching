	 	<table class="table table-bordered">
      <thead>
      <tr>
       <th style="width:10%">
	       	Sr No.  
        </th>
        <th>Teacher</th>
        <th>Demo</th>
        <th>Fees</th>
        <th>Comments</th>
        <th>Time</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach($call_detail as $key=>$row): ?>
      <tr>
      <td>
	 	     <?php echo $key+1; ?>
      </td>
    <td><?php echo $row['teacher']; ?></td>
    <td><?php echo $row['demo']; ?></td>
    <td>Rs. <?php echo $row['fees']; ?></td>
		<td><?php echo $row['comments']; ?></td>
    <td><?php if(!empty($row['created_at'])) echo date("d-M-Y h:i:s",$row['created_at']); ?></td>
     </tr>
<?php endforeach; ?>
    </tbody>
  </table>
