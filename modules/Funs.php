<?php
/*
Define 
#fname : Name of function, in which we are currently.

*/
abstract class Funs{
	public static function headerinfo(){
		return array("title"=>"wwm","css"=>array("bootstrap-3.1.1-dist/css/bootstrap.css","bootstrap-3.1.1-dist/css/bootstrap-theme.css","css/main.css"));
	}
	public static function cst_tree(){
		$query="select all_classes.classname, all_subjects.subjectname, all_topics.topicname, all_cst.* from all_cst left join all_classes on all_cst.c_id=all_classes.id left join all_subjects on all_cst.s_id=all_subjects.id left join all_topics on all_cst.t_id=all_topics.id ";
		$cstdata=Sql::getArray($query);
		$data=array();
		foreach($cstdata as $i=>$row){
			$cur=&$data;
			$ids=array("c_id","s_id","t_id");
			$names=array("classname","subjectname","topicname");
			for($j=0;$j<3;$j++){
				$cur=Fun::setifunset($cur,$row[$ids[$j]],array("name"=>$row[$names[$j]],"children"=>array()));
				$cur=&$cur[$row[$ids[$j]]]["children"];
			}
		}
		return $data;
	}
	public static function cst_tree2classlist($inp){
		$outp=array();
		foreach($inp as $key=>$val){
			$outp[]=array("val"=>$key,"disptext"=>$val["name"]);
		}
		return $outp;
	}
	public static function timeslotlist($sliced=false){
		$datetoday=Fun::datetoday();
		$times=array();
		for($i=0;$i<48;$i++){
			$times[]=Fun::timetotime_t3($datetoday+$i*1800,false)." - ".Fun::timetotime_t3($datetoday+($i+1)*1800,true );
		}
		if(!$sliced)
			return $times;
		else{
			$outp=array();
			for($i=0;$i<3;$i++)
				$outp[]=array_slice($times,16*$i,16);
			return $outp;
		}
	}

	public static function timeslotlist_t2(){
		/*
		Return all timeslots in a day in 2 hour, 2 pair. try : print_r(#fname());
		*/
		$datetoday=Fun::datetoday();
		$times=array();
		for($i=0;$i<6;$i++){
			$pair=array();
			for($j=0;$j<2;$j++){
				$h=$i*2+$j*12;
				$pair[]=array(Fun::timetotime_t3($datetoday+$h*3600,false)." - ".Fun::timetotime_t3($datetoday+($h+2)*3600,true ), implode("-", Fun::oneToN(2*$h+4,2*$h+1)));
			}
			$times[]=$pair;
		}
		return $times;
	}

	//Made by ::Himanshu Rohilla::  
	//This function extracts the field from jsoninfo of teachers table from the database
	//$jsonArray is that jsoninfo field value in techers table
	//$subN is the array of field
	//$type is the name in jsoninfo field
	public static function extractFields($jsonArray,$subN,$type){
		$jsonArray=str2json($jsonArray);
		$subjects=$jsonArray[$type];
		$subArray=explode("-", $subjects);
		$check=0;
		$str="";

		foreach ($subArray as $key) {
			if($key!='other' && $check==0) {
				if($subN[$key-1]!="Others") //for Other in 6 subjects
					$str=$str.$subN[$key-1]." , ";
			}
			else
				$check=1;
		}
		$comma="";
		$subOther="";
		if(trim($jsonArray[$type.'other'])!=""){  
			$comma=" , ";
			$subOther=trim($jsonArray[$type.'other']);
		}
		$finalString=$str.$subOther.$comma;
		$outSubject=substr_replace($finalString, "", -2);
		return $outSubject;
	}
	
