<?php  
setifnn($width, (count($rows)==0 ? 0 : count($rows[0])) );
setifnn($height,  count($rows)  );
if($height > 0 ) {
?>
<table class=" responsive-table"  >
	<thead>
		<tr>
			<?php
			for($i=0; $i<$width; $i++) {
			?>
				<th><?php if($func==null || $func(0,$i)==null) { echo convchars(getval($i, getval(0, $rows))); } ?></th>
			<?php
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		for($j=1; $j<$height; $j++) {
		?>
		<tr>
			<?php
			for($i=0; $i<$width; $i++) {
			?>
				<td>
					<?php 
						if($func==null || $func($j,$i)==null) {
							if ($i==2) {
								//fb(getval($i, getval($j, $rows)),$i,FirePHP::LOG);
								//echo date("j F, Y | g:i a",getval($i, getval($j, $rows)));
								echo date("j F, Y",getval($i, getval($j, $rows)));
							} else {
								echo convchars(getval($i, getval($j, $rows))); 
							}
						}
					?>
				</td>
			<?php
			}
			?>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php
}
?>