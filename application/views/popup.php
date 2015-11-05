<div class="PopupWrapper" style="overflow-y:scroll;cursor:pointer;" id="<?php echo $name; ?>Popup" onclick="mohit.clickoutside(this);" >
	<div class="Popup" onclick="mohit.clickinside(this);" style="cursor:auto;" id="<?php echo $name; ?>Popuplayer" >
		<div id="<?php echo $name; ?>Popupmain" >
			<div style="width:100%;height:35px;border-bottom:solid #dddddd 1px;">
				<span class="titlePopup" id='<?php echo $name; ?>Popuptitle' ><?php echo $title; ?></span>
				<span class="closePopup" onclick="mohit.closeme($(this).parent().parent().parent().parent()[0]);" >&times;</span>
			</div>
			<div style="padding:10px;" id="<?php echo $name; ?>Popupbody" >
	<!-- 			t<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u<br>u
	 -->

	 		<?php 
				if($body!=""){
					load_view($body,$bodyinfo);
				}
			?>
			</div>
			<div class="PopupFooter" id="<?php echo $name; ?>Popupfooter" >
				<?php
					if($footer!=""){
						load_view($footer,$footerinfo);
					}
					else{
					}
				?>
			</div>
		</div>
	</div>
</div>