	public static function calenderInfo($tid,$month,$year){
		global $_ginfo;
		$timestamp = strtotime($year.'-'.$month.'-1');//starting time of month
		$numberOfDays = date("t",$timestamp);//no. of days in that month
		$monthslots=Sqle::getA(gtable(User::loginId()==$tid?"meteacherallts":"studentteacherallts"),array("starttime"=>$timestamp,"endtime"=>$timestamp+24*3600*$numberOfDays,"tid"=>$tid,"sid"=>User::loginId()));
		$dailymap=array();
		foreach($monthslots as $i=>$val){
			$date=div($val["starttime"]-$timestamp,24*3600)+1;
			$dailymap=Fun::setifunset($dailymap,$date,array());
			$dailymap[$date][]=$val["starttime"];
		}

		$try=0;
		$count=1;
		for($row=0;$row<7 && $count<=$numberOfDays;$row++){
			for($col=0;$col<7;$col++){
				$cellinfo=array("date"=>-1,"tdparams"=>array(),"text"=>"","dispslots"=>"","istoday"=>false);
				if($row==0){
					$cellinfo["text"]=$_ginfo["weekdays_long"][$col];
				}
				else{
					if( ($col==0+date("N",$timestamp)-1 && $try==0 ) || ($try==1 && $count<=$numberOfDays) ){
						$datets=$timestamp+($count-1)*3600*24;
						$cellinfo["date"]=$count;
						$cellinfo["text"]=$count;
						if($datets>time())
							$cellinfo["tdparams"]=array("data-datets"=>$datets,"data-tid"=>$tid,"data-action"=>"daytspopup","onclick"=>"opencalpopup(this);");
						if(isset($dailymap[$count])){
							$cellinfo["dispslots"]=Funs::slottext($dailymap[$count]);
						}
						$cellinfo["istoday"]=($datets==daystarttime());

						$try=1;
						$count++;
					}
				}
				$twoDArr[$row][$col]=$cellinfo;
			}
		}
		return $twoDArr;
	}
	public static function bulktsquery($slotList,$dayList,$startdate,$enddate){//Return list of ( to be inserted/ deleted ) starttime in a array
		$outp=array();
		for($i=$startdate;$i<=$enddate;$i+=3600*24){
			if(in_array(0+date("N",$i),$dayList)){
				for($j=0;$j<count($slotList);$j++){
					$class_starttime=$i+1800*($slotList[$j]-1);
					$outp[]=$class_starttime;
				}
			}
		}
		return $outp;
	}



	public static function extractLang($langArray,$encodedUserLangString){
		//Function Added By Tej Pal Sharma
	//Extracts the language from array of languages based on indexes stored in database as 1-4-5 to Himdi, Mathematics, English etc.
		$userLangArray = explode("-", $encodedUserLangString);
		$string = "";
		foreach ($userLangArray as $userLang) {
			if($userLang!="")
				$string .= $langArray[$userLang-1].", ";
		}
		$string = substr_replace($string, "", -2);
		return $string;
	}

