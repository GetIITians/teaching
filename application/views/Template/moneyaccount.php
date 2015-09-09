<?php if(isset($_SESSION['PayUMoneySlotBooked'])) : ?>
	<?php if($_SESSION['PayUMoneySlotBooked']) : ?>
	<script type="text/javascript">
		Materialize.toast('Slot Booked', 4000);				
	</script>
	<?php else : ?>
	<script type="text/javascript">
		Materialize.toast('Invalid Transaction', 4000, 'warning');
	</script>
	<?php endif; unset($_SESSION['PayUMoneySlotBooked']); ?>
<?php endif; ?>
<div class="row">
	<div class="col-xs-12">
		<div class="card blue-grey darken-1">
			<div class="card-content white-text">
				<span class="card-title">Current Balance</span>
				<p>&#8377;&nbsp;<?php echo $mymoney; ?></p>
			</div>
		</div>
	</div>	
</div>

<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Money Transferred</th>
					<th>Comment</th>
					<th>Times</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($moneyaccount as $i => $row) {
				?>
				<tr>
					<td>
						<?php if($row["PayUMoney"] == null) : ?>
						<div class="<?php pit("red-text", $row["amount"]<0, "green-text"); ?>">
							<i class="<?php pit("mdi-content-remove", $row["amount"]<0, "mdi-content-add"); ?>">
							</i>
							 &#8377; <?php echo abs($row["amount"]); ?>
						</div>
						<?php else : ?>
						<div class="red-text">
							<i class="mdi-content-remove">
							</i>
							 &#8377; <?php echo abs($row["PayUMoney"]); ?>
						</div>
						<?php endif; ?>
					</td>
					<td><?php echo convchars($row["content"]); ?></td>
					<td class="tooltipped" data-position="right" data-delay="50" data-tooltip="<?php echo Fun::timetostr( $row["time"] ); ?>">
						<span class="grey-text"><?php echo Fun::timepassed( time()-$row["time"] ); ?></span>
					</td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>