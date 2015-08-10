<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<?php
					for($i=0;$i<6;$i++)
					{
						opent("td");
							opent("div",array("align"=>"center"));
								if($i==0 || $i==1 || $i==4)
								{
									opent("img",array("src"=>$button_icons[$i], "class"=>"icon-hover canloadcal", "data-month"=>$buttons[$i][0], "data-year"=>$buttons[$i][1], "data-tid"=>$tid, "data-action"=>"dispcal", "onclick"=>"ms.calreq(this);"));
								}
								else if($i==2 || $i==3)
								{
									opent("select",array("class"=>"canloadcal browser-default","onchange"=>($i==2?'hitu.changemonth(this);':'hitu.changeyear(this);').'ms.calreq(this);',"data-month"=>$month,"data-year"=>$year,"data-action"=>"dispcal", "data-tid"=>$tid ));
									if($i==2)
										disp_olist($monthlist,array("selected"=>$month));
									else if($i==3)
										disp_olist($yearlist,array("selected"=>$year));
									closet("select");
								}
								else if($i==5){
									opent("img",array("src"=>"photo/icons/loading2.gif","style"=>"visibility:hidden;","id"=>"calenderloadingimg"));
								}
							closet("div");
						closet("td");
					}
				?>
			</tr>
		</thead>
	</table>
</div>
<button style="display:none;" id="calhomebutton" data-month="<?php echo $month; ?>" data-year="<?php echo $year; ?>" data-tid="<?php echo $tid; ?>" data-action="dispcal" ></button>

<div class="table-responsive">
	<table class="table table-block-hover">
		<?php
			for($i=0;$i<count($twoDArr);$i++)
			{
				opent("tr");
					for($j=0;$j<7;$j++)
					{
						opent("td",Fun::mergeifunset($twoDArr[$i][$j]["tdparams"],array("style"=>"border:solid #eeeeee 1px;".($twoDArr[$i][$j]["istoday"]?"background-color:#cccccc;":"")  )));
							opent("div",array("align"=>"center"));
								if($i==0)
								{
									ocloset("b",$twoDArr[$i][$j]["text"]);
								}
								else
								{
									echo $twoDArr[$i][$j]["text"];
									echo "<br>";
									echo ($twoDArr[$i][$j]["dispslots"]);
								}
							closet("div");
						closet("td");
					}
				closet("tr");
			}
		?>
	</table>
</div>