	public static function get_teacher_cal_info($tid,$month=null,$year=null){
		global $_ginfo;
		setifnn($month,0+date("n"));
		setifnn($year,0+date("Y"));

		$pageinfo=array();
		$pageinfo['timeslots']=Funs::timeslotlist(true);
		$pageinfo['weekdays']=$_ginfo["weekdays_long"];
		$pageinfo['twoDArr']=Funs::calenderInfo($tid,$month,$year);

		$pageinfo['currentDate']=date('j');
		$pageinfo['showVar']=true;
		$pageinfo['tid']=$tid;
		$pageinfo["month"]=$month;
		$pageinfo["year"]=$year;
		$pageinfo["buttons"]=array(0=>array( ((($month+12-1-1)%12)+1), $year-($month==1) ) , 4=>array( ($month+1-1)%12+1 , $year+($month==12) ) ,1=>array(0+date("n"),0+date("Y")) );
		$pageinfo["button_icons"]=array(0=>"photo/icons/left_arrow.png",4=>"photo/icons/right_arrow.png",1=>"photo/icons/home.png");
		$pageinfo["monthlist"]=arr2option($_ginfo["month"]);
		$pageinfo["yearlist"]=arr2option(Fun::oneToN( $_ginfo["end_year"],2015),'own');
		$pageinfo["monthstartts"]=$timestamp = strtotime($year.'-'.$month.'-1');

		return $pageinfo;
	}
	public static function gettid($tid=0){
		$tid=0+$tid;
		setift($tid,0+User::loginId(),$tid==0);
		return $tid;
	}
	public static function slottext($slotlist){
		$grouped=grouplist($slotlist,1800);
		$displine=4;
		if(count($grouped)>$displine){
			$ngrouped=array_slice($grouped,0,$displine-1);
			$removed_list=array_slice($grouped,$displine-1);
			$numslot=0;
			foreach($removed_list as $i=>$val){
				list($val1,$val2)=$val;
				$numslot+=$val2;
			}
		}
		else{
			$ngrouped=$grouped;
		}
		foreach($ngrouped as $i=>$val){
			list($val1,$val2)=$val;
			$ngrouped[$i]=Fun::timetotime_t3($val1)." - ".Fun::timetotime_t3($val1+$val2*1800);
		}
		if(count($grouped)>$displine){
			$ngrouped[]="and ".$numslot." more slots";
		}
		return implode("<br>",$ngrouped);
	}
	public static function addremlist($inp=array(),$isinsert=true){
		if(count($inp)>0){
			$topusharr=array();
			foreach($inp as $i=>$val){
				$topusharr[]=array(User::loginId(),$val);
			}
			$query=Fun::makeDummyTableColumns($topusharr,array("tid","starttime"));
			$timenow=0+time();
			if($isinsert){
				$query="insert into timeslot (tid,starttime) select * from (".$query.") dummyquery where (tid,starttime) not in (select tid,starttime from timeslot) AND starttime > ".$timenow." ";
				return Sql::query($query);
			}
			else{
				$query="delete from timeslot where (tid,starttime) in (select * from (".$query.") dummyquery ) AND sid is null AND starttime >  ".$timenow ;
				return Sql::query($query);
			}
		}
		else
			return 0;
	}
	public static function teacherinfo($tid){
		$tinfo=Sqle::getRow("select * from teachers left join users on users.id=teachers.tid where tid=? limit 1",'i',array(&$tid));
		if($tinfo!=null){
//      str2json($tinfo[''])
		}
	}
	public static function sendmsg($phone,$msg){
		$phone=urlencode($phone);
		$msg=urlencode($msg);
		$url="http://216.245.209.132/rest/services/sendSMS/sendGroupSms?AUTH_KEY=14e4de84f23c84d81f24b8fb69d1e0&message=".$msg."&senderId=GETIIT&routeId=1&mobileNos=".$phone."&smsContentType=english";
		return shell_exec("curl '".$url."'");
	}
	public static function otpstore($phone, $st,$email=''){
		$otp=rand(100000,999999);
		sets("phone",$otp);
		Fun::msgfromfile($phone,"php/mail/otp.txt",array("otp"=>$otp, "name" => $st));
		if($email!='') { 
			$otp=rand(100000,999999);
			sets("email",$otp);
			Fun::mailfromfile($email,"php/mail/otp_mail.txt",array("otp"=>$otp, "name" => $st));
		} 
		return 1;
//    Fun::msgfromfile($data["phone"],"php/mail/otp.txt",array("otp"=>$otp));
	}
	public static function teacher_profile_about_info($tid){
		$pageinfo=array();
		$pageinfo["aboutinfo"]=Sqle::getRow("select teachers.*,users.* from teachers left join users on users.id=teachers.tid where teachers.tid=? limit 1",'i',array(&$tid));
		if($pageinfo["aboutinfo"]==null){
			return null;
		}
		$pageinfo["tid"]=$tid;
		$tempArr=explode(' ',$pageinfo['aboutinfo']['name']);
		$pageinfo['firstName']=$tempArr[0];
		$pageinfo['lastName']=$tempArr[1];
		$jsonArray=str2json($pageinfo['aboutinfo']['jsoninfo']);
		$pageinfo['city']=$jsonArray['city'];
		$pageinfo['jsonArray']=$jsonArray;
		$tempSubjects=Funs::extractFields($pageinfo['aboutinfo']['jsoninfo'],$_ginfo['encodeddataofteacherstable']['sub'],'sub');
		$pageinfo['subArray']=explode(' , ', $tempSubjects);
		$tempGrades=explode('-',$jsonArray['grade']);
		foreach ($tempGrades as $value) {
			$gradeArray[]=$_ginfo['encodeddataofteacherstable']['grade'][$value-1];
		}
		$pageinfo['gradeArray']=$gradeArray;
		$tempLang=explode('-',$pageinfo['aboutinfo']['lang']);
		foreach ($tempLang as $value) {
			$langArray[]=$_ginfo['encodeddataofteacherstable']['lang'][$value-1];
		}
		$pageinfo['langArray']=$langArray;
		return $pageinfo;
	}

