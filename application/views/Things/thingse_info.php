<?php 
// pagin var
$pagin_limit = 100;

?>
     <table class="table table-bordered" >
    <thead>
      <tr>

      </tr>
      <tr class="subhead">
        <td style="width:5%">ID</td>
        <td style="width:15%">Responsibility</td>
        <td style="width:15%">Category</td>
        <td style="width:30%">Details</td>
        <td style="width:5%">Duration</td>
        <td style="width:5%">Start</td>
        <td style="width:5%">End</td>
        <td style="width:12%">Date</td>
      </tr>
    </thead>
    <tbody>
<?php  
$data = getpaginval($thingse_info,$pagval,$pagin_limit);

foreach($data as $key=>$row) { ?>      
      <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['responsibility']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['details']; ?></td>
    <?php if($row['start'] != '') { ?>
    <td><?php echo gmdate("H:i", $row['end']-$row['start']); ?></td>
    <?php } else { ?>
    <td></td>
    <?php } ?>
    <td><?php  if($row['start']) echo date('H:i', $row['start']); ?></td>
    <td><?php  if($row['end']) echo date('H:i', $row['end']); ?></td>
    <td><?php if(!empty($row['created_at'])) echo date("d-M-y h:i:s",$row['created_at']); ?></td>
</tr>
 <?php } ?>     
      <tr><td colspan="15">
          <ul class="pagination">
<?php
    for($i=1;$i<=getpaginrows(count($thingse_info),$pagin_limit);$i++):
 ?>
      <li><a onclick="div.pagin(this,$('#thingsetbl')[0]);" data-paginval="<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php endfor; ?>
      </ul>
    </td>
      </tr>
    </tbody>
  </table>
