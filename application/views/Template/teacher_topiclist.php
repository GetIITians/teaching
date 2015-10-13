<?php 
if(User::islogin() ) {
	if(isses("redirecturl"))
		unsets("redirecturl");	
} else {
	sets("redirecturl",cururl().'/5');
}
$pehla = 0; 
foreach($mysubj as $i=>$row){ $trstring ="<tr";
	if (isset($_SESSION['shortlist'])) { 
		if(($row["c_id"] == $_SESSION['shortlist']['class']) && empty($_SESSION['shortlist']['subject']) && empty($_SESSION['shortlist']['subject']))
				{$trstring .= " class='shortlist' ";$pehla++;}
		else if(($row["c_id"] == $_SESSION['shortlist']['class']) && ($row["s_id"] == $_SESSION['shortlist']['subject']) && empty($_SESSION['shortlist']['topic']))
				{$trstring .=  " class='shortlist' ";$pehla++;}
		else if(($row["c_id"] == $_SESSION['shortlist']['class']) && ($row["s_id"] == $_SESSION['shortlist']['subject']) && ($row["t_id"] == $_SESSION['shortlist']['topic']))					
				{$trstring .=  " class='shortlist' ";$pehla++;}	
		if ($pehla === 1)
			$trstring .= " id='pehla'";
	} 
	echo $trstring.'>';
?>
	<td><?php echo $row["classname"]; ?></td>
	<td><?php echo $row["subjectname"]; ?></td>
	<td><?php echo $row["topicname"]; ?></td>
	<td style="display:none"><?php echo $row["timer"]."h"; ?></td>
	<td>&#8377;<?php echo $row["price"]; ?></td>
<?php if($tid==User::loginId()) : ?>
	<td>
		<a data-deleteid="<?php echo $row["id"]; ?>" data-action='deltopics' onclick='button.sendreq_v2(this);' class="btn waves-effect waves-light red darken-1" data-res='success.push("Deleted");div.reload($("#teacherdisptopics")[0]);' >
			Delete
		</a>
	</td>
<?php elseif(User::isloginas('s')) : ?>
	<td>
		<a onclick="ms.booktopic(this,'<?php echo $row["c_id"]."-".$row["s_id"]."-".$row["t_id"]; ?>','<?php echo $user_mob; ?>');"  class="btn waves-effect waves-light red darken-1" data-topictext="<?php echo $row["classname"].", ".$row["subjectname"].", ".$row["topicname"]; ?>" >
		<?php
			if($_SESSION['isdonedemo']){
				echo "Book";
			} else {
				echo "1 Hour Trial Class";
			}
		?>
		</a>
	</td>
<?php elseif(!(User::islogin())) : ?>
	<td>
		<a href='<?php echo BASE."login" ?>'  class="btn waves-effect waves-light red darken-1" >
			1 Hour Trial Class
			<?php $_SESSION['redirecturl'] = Helper::link(); ?>
		</a>
	</td>
<?php endif; ?>
</tr>
<?php
}
if (isset($_SESSION['shortlist'])) {
	//unset($_SESSION['shortlist']);
}
?>