	public static function teacher_subjects($tid) {
		return Sqle::getA( gtable("subjectlist")." where tid={tid} ", array("tid" => $tid) );
	}

	public static function teacher_profile_info($tid){
		$pageinfo=Funs::teacher_profile_about_info($tid);
		if($pageinfo==null)
			return null;
		$cst_tree=Funs::cst_tree();
		$topicinfo=array('cst_tree'=>$cst_tree, "tid"=>$tid);
		$topicinfo["class_olist"]=Funs::cst_tree2classlist($cst_tree);
		$topicinfo["mysubj"] = Funs::teacher_subjects($tid);
//		$topicinfo["mysubj"]=Sql::getArray("select subjects.*,all_classes.classname, all_subjects.subjectname, all_topics.topicname from subjects left join all_classes on all_classes.id=subjects.c_id left join all_subjects on all_subjects.id=subjects.s_id left join all_topics on all_topics.id=subjects.t_id where tid=?",'i',array(&$tid));
		$pageinfo["calinfo"]=Funs::get_teacher_cal_info($tid);
		$pageinfo["topicinfo"]=$topicinfo;
		return $pageinfo;
	}
	public static function classeslist_filter($inp) {
		foreach($inp as $i => $row) {
			$row["starttime_disp"] = Fun::timetotime_t3($row["starttime"]);
			$row["startdate_disp"] = Fun::timetodate($row["starttime"]);
			$row["duration_disp"] = number_format($row["duration"]/3600.0 , 1);
			$inp[$i] = $row;
		}
		return $inp;
	}
	public static function moneyaccount($uid) {
		$pageinfo = array();
		$pageinfo["moneyaccount"] = Sqle::getA("select * from moneyaccount where uid={uid} order by time desc ", array("uid" => $uid));
		$pageinfo["mymoney"] = getval("mymoney", Sqle::getR( "select * from ".qtable("showaccountbalance")." where uid={uid}", array("uid" => $uid)));
		return $pageinfo;
	}

	public static function student_profile($sid) {
		$sinfo=User::userProfile($sid);
		$flname=explode(" ",$sinfo["name"]." ");
		$dob=$sinfo["dob"]>0 ? Fun::timetostr_t3($sinfo["dob"]):"";
		$oldslots = Funs::classeslist_filter(Sqle::getA(qtable("stdbookedclasses_old", false), array("sid" => $sid)));
		$newslots = Funs::classeslist_filter(Sqle::getA(qtable("stdbookedclasses_new", false), array("sid" => $sid)));
		$pageinfo=array("fname"=>$flname[0],"lname"=>$flname[1],"sinfo"=>$sinfo,"dob"=>$dob, "sid" => $sid, "newslots" => $newslots, "oldslots" => $oldslots);
		$pageinfo["rlist"] = Sqle::getA("select * from ".qtable("allreviews")." where sid={sid} ", array("sid" => User::loginId()));
		mergeifunset($pageinfo, Funs::moneyaccount($sid)); 
		//fb($pageinfo,'pageinfo',FirePHP::LOG);
		return $pageinfo;
	}
	public static function doublesplit($inp){
		$outp=array();
		for($i=0;$i<count($inp);$i+=2){
			$newe=array($inp[$i]);
			if($i+1<count($inp))
				$newe[]=$inp[$i+1];
			$outp[]=$newe;
		}
		return $outp;
	}

	public static function tejpal_output($data){ 

//	$data have keys => {class, subject, topic, price, timer, lang, timeslot, orderby, search}
//	$hisoutput=array("select tid from teachers",array());
		$hisoutput = Funs::mssearch($data);
		$hisoutput[1]["uid"] = (0+User::loginId());
		$setorderby=Funs::setorderby($data['orderby']);
		$hisoutput[0]="select dispteachers.tid, teacherratings.avgrating, takendemo.isdonedemo, teacherratings.numpeople as numrater, subjectnamelist.subjectname, users.name, users.dob, users.profilepic, teachers.teachermoto, teachers.jsoninfo,teachers.teachingexp, pricelist.minprice, pricelist.maxprice,teachers.rating,teachers.rating_total, teachers.lang,avlsolts.ttl_avlsolts,tteachtime.teachduration from (".$hisoutput[0].") dispteachers left join users on users.id=dispteachers.tid left join teachers on teachers.tid=dispteachers.tid left join (".gtable("pricelist").") pricelist on pricelist.tid = teachers.tid left join ".qtable("subjectnamelist")." on subjectnamelist.tid = teachers.tid left join ".qtable("teacherratings")." on teacherratings.tid=teachers.tid left join ".qtable("takendemo")." on takendemo.tid = teachers.tid left join ".qtable("avlsolts")." on avlsolts.tid=teachers.tid left join ".qtable("tteachtime")." on tteachtime.tid=teachers.tid where teachers.isselected='a' order by ".$setorderby;		
		$hisoutput[2]="select dispteachers.tid, teacherratings.avgrating, takendemo.isdonedemo, teacherratings.numpeople as numrater, subjectnamelist.subjectname, users.name, users.dob, users.profilepic, teachers.teachermoto, teachers.jsoninfo,teachers.teachingexp, pricelist.minprice, pricelist.maxprice,teachers.rating,teachers.rating_total, teachers.lang,avlsolts.ttl_avlsolts,tteachtime.teachduration from (".$hisoutput[2].") dispteachers left join users on users.id=dispteachers.tid left join teachers on teachers.tid=dispteachers.tid left join (".gtable("pricelist").") pricelist on pricelist.tid = teachers.tid left join ".qtable("subjectnamelist")." on subjectnamelist.tid = teachers.tid left join ".qtable("teacherratings")." on teacherratings.tid=teachers.tid left join ".qtable("takendemo")." on takendemo.tid = teachers.tid left join ".qtable("avlsolts")." on avlsolts.tid=teachers.tid left join ".qtable("tteachtime")." on tteachtime.tid=teachers.tid where teachers.isselected='a' order by ".$setorderby;
		return $hisoutput;
	}
	public static function get_teacher_classes($tid) {
		$oldslots = Funs::classeslist_filter(Sqle::getA(qtable("teacherbookedclasses_old", false), array("tid" => $tid)));
		$newslots = Funs::classeslist_filter(Sqle::getA(qtable("teacherbookedclasses_new", false), array("tid" => $tid)));
		return array("newslots" => $newslots, "oldslots" => $oldslots);
	}
	public static function wiziqtime($inp) {
		return date("Y-m-d H:i", $inp);
	}
	public static function wiziq($data) {
		global $_ginfo;
		$secretAcessKey="A9m0hoLiBLlixWgBgpUVuw==";
		$access_key="f0fWFgPNdys=";

		// $data["tmid"]="saini@mail.com";
		// $data["class_title"]="Timepass";
		// $data["s_time"]="2015-05-19 15:30";

		$webServiceUrl="http://class.api.wiziq.com/";

		if($data["action"] == "getteacherinfo") {
			$obj = new getTeacher($secretAcessKey,$access_key,$webServiceUrl);

		} else if($data["action"] == "addteacher") {//tmid
			$requestParameters = array();
			$requestParameters["name"]="Mohit Saini";
			$requestParameters["email"]=$data["tmid"];
			$requestParameters["password"] = "mohitsaini";
			$obj=new AddTeacher($secretAcessKey,$access_key,$webServiceUrl,$requestParameters);
		} else if($data["action"] == "addclass") {//tmid, s_time,duration  o:{title, }
			mergeifunset($data, array("title" => "getIITians"));
			$requestParameters=array();
			$requestParameters["presenter_email"]=$data["tmid"];
			$requestParameters["start_time"] = Funs::wiziqtime($data["s_time"]);
			$requestParameters["title"]=$data["title"]; //Required
			$requestParameters["duration"] = floor($data["duration"]/60); //optional
			$requestParameters["time_zone"] = "Asia/Kolkata"; //optional
			$requestParameters["attendee_limit"]=""; //optional
			$requestParameters["control_category_id"]=""; //optional
			$requestParameters["create_recording"]=""; //optional
			$requestParameters["return_url"]=""; //optional
			$requestParameters["status_ping_url"]=""; //optional
			$requestParameters["language_culture_name"]="en-us";
			$obj=new ScheduleClass($secretAcessKey,$access_key,$webServiceUrl,$requestParameters);
			$odata=$obj->secheduledata;
			return $odata;
		} else if($data["action"] == "tryaddclass") {//s_time, duration
			$teachers = array( "mohitsaini@gmail.com", "saini@mail.com", "vikash@mail.com" );
			$temp=null;
			for($i=0; $i<$_ginfo["wiziqlimit"]; $i++) {
				$data["action"] = "addclass";
				$data["tmid"] = $teachers[$i];
				$temp = Funs::wiziq($data);
				if($temp["ec"] > 0) {
					break;
				}
			}
			if($temp["ec"] > 0) {
				$temp1 = Funs::wiziq(array("action" => "addstudent", "class_id" => $temp["cid"]));
				$temp["surl"] = $temp1["url"];
			}
			return $temp;
		} else if($data["action"] == "addstudent") {//class_id
			$requestParameters = array();
			$requestParameters["class_id"] = $data["class_id"];
			$requestParameters["student_id"] = 100;
			$requestParameters["student_name"] = "Student";
			$obj = new AddAttendee($secretAcessKey,$access_key,$webServiceUrl,$requestParameters);
			$odata = $obj->addclassdata;
			return $odata;
		}
	}
	
	public static function wiziqurl($row) {
		$outpurl = null;
		if($row["starttime"] + $row["duration"] < time() ){
			$outpurl = $row["rurl"];
		} else {
			$outpurl = $row[ (User::isloginas("s") ? "surl":"url") ];
		}
		return getifn($outpurl, "");
	}
//Search modules
/* by yogy */
	public static function setorderby($orderval) {
		if($orderval==1) {
			return "teachers.teachingexp desc";
		} else if($orderval==2) {
			return "pricelist.maxprice desc";
		} else if($orderval==3) {
			return "pricelist.minprice asc";
		} else if($orderval==4) {
			return "teachers.rating desc";
		} else {
			return "pricelist.maxprice asc";
		}

	}
/* ..... */		
	public static function mssearch($data) { 
		$keys = replacekeys(searchkeysplit($data["search"]),array('6'=>'vi','7'=>'vii','8'=>'viii','9'=>'ix','10'=>'x','11'=>'xi','12'=>'xii',"maths"=>"math"));
		$params=array();
		foreach($keys as $i => $val) {
			$params["key".($i+1)] = $val;
		}
		$pt_constrain = map(array("price", "timer"), function($ctype) use($data){
			return Fun::get_constrain($data[$ctype], map(gi($ctype), function($inp){
				return $inp[1];
				}));
		}, true);
		$timeslot_constrain = Fun::get_constrain($data["timeslot"], map(range(0,47), function($inp){
			return "(starttime%(3600*24)) div 1800 = $inp";
		}));
		$lang_constrain = Fun::get_constrain($data["lang"], map(range(0, count(giget("encodeddataofteacherstable", "lang"))-1), function($inp){
			return "concat('-', lang, '-') like concat('%-', ".(1+$inp).", '-%')";
		}));
		$home_constrain = Fun::get_constrain($data["home"], map(range(0, count(giget("encodeddataofteacherstable", "lang"))-1), function($inp){
			return "concat('-',jsoninfo,'-') like concat('%', "."'".'"home":"'.(1+$inp).'"'."'".", '%')";
		}));
		$pincode_constrain = ($data['pincode']==''?'true':"concat('-',jsoninfo,'-') like concat('%', "."'".'"zipcode":"'.($data["pincode"]).'"'."'".", '%')");
		
		mergeifunset($params, Fun::getflds(array("class", "subject", "topic","home","pincode"), $data));
		
		$relv_query1 = "select distinct tid from ".qtable("subjectlist")." left join users on users.id = subjectlist.tid where ( s_id in (select id from all_subjects where subjectname=(select subjectname from all_subjects where id='".$params['subject']."'))) AND ((".Fun::key_search($keys, "classname").") OR (".Fun::key_search($keys, "subjectname").") OR (".Fun::key_search($keys, "topicname").") OR (".Fun::key_search($keys, "users.name").")  ) AND (".$pt_constrain["price"].") AND (".$pt_constrain["timer"].")";
		
		$query1 = "select distinct tid from ".qtable("subjectlist")." left join users on users.id = subjectlist.tid where (c_id={class} or ".tf($data["class"] == "")." ) AND ( s_id={subject} or ".tf($data["subject"] == "")."  ) AND ( (".Fun::multichoose($data["topic"], "t_id", true). ") or ".tf( $data["topic"] == "" )."  ) AND ((".Fun::key_search($keys, "classname").") OR (".Fun::key_search($keys, "subjectname").") OR (".Fun::key_search($keys, "topicname").") OR (".Fun::key_search($keys, "users.name").")  ) AND (".$pt_constrain["price"].") AND (".$pt_constrain["timer"].")";
			
/*		$query2 = "select distinct tid from timeslot where starttime>".time()." AND (".$timeslot_constrain.")";   
*/ 
/* new query by yogy*/
/*		$query1 = "select distinct tid from ".qtable("teachersubjectlist")." left join users on users.id = teachersubjectlist.tid where (c_id={class} or ".tf($data["class"] == "")." ) AND ( s_id={subject} or ".tf($data["subject"] == "")."  ) AND ( (".Fun::multichoose($data["topic"], "t_id", true). ") or ".tf( $data["topic"] == "" )."  ) AND ((".Fun::key_search($keys, "classname").") OR (".Fun::key_search($keys, "subjectname").") OR (".Fun::key_search($keys, "topicname").") OR (".Fun::key_search($keys, "users.name").")  ) AND (".$pt_constrain["price"].") AND (".$pt_constrain["timer"].")";*/ // this query gives results with teachers has no class ,subject ,topic booked 
		$query4 = "select tid from teachers where (".$home_constrain.")";
/* new query by yogy*/
		
		$query3 = "select tid from teachers where (".$lang_constrain.")";
		$query5 = "select tid from teachers where (".$pincode_constrain.")";
					
//		$finalquery = $query1;
		$relv_finalquery = Fun::intersectionquery(array($relv_query1/*, $query2*/, $query3, $query4, $query5), "tid");
		$finalquery = Fun::intersectionquery(array($query1/*, $query2*/, $query3, $query4, $query5), "tid");
//		echo $finalquery;
//		$finalquery = "(".$query1.") union (".$query2.") ";
//		$finalquery = Fun::intersectionquery(array($query1, $query2), "tid");
//		
		//print_r($finalquery);
		return array($finalquery,$params,$relv_finalquery);
	}

