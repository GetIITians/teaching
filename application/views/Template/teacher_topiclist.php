<?php 
if(User::islogin() ) {
	if(isses("redirecturl"))
		unsets("redirecturl");	
} else {
	sets("redirecturl",cururl().'/5');
}
foreach($mysubj as $i=>$row){
?>
<tr>
	<td><?php echo $row["classname"]; ?></td>
	<td><?php echo $row["subjectname"]; ?></td>
	<td><?php echo $row["topicname"]; ?></td>
	<td style="display:none"><?php echo $row["timer"]."h"; ?></td>
	<td>&#8377;<?php echo $row["price"]; ?></td>
<?php
if($tid==User::loginId()){
?>
	<td><a data-deleteid="<?php echo $row["id"]; ?>" data-action='deltopics' onclick='button.sendreq_v2(this);' class="btn waves-effect waves-light red darken-1" data-res='success.push("Deleted");div.reload($("#teacherdisptopics")[0]);' >Delete</a></td>
<?php
}
else if(User::isloginas('s')) {
?>
	<td><a onclick="ms.booktopic(this,'<?php echo $row["c_id"]."-".$row["s_id"]."-".$row["t_id"]; ?>');"  class="btn waves-effect waves-light red darken-1" data-topictext="<?php echo $row["classname"].", ".$row["subjectname"].", ".$row["topicname"]; ?>" >Book</a></td>
<?php
} else if(!(User::islogin())) {
?>	
<td><a href='<?php echo BASE."login" ?>'  class="btn waves-effect waves-light red darken-1" >Free Demo</a></td>
<?php 
}
?>

</tr>
<?php
}
?>
