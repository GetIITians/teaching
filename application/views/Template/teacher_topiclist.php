<?php 
if(User::islogin() ) {
	if(isses("redirecturl"))
		unsets("redirecturl");	
} else {
	sets("redirecturl",cururl().'/5');
}
$pehla = 0;
foreach($mysubj as $i=>$row){
	if (isset($_SESSION['shortlist']) && ($row["c_id"] == $_SESSION['shortlist']['class'] || $row["s_id"] == $_SESSION['shortlist']['subject'] || $row["t_id"] == $_SESSION['shortlist']['topic'])) {
		$pehla++;
		// some error with this
		if ($pehla === 1) {
			echo "<tr class='shortlist' id='pehla'>";
		} else {
			echo "<tr class='shortlist'>";
		}
	} else {
		echo "<tr>";
	}
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
				echo "Free 1 Hour Class";
			}
		?>
		</a>
	</td>
<?php elseif(!(User::islogin())) : ?>
	<td>
		<a href='<?php echo BASE."login" ?>'  class="btn waves-effect waves-light red darken-1" >
			Free 1 Hour Class
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