	public static function addPayUMoney($money, $commentid='', $uid=null, $add = array(), $mailf=null) {
		setifnn($uid, User::loginId());
		$content = "You booked class of ".$add['classname'].", ".$add['subjectname'].", ".$add['topicname']." with teacher ".$add['teachername'];
		Sqle::insertVal("moneyaccount", array("uid" => $uid, "content" => $content, "time" => time(), "PayUMoney" => $money, "amount" => (-$money), "txnid" => $add['txnid']));
		if($mailf != null) {
			Fun::mailfromfile($add["mailto"], $mailf, $add);
		}
	}

	public static function addremmoney($money, $commentid='', $uid=null, $add = array(), $mailf=null) {
		setifnn($uid, User::loginId());
		$content = rquery(getval($commentid, gi("moneyaccount"), $commentid), $add);
		Sqle::insertVal("moneyaccount", array("uid" => $uid, "content" => $content, "time" => time(), "amount" => $money));
		if($mailf != null) {
			Fun::mailfromfile($add["mailto"], $mailf, $add);
		}
	}

	public static function admin_profile($aid, $ainfo=array()) {
		$pageinfo = array();
		$pageinfo['ainfo'] = $ainfo;
		mergeifunset($pageinfo, Funs::moneyaccount($aid));
		return $pageinfo;
	}

