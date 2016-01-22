<?php
class Actiondisp {
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
	function daytspopupreqst($data) { 
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
		$dayslots=sql2dict(Sqle::getA(gtable(User::loginId()==$data["tid"]?"meteacherallts":"meteacherallts"),array("starttime"=>$data["datets"],"endtime"=>$data["datets"]+24*3600,"tid"=>$data["tid"], "sid"=>User::loginId())),"starttime");
		$slotinfo=array();
		for($i=1;$i<=48;$i++){
			$slottime=($i-1)*1800+$data["datets"];
			$slotinfo[$i]=array("cansee"=>true,"blocked"=>false,"checked"=>false );
			if(isset($dayslots[$slottime])){
				$slotinfo[$i]=Fun::mergeifunset($slotinfo[$i],$dayslots[$slottime]);
				$slotinfo[$i]["cansee"]=false;
			}
		}
		$pageinfo["isguest"]=($data["tid"]!=User::loginId() && (!User::isloginas("s")));
		$pageinfo["isself"]=($data["tid"]==User::loginId());
		$pageinfo["isstudent"]=( (User::isloginas("s")) );
		$pageinfo["dayslots"]=$slotinfo;
		$pageinfo["timeslots"]=Funs::timeslotlist(true);
		$pageinfo["tid"]=$data["tid"];
		$pageinfo["requesttimeslot"] = 1;
		load_view("timeslotpopup.php",$pageinfo);
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
		if (isset($_SESSION['shortlist'])) {
			unset($_SESSION['shortlist']);
		}
		if (!User::isloginas('t') && ($data['class'] != '' || $data['subject'] != '' || $data['topic'] != '')) {
			$_SESSION['shortlist'] = [];
			$_SESSION['shortlist']['class']		=	($data['class'] != '') ? $data['class'] : null ;
			$_SESSION['shortlist']['subject']	=	($data['subject'] != '') ? $data['subject'] : null ;
			$_SESSION['shortlist']['topic']		=	($data['topic'] != '') ? $data['topic'] : null ;
		}
		$ec=1;
		$odata = 0; 
		if(!Fun::isAllSet($need,$data)){ 
			$ec = -9;
		}

		if($ec>0){ 
			list($query,$param,$relv_query)=Funs::tejpal_output($data);
			mergeifunset($param, array('max'=>$data['max'], 'maxl'=>$data["maxl"], 'minl'=>0, 'min'=>0));
			//var_dump($param);
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
		/*#################*/
		if($printjson){
			echo json_encode(array('ec'=>$ec,'data'=>$odata))."\n";
		}
		if($ec<0)
			return;

		if(!empty($qoutput['qresult'])){  //print_r(count($qoutput['qresult']));
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
	/* BY Yogy */
	function dispteacher($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
		return;
	handle_disp(array(), "adminprofile_users");
	}
	/* .... */
	function adminprofile_users($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$pageinfo = array(); 
		$pageinfo["allusers"] = array(
			"teachers" =>  Fun::resjson2arr(Sqle::getA("select teachers.isselected,teachers.jsoninfo, users.* from users left join teachers on teachers.tid = users.id where users.type='t' order by users.create_time desc")),
			"students" => Sqle::getA("select users.* from users where type='s' order by users.create_time")
		);
		load_view("Template/adminprofile_users.php", $pageinfo );
	}

	function adminprofile_reviews() {
		$pageinfo = array(); 
		$pageinfo["reviews"] = Sqle::getA("SELECT `student`.`name` as student, `class`.`feedback`, `class`.`feedbackStatus`, `class`.`starttime`, `teacher`.`name` as teacher, `teacher`.`profilepic`, `teacher`.`id` as tid FROM (`booked` class) JOIN `users` student ON `class`.`sid` = `student`.`id` JOIN `users` teacher ON `class`.`tid` = `teacher`.`id` WHERE `class`.`feedback` != 'NULL'");
		load_view("Template/adminprofile_reviews.php", $pageinfo );
	}

	function adminprofile_homepage_reviews() {
		$pageinfo = array(); 
		$pageinfo["reviews"] = Sqle::getA("SELECT `student`.`name` as student, `class`.`feedback`, `class`.`feedbackHomepage`,`class`.`starttime`, `teacher`.`name` as teacher, `teacher`.`profilepic`, `teacher`.`id` as tid FROM (`booked` class) JOIN `users` student ON `class`.`sid` = `student`.`id` JOIN `users` teacher ON `class`.`tid` = `teacher`.`id` WHERE `class`.`feedback` != 'NULL' AND `class`.`feedbackStatus`='yes'");
		load_view("Template/adminprofile_homepage_reviews.php", $pageinfo );
	}

	function moneyaccount($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if( $outp["ec"] < 0 )
			return;
		load_view("Template/moneyaccount.php", Funs::moneyaccount(User::loginId()));
	}
/*    BY YOGY   */	
	function teacher_classes($data, $printjson = true) {
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$myclasses = array(); 
		$myclasses = Funs::get_teacher_classes(User::loginId());
		load_view("Template/profile_classes.php", $myclasses);
	}

	function callertbl($data,$printjson = true ){
		$data = Fun::setifunset($data,"orderby",0);
		$arr = Sqle::getA("SELECT caller_details.*,lastcalldetail.*,users.name AS teacher_name FROM caller_details LEFT JOIN ".qtable('lastcalldetail')." ON caller_details.id = lastcalldetail.st_id LEFT JOIN users ON lastcalldetail.teacher_id = users.id WHERE (".Fun::getdemocons($data).") AND (".Fun::getteachercons($data['t_id']).") ORDER BY ".Fun::caller_orderby($data['orderby']));
		if(!empty($data['paginval']))
			$pagval = $data['paginval'];
		else 
			$pagval = 0;
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Caller/caller_info.php", array("caller_info"=>$arr,"pagval"=>$pagval));

	}

	function calldetail($data,$printjson = true)
	{
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$arr = Sqle::getA("SELECT caller_demo.name as demo,caller_call.*,caller_teacher.name as teacher from caller_call LEFT JOIN (SELECT users.* from users INNER JOIN teachers ON teachers.tid = users.id where teachers.isselected = 'a' )caller_teacher ON caller_teacher.id = caller_call.teacher_id LEFT JOIN caller_demo ON caller_demo.id = caller_call.demo_id where st_id=".$data['id']." ORDER BY created_at DESC");
		load_view("Caller/calldetail.php",array("call_detail"=>$arr));
	}
	function caller_basicinfo($data,$printjson = true){
			$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$teaching_info = Fun::resjson2arr(Sqle::getA("SELECT caller_demo.name as demo,caller_demo.id as demo_id, caller_call.*,caller_teacher.* FROM `caller_call` LEFT JOIN (SELECT * from users INNER JOIN teachers ON teachers.tid = users.id where teachers.isselected = 'a' )caller_teacher ON caller_teacher.id = caller_call.teacher_id LEFT JOIN caller_demo ON caller_call.demo_id=caller_demo.id where st_id='".$data['id']."' and caller_call.created_at = (select max(created_at) from caller_call where st_id='".$data['id']."')"))[0];
		$caller_info = Sqle::getA("SELECT * from caller_details where id = '".$data['id']."'")[0];
		$teacher_info = Sqle::getA("SELECT users.id,users.name from users INNER JOIN teachers ON teachers.tid = users.id");
		$demo_info = Sqle::getA("select * from caller_demo");
		//var_dump($teaching_info);
		load_view("Caller/basic_info.php",array("demo_info"=>$demo_info,"caller_info"=>$caller_info,"teaching_info"=>$teaching_info,"teacher_info"=>$teacher_info));
	}	
	function caller_editpopup($data, $printjson = true) {
		$caller_details = array();
		foreach (json_decode($data['caller']) as $key => $value) {
			$caller_details[$key] = $value;
		}
		$caller_details['action'] = 'editcallerinfo';
		$caller_details['popup_close'] = 'editcollerpopup';
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$teacher_info = Sqle::getA("SELECT * from caller_teacher");
		load_view("Caller/addcaller.php", array("teacher_info"=>$teacher_info,"caller_details" =>$caller_details));
	}

	function caller_regiform($data, $printjson = true){
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$teacher_info = Sqle::getA("SELECT users.id,users.name from users INNER JOIN teachers ON teachers.tid = users.id");
		$demo_info = Sqle::getA("select * from caller_demo");
		load_view("popup.php",array("name"=>"addcollerpopup", "title" => "Add New Entry","body" =>"Caller/addcaller.php","bodyinfo" => array("demo_info" => $demo_info,"teacher_info" => $teacher_info,"caller_details" => array("id"=>"","action"=>"callerinfo","popup_close"=>"addcollerpopup","name"=>"","email"=>"","phone"=>"","source"=>"","address"=>"","class"=>"","subject"=>"","board"=>"","tution_type"=>"","caller_name"=>"","caller_rel"=>"","created_at"=>"","updated_at"=>"","caller_date"=>"","comments"=>"")) )); 

		
	}
	/*	THings for all		*/
	function thingsa_regiform($data, $printjson = true){
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("popup.php",array("name"=>"addthingsapopup", "title" => "Add Things To Do","body" =>"Things/addthingsa.php","bodyinfo" => array("thingsa_details" => array("id"=>"","action"=>"thingsainfo","popup_close"=>"addthingsapopup","category"=>"","details"=>"","responsibility"=>"","due_date"=>date('Y-m-d'),"status"=>"","comment"=>"")))); 
	}

	function thingse_regiform($data, $printjson = true){
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("popup.php",array("name"=>"addthingsepopup", "title" => "Add Things Done","body" =>"Things/addthingse.php","bodyinfo" => array("thingse_details" => array("id"=>"","action"=>"thingseinfo","popup_close"=>"addthingsepopup","category"=>"","details"=>"","responsibility"=>"")))); 
	}

	function thingsatbl($data,$printjson = true ){ 
		$data = Fun::setifunset($data,"orderby",0);
		$arr = Sqle::getA("SELECT thingsa_details.*,lastcommentdetail.* FROM thingsa_details LEFT JOIN (select thingsa_hisdetails.td_id,thingsa_hisdetails.comments,thingsa_hisdetails.status,thingsa_hisdetails.created_at as comment_date FROM thingsa_hisdetails INNER JOIN (SELECT MAX(created_at) as lasttime FROM `thingsa_hisdetails` GROUP BY td_id) maxval ON thingsa_hisdetails.created_at=maxval.lasttime) lastcommentdetail ON thingsa_details.id = lastcommentdetail.td_id WHERE ".Fun::getthingsrescons($data['viewbyres'],'a')."  ORDER BY ".Fun::thingsa_orderby($data['orderby']));
		if(!empty($data['paginval']))
			$pagval = $data['paginval'];
		else 
			$pagval = 0;
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Things/thingsa_info.php", array("thingsa_info"=>$arr,"pagval"=>$pagval));

	}
	function thingsetbl($data,$printjson = true ){
		$data = Fun::setifunset($data,"orderby",0);
		$arr = Sqle::getA("SELECT * FROM thingse_details WHERE ".Fun::getthingsrescons($data['viewbyres'],'e')." ORDER BY " .Fun::thingse_orderby($data['orderby']));
		if(!empty($data['paginval']))
			$pagval = $data['paginval'];
		else 
			$pagval = 0;
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Things/thingse_info.php", array("thingse_info"=>$arr,"pagval"=>$pagval));

	}
	function thingsa_basicinfo($data,$printjson = true){
			$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$thingsa_info = Sqle::getA("SELECT thingsa_details.*,lastcommentdetail.* FROM thingsa_details LEFT JOIN (select thingsa_hisdetails.td_id,thingsa_hisdetails.comments,thingsa_hisdetails.status,thingsa_hisdetails.created_at as comment_date FROM thingsa_hisdetails INNER JOIN (SELECT MAX(created_at) as lasttime FROM `thingsa_hisdetails` GROUP BY td_id) maxval ON thingsa_hisdetails.created_at=maxval.lasttime) lastcommentdetail ON thingsa_details.id = lastcommentdetail.td_id where thingsa_details.id = '".$data['id']."'")[0];
		load_view("Things/basic_info.php",array("thingsa_info"=>$thingsa_info));
	}

	function thingsahisdetail($data,$printjson = true)
	{
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$arr = Sqle::getA("SELECT thingsa_hisdetails.* from thingsa_hisdetails  where td_id=".$data['id']." ORDER BY created_at DESC");
		load_view("Things/thingsa_hisdetail.php",array("thingsa_hisdetail"=>$arr));
	}

	function thingsa_editpopup($data, $printjson = true) {
		$thingsa_details = array();
		foreach (json_decode($data['thingsa']) as $key => $value) {
			$thingsa_details[$key] = $value;
		}
		$thingsa_details['due_date'] = date('Y-m-d',$thingsa_details['due_date']);
		$thingsa_details['action'] = 'editthingsainfo';
		$thingsa_details['popup_close'] = 'editthingsapopup';
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Things/addthingsa.php", array("thingsa_details" =>$thingsa_details));
	}
	/*  Things for all  */
	
		/*	THings for himanshu(copy)		*/
	function thingsahimanshu_regiform($data, $printjson = true){
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("popup.php",array("name"=>"addthingsahimanshupopup", "title" => "Add Things To Do","body" =>"Thingshimanshu/addthingsahimanshu.php","bodyinfo" => array("thingsahimanshu_details" => array("id"=>"","action"=>"thingsahimanshuinfo","popup_close"=>"addthingsahimanshupopup","category"=>"","details"=>"","responsibility"=>"","due_date"=>date('Y-m-d'),"status"=>"","comment"=>"")))); 
	}

	function thingsehimanshu_regiform($data, $printjson = true){
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("popup.php",array("name"=>"addthingsehimanshupopup", "title" => "Add Things Done","body" =>"Thingshimanshu/addthingsehimanshu.php","bodyinfo" => array("thingsehimanshu_details" => array("id"=>"","action"=>"thingsehimanshuinfo","popup_close"=>"addthingsehimanshupopup","category"=>"","details"=>"","responsibility"=>"")))); 
	}

	function thingsahimanshutbl($data,$printjson = true ){ 
		$data = Fun::setifunset($data,"orderby",0);
		$arr = Sqle::getA("SELECT thingsahimanshu_details.*,lastcommentdetail.* FROM thingsahimanshu_details LEFT JOIN (select thingsahimanshu_hisdetails.td_id,thingsahimanshu_hisdetails.comments,thingsahimanshu_hisdetails.status,thingsahimanshu_hisdetails.created_at as comment_date FROM thingsahimanshu_hisdetails INNER JOIN (SELECT MAX(created_at) as lasttime FROM `thingsahimanshu_hisdetails` GROUP BY td_id) maxval ON thingsahimanshu_hisdetails.created_at=maxval.lasttime) lastcommentdetail ON thingsahimanshu_details.id = lastcommentdetail.td_id WHERE ".Fun::getthingshimanshurescons($data['viewbyres'],'a')."  ORDER BY ".Fun::thingsahimanshu_orderby($data['orderby']));
		if(!empty($data['paginval']))
			$pagval = $data['paginval'];
		else 
			$pagval = 0;
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Thingshimanshu/thingsahimanshu_info.php", array("thingsahimanshu_info"=>$arr,"pagval"=>$pagval));

	}
	function thingsehimanshutbl($data,$printjson = true ){
		$data = Fun::setifunset($data,"orderby",0);
		$arr = Sqle::getA("SELECT * FROM thingsehimanshu_details WHERE ".Fun::getthingshimanshurescons($data['viewbyres'],'e')." ORDER BY " .Fun::thingsehimanshu_orderby($data['orderby']));
		if(!empty($data['paginval']))
			$pagval = $data['paginval'];
		else 
			$pagval = 0;
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Thingshimanshu/thingsehimanshu_info.php", array("thingsehimanshu_info"=>$arr,"pagval"=>$pagval));

	}
	function thingsahimanshu_basicinfo($data,$printjson = true){
			$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$thingsahimanshu_info = Sqle::getA("SELECT thingsahimanshu_details.*,lastcommentdetail.* FROM thingsahimanshu_details LEFT JOIN (select thingsahimanshu_hisdetails.td_id,thingsahimanshu_hisdetails.comments,thingsahimanshu_hisdetails.status,thingsahimanshu_hisdetails.created_at as comment_date FROM thingsahimanshu_hisdetails INNER JOIN (SELECT MAX(created_at) as lasttime FROM `thingsahimanshu_hisdetails` GROUP BY td_id) maxval ON thingsahimanshu_hisdetails.created_at=maxval.lasttime) lastcommentdetail ON thingsahimanshu_details.id = lastcommentdetail.td_id where thingsahimanshu_details.id = '".$data['id']."'")[0];
		load_view("Thingshimanshu/basic_info.php",array("thingsahimanshu_info"=>$thingsahimanshu_info));
	}

	function thingsahimanshuhisdetail($data,$printjson = true)
	{
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		$arr = Sqle::getA("SELECT thingsahimanshu_hisdetails.* from thingsahimanshu_hisdetails  where td_id=".$data['id']." ORDER BY created_at DESC");
		load_view("Thingshimanshu/thingsahimanshu_hisdetail.php",array("thingsahimanshu_hisdetail"=>$arr));
	}

	function thingsahimanshu_editpopup($data, $printjson = true) {
		$thingsahimanshu_details = array();
		foreach (json_decode($data['thingsahimanshu']) as $key => $value) {
			$thingsahimanshu_details[$key] = $value;
		}
		$thingsahimanshu_details['due_date'] = date('Y-m-d',$thingsahimanshu_details['due_date']);
		$thingsahimanshu_details['action'] = 'editthingsahimanshuinfo';
		$thingsahimanshu_details['popup_close'] = 'editthingsahimanshupopup';
		$outp = array("ec" => 1, "data" => 0);
		if($printjson)
			echo json_encode($outp)."\n";
		if($outp["ec"] < 0)
			return;
		load_view("Thingshimanshu/addthingsahimanshu.php", array("thingsahimanshu_details" =>$thingsahimanshu_details));
	}
	/*  Things for Himanshu(copy)  */
/*  ........   */	

}
?>
