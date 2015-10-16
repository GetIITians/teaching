<?php
class Teachers{
	function addrembulkts($data){
		global $_ginfo;
		$outp=array("ec"=>1,"data"=>0);
		$slotList=intexplode("-",$data["time"]);
		$dayList=intexplode("-",$data["days"]);
		$startdate = daystarttime(strtotime($data["startdate"]));
		$enddate = daystarttime(strtotime($data["enddate"]));
		if($enddate-$startdate>$_ginfo["calrepeatlimit"]*3600*24)
			$outp["ec"]=-24;
		else{
			$outp["data"]=Funs::addremlist( Funs::bulktsquery($slotList,$dayList,$startdate,$enddate)  ,isset($data["add"]));
		}
		return $outp;
	}

	function teacherModifySlots($data){
		$outp=array("ec"=>1,"data"=>0);
		$slots=intexplode("-",$data["slots"]);
		$datets=daystarttime($data["datets"]);
		$toaddslots=array();
		$toremslots=array();
		for($i=1;$i<=48;$i++){
			if(in_array($i,$slots))
				$toaddslots[]=$datets+($i-1)*1800;
			else
				$toremslots[]=$datets+($i-1)*1800;
		}
		$odata["data"]=array();
		$odata["data"]["add"]=Funs::addremlist($toaddslots,true);
		$odata["data"]["rem"]=Funs::addremlist($toremslots,false);
		return $outp;
	}

	function addtopics($data){
		$outp=array("ec"=>1,"data"=>0);
		$insert_data=Fun::getflds(array("timer","price"),$data);
		$difarr=array("class"=>"c_id","subject"=>"s_id","topic"=>"t_id");
		foreach($difarr as $i=>$val){
			$insert_data[$val]=$data[$i];
		}
		$insert_data["tid"]=User::loginId();
		$reffected=Sqle::insertVal("subjects", $insert_data );
		if(!($reffected>0)){
			$outp["ec"]=-25;
		}
		else{
		}
		return $outp;
	}

	function deltopics($data){
		Sqle::deleteVal("subjects",array("id"=>$data["deleteid"],"tid"=>User::loginId()),1);
		return array("ec"=>1,"data"=>0);
	}

	function updatebio($data) {
		Sqle::updateVal("teachers", array("teachermoto" => $data["teachermoto"]), array("tid" => User::loginId())) ;
		return array("ec"=>1,"data"=>0);
	}

/*     BY YOGY    */
	function confirm_class($data) { 
		global $_ginfo;
		$outp = array("ec"=>1, "data"=>0);
		Sqle::updateVal("booked",array("confirm"=>1), array("starttime"=>$data["starttime"],"tid"=>$data["tid"],"sid"=>$data["sid"]) );
 		$query="SELECT teacher.name as teachername , teacher.email as teacheremail, teacher.phone as teacherphone,  student.name as studentname, student.email as studentemail,student.phone as studentphone, booked.starttime,booked.c_id,booked.s_id,booked.t_id,booked.duration,all_classes.classname,all_subjects.subjectname,all_topics.topicname FROM (select name,email,phone from users where id={tid}) as teacher , (select name,email,phone from users where id={sid}) as student,booked left join all_classes on all_classes.id=booked.c_id left join all_subjects on all_subjects.id=booked.s_id left join all_topics on all_topics.id=booked.t_id  where booked.sid={sid} and booked.tid={tid} and booked.starttime= {starttime}";
		$cstinfo=sqle::getR($query,array("sid"=>$data['sid'],"tid"=>$data['tid'],"starttime"=>$data['starttime']));
		$timetotime[] = Fun::timetotime_t3($data["starttime"]);
		$cstinfo['date']=Fun::timetodate($data["starttime"]);
 		$dispdur[] = '('.number_format(($cstinfo['duration'])/3600.0 , 1)." hr)";
 		$cstinfo['stimes']=yogyimplode(", "," and ",conmerge($timetotime,$dispdur));
		Fun::mailfromfile($cstinfo["studentemail"], "php/mail/classconfirm_student.txt", $cstinfo);
		Fun::mailfromfile($cstinfo["teacheremail"], "php/mail/classconfirm.txt", $cstinfo);
		Fun::mailfromfile($_ginfo["adminmailid"], "php/mail/classconfirm_admin.txt", $cstinfo);
		Fun::msgfromfile($cstinfo["studentphone"], "php/mail/classconfirm_student_msg.txt", $cstinfo);
		Fun::msgfromfile($cstinfo["teacherphone"], "php/mail/classconfirm_msg.txt", $cstinfo);
		return $outp;

	}

