<?php
class Actiondisp{
	function dispcal($data){
		$need=array("month","year","tid");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		if($ec<0){
			return;
		}
		load_view("dispcal.php", Funs::get_teacher_cal_info(0+$data["tid"],$data["month"],$data["year"]) );
	}
	function reviewload($data){
		$need=array("id","like","dislike","type");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else if(!User::islogin())
			$ec=-8;
		echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		if($ec<0){
			return;
		}

		$like=$data['like'];
		$dislike=$data['dislike'];
		$id=$data['id'];
		$sid=User::loginId();
		$date=date("Y-m-d h:i:s");

		if($data["type"]=="like") {
			$sql="insert into likes values('$id','$sid','1','$date')";
			sql::query($sql);
		}
		else {
			$sql="insert into likes values('$id','$sid','-1','$date')";
			sql::query($sql);
		}
		
		//load_view("reviewload.php",array("id"=>$data["id"],"like"=>$data["like"],"dislike"=>$data["dislike"],"disableTag"=>true));
	}
	function uploadfileslot($data) {
		$need=array("name");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else if(!User::islogin())
			$ec=-8;
		echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		if($ec<0){
			return;
		}
		echo 'dadasdasdasd';
		//load_view("")
		//load that view that shows the uploaded files
	}
	function daytspopup($data){
		$need=array('datets','tid');
		$ec=1;
		$odata = 0;
		if(!Fun::isAllSet($need,$data)){
			$ec = -9;
		}
		echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		if($ec<0)
			return;

		$data["datets"]=daystarttime($data["datets"]);
		$pageinfo=array("datets"=>$data["datets"]);
		$dayslots=sql2dict(Sqle::getA(gtable(User::loginId()==$data["tid"]?"meteacherallts":"studentteacherallts"),array("starttime"=>$data["datets"],"endtime"=>$data["datets"]+24*3600,"tid"=>$data["tid"], "sid"=>User::loginId())),"starttime");

		$slotinfo=array();
		for($i=1;$i<=48;$i++){
			$slottime=($i-1)*1800+$data["datets"];
			$slotinfo[$i]=array("cansee"=>($data["tid"]==User::loginId()),"blocked"=>false,"checked"=>false );
			if(isset($dayslots[$slottime])){
				$slotinfo[$i]=Fun::mergeifunset($slotinfo[$i],$dayslots[$slottime]);
				$slotinfo[$i]["cansee"]=true;
				$slotinfo[$i]["blocked"]=($dayslots[$slottime]["sid"]!="");
				$slotinfo[$i]["checked"]=($data["tid"]==User::loginId() || $dayslots[$slottime]["sid"]==User::loginID() )  ;
			}
		}
		$pageinfo["isguest"]=($data["tid"]!=User::loginId() && (!User::isloginas("s")));
		$pageinfo["isself"]=($data["tid"]==User::loginId());
		$pageinfo["isstudent"]=( (User::isloginas("s")) );

		$pageinfo["dayslots"]=$slotinfo;
		$pageinfo["timeslots"]=Funs::timeslotlist(true);
		$pageinfo["tid"]=$data["tid"];
		load_view("timeslotpopup.php",$pageinfo);
	}
	function teacherTimeSlotOfDayPopUp($data){
		$need=array('day','month','year','tid');
		$ec=1;
		$odata = 0;
		if(!Fun::isAllSet($need,$data)){
			$ec = -9;
		}
		echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		if($ec<0)
			return;
		
		$pageinfo = array();
		$timeslotsArray = Funs::getTeacherTimeSlotsForDay($data['day'],$data['month'],$data['year'],$data['tid']);
		$timeslotsOfDayStringArray = array();

		$indexedts=array();
		foreach($timeslotsArray as $val){
			$indexedts[((0+$val["starttime"])-strtotime(date("d-m-Y",$val["starttime"])))/1800 ]=1;
		}

		foreach ($timeslotsArray as $timeslot) {
			$timeslotsOfDayStringArray[] = Fun::timetotime_t2($timeslot['starttime'],true).' - '.Fun::timetotime_t2($timeslot['starttime']+1800,true).' '.Fun::timetotime_t2($timeslot['starttime']+1800,false);
		}
		$loginId = User::loginId();
		$loginType = User::loginType();
		$pageinfo['timeslotsArray'] = $timeslotsArray;
		$pageinfo['timeslotsOfDayStringArray'] = $timeslotsOfDayStringArray;
		$pageinfo['timeslotsListArray']=Funs::timeslotlist(true);
		$pageinfo['loginType'] = $loginType;
		$pageinfo['loginId'] = $loginId?$loginId:0;
		$pageinfo['tid'] = $data['tid'];
		$pageinfo['day'] = $data['day'];
		$pageinfo['month'] = $data['month'];
		$pageinfo['year'] = $data['year'];
		$pageinfo["indexedts"]=$indexedts;

		load_view('timeslotpopup.php',$pageinfo);
	}
	function search($data,$printjson=true){
		global $_ginfo;
//		$need=array('class', 'subject', 'topic', 'price', 'timer', 'lang', 'timeslot', 'orderby', 'search', 'max', 'maxl');
		$need=array('class', 'subject', 'topic', 'orderby', 'search', 'max', 'maxl');
		$ec=1;
		$odata = 0; 
		if(!Fun::isAllSet($need,$data)){ 
			$ec = -9;
		}

		if($ec>0){ 
			list($query,$param,$relv_query)=Funs::tejpal_output($data);
			mergeifunset($param, array('max'=>$data['max'], 'maxl'=>$data["maxl"], 'minl'=>0, 'min'=>0));
			$qoutput=Sqle::autoscroll($query, $param, null, '', true, null, $_ginfo["numsearchr"]["loadadd"]);
			$relv_qoutput=Sqle::autoscroll($relv_query, $param, null, '', true, null, $_ginfo["numsearchr"]["loadadd"]);
			//fb($qoutput,'row',FirePHP::LOG);
			$odata=Fun::getflds(array("max", "maxl", "qresultlen"), $qoutput);
			$relv_odata=Fun::getflds(array("max", "maxl", "qresultlen"), $relv_qoutput); 
			/* Narayan Waraich */
			$ratingBigBox = Funs::ratingBigBox($qoutput['qresult']);
			$relv_ratingBigBox = Funs::ratingBigBox($relv_qoutput['qresult']);

			$rating_result = array();		
			if (User::islogin())
			{
				$rating_query = "select * from rating where user_id=".User::loginId();
				$rating_result = sql::getArray($rating_query);
			}
		}
			/* #################*/		
		if($printjson){
			echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		}
		if($ec<0)
			return;
		if(!empty($qoutput['qresult'])){
		load_view("Template/teacherlist.php",array("qresult"=>$qoutput['qresult'],"rating"=>$rating_result,"ratingBigBox"=>$ratingBigBox,"isrelv"=>"0"));
		} else if(!empty($relv_qoutput['qresult'])) {	
		load_view("Template/teacherlist.php",array("qresult"=>$relv_qoutput['qresult'],"rating"=>$rating_result,"ratingBigBox"=>$relv_ratingBigBox,"isrelv"=>"1"));
		}
	}
	function disptopics($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Template/teacher_topiclist.php", array("mysubj" => Funs::teacher_subjects($data["tid"]), "tid" => $data["tid"] ));
	}

	function adminprofile_users($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$pageinfo = array(); 
		$pageinfo["allusers"] = array(
			"teachers" => Sqle::getA("select teachers.isselected, users.* from users left join teachers on teachers.tid = users.id where users.type='t' order by users.create_time desc"),
			"students" => Sqle::getA("select users.* from users where type='s' order by users.create_time")
		);
		load_view("Template/adminprofile_users.php", $pageinfo );
	}

	function moneyaccount($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if( $outp["ec"] < 0 )
			return;
		load_view("Template/moneyaccount.php", Funs::moneyaccount(User::loginId()));
	}
}
?>