	public static function sendmail($to, $subject, $body) {
		$mail             = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port

		$mail->Username   = "getiitians@gmail.com";  // GMAIL username
		$mail->Password   = "iitdelhi1984";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.

		$mail->From       = "getiitians@gmail.com";
		$mail->FromName   = "getIITians";
		$mail->Subject    = $subject;
		$mail->AltBody    = ""; //Text Body
		$mail->WordWrap   = 5000; // set word wrap

		$mail->MsgHTML($body);

		$mail->AddReplyTo("info@getiitians.com","getIITians");

		//$mail->AddAttachment("/path/to/file.zip");             // attachment
		//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

		$mail->AddAddress($to, "");

		$mail->IsHTML(true); // send as HTML

		return $mail->Send();
	}

	public static function bkvas_tinfo($row){
		global $_ginfo;

		$jsonArray=str2json($row['jsoninfo']);
		mergeifunset($row, Fun::getflds($_ginfo['teacherJsoninfo'], $jsonArray));

		foreach ($_ginfo['teacherJsoninfolist'] as $key1 => $value1) {
			if(isset($jsonArray[$value1]) || isset($row[$value1])) {
				if(isset($jsonArray[$value1])) 
					$field=$jsonArray;
				else 
					$field=$row;
				$subArray=array();
				$count=count($_ginfo['encodeddataofteacherstable'][$value1]);
				$subjects=intexplode_t2('-',$field[$value1],$count);
				foreach ($subjects as $key => $value) {
					if($value==$count) {
						$str=$value1.'other';
						if($field[$str]!='')
							$subArray[]=htmlspecialchars($field[$str]);
					}
					else 
						$subArray[]=$_ginfo['encodeddataofteacherstable'][$value1][$value-1];
				}
				$name=$value1.'_name';
				$row[$name]=$subArray;
			}
		}
		unset($row['jsoninfo']);
		return $row;
	}

		public static function ratingBigBox($qresult=[])
	{
		if (!empty($qresult))
		{
			$tid = [];
			foreach ($qresult as $detail)
			{
				$tid[] = $detail['tid'];
			}
			$teachers = implode(',', $tid);

			$rating = [];
			$rating_query = "select rating,teacher_id from rating WHERE teacher_id IN (".$teachers.")";
			$rating = sql::getArray($rating_query);

			$review = [];
			$review_query = "select feedback,tid from booked WHERE tid IN (".$teachers.") AND feedbackStatus = 'yes'";
			$review = sql::getArray($review_query);

			return [$rating,$review];
		}

		return [];
	}

}
?>