	function cancel_class($data) { 
		global $_ginfo;
		$outp = array("ec"=>1, "data"=>0);
		$query="SELECT teacher.name as teachername , teacher.email as teacheremail, teacher.phone as teacherphone,  student.name as studentname, student.email as studentemail,student.phone as studentphone, booked.starttime,booked.c_id,booked.s_id,booked.t_id,booked.duration,booked.bookclassrqst as classrqst,booked.bookedat,all_classes.classname,all_subjects.subjectname,all_topics.topicname FROM (select name,email,phone from users where id={tid}) as teacher , (select name,email,phone from users where id={sid}) as student,booked left join all_classes on all_classes.id=booked.c_id left join all_subjects on all_subjects.id=booked.s_id left join all_topics on all_topics.id=booked.t_id  where booked.sid={sid} and booked.tid={tid} and booked.starttime= {starttime}";
		$cstinfo=sqle::getR($query,array("sid"=>$data['sid'],"tid"=>$data['tid'],"starttime"=>$data['starttime']));
		if(!empty($cstinfo)){
			$timetotime[] = Fun::timetotime_t3($data["starttime"]);
			$cstinfo['date']=Fun::timetodate($data["starttime"]);
	 		$dur = number_format(($cstinfo['duration'])/3600.0 , 1);
	 		$dispdur[] = '('.$dur." hr)";
	 		$cstinfo['stimes']=yogyimplode(", "," and ",conmerge($timetotime,$dispdur));		
	 		sqle::deleteVal("donefreedemo",array("time"=>$cstinfo["bookedat"],"tid"=>$data["tid"],"uid"=>$data["sid"]));
			Sqle::deleteVal("booked", array("starttime"=>$data["starttime"],"tid"=>$data["tid"],"sid"=>$data["sid"]) );
			if($cstinfo["classrqst"]==1){
				for($i=1;$i<=$dur*2;$i++)
					Sqle::deleteVal("timeslot",array("tid"=>$data["tid"],"sid"=>$data["sid"],"starttime"=>$data["starttime"]+(1800*($i-1))));
			} else {
				for($i=1;$i<=$dur*2;$i++){ 
					Sqle::updateVal("timeslot",array("sid"=>NULL,"slotrqst"=>NULL),array("tid"=>$data["tid"],"sid"=>$data["sid"],"starttime"=>$data["starttime"]+(1800*($i-1))));
				}
			}
		}
		Funs::addremmoney($data["classcharge"], -7, $data["sid"], $cstinfo);
		Fun::mailfromfile($cstinfo["studentemail"], "php/mail/classcancel_student.txt", $cstinfo);
		Fun::mailfromfile($cstinfo["teacheremail"], "php/mail/classcancel.txt", $cstinfo);
		Fun::mailfromfile($_ginfo["adminmailid"], "php/mail/classcancel_admin.txt", $cstinfo);
		Fun::msgfromfile($cstinfo["studentphone"], "php/mail/classcancel_student_msg.txt", $cstinfo);
		Fun::msgfromfile($cstinfo["teacherphone"], "php/mail/classcancel_msg.txt", $cstinfo);
		return $outp;
	}
/*................*/	
} 