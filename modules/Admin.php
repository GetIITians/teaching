<?php
class Admin{
	function acceptrej($data){
		//fb($data,'row',FirePHP::LOG);
		$odata = array('ec'=>1, 'data'=>0);
		$odata = Sqle::updateVal("teachers", array("isselected"=>$data["isselected"]), array("tid"=>$data["tid"]));
		$t_cntr=array();
		$total_teacher=Sqle::getRow("select count(*) as teacher from teachers");
		$accepted_teacher=Sqle::getRow("select count(*) as teacher from teachers where isselected='a'");
		$t_cntr['nooft']=$accepted_teacher['teacher'].'/'.$total_teacher['teacher'];
		Fun::mailfromfile( gi("adminmailid"), (($data["isselected"]=='a') ? "php/mail/accept.txt":"php/mail/reject.txt"),$t_cntr);
		$tinfo = User::userProfile($data["tid"]);
		if($data["isselected"]=='a'){
		Fun::mailfromfile( $tinfo["email"] , (($data["isselected"]=='a') ? "php/mail/accept_teacher.txt":"php/mail/reject_teacher.txt"), $tinfo);
		}
		return $odata;
	}

	function addmoney($data) {
		$outp = array("ec" => 1, "data" => 0);
		$uinfo = User::userProfile( $data["uid"] );
		if($uinfo!=null) {
			$uinfo["amount"] = $data["money"];
			Funs::addremmoney(-$data["money"], -6, User::loginId(), Fun::mergeforce($uinfo, array("mailto" => gi("adminmailid"))), "php/mail/transfer_admin.txt");
			Funs::addremmoney($data["money"], -2, $data["uid"], Fun::mergeforce($uinfo, array("mailto" => $uinfo["email"] )), "php/mail/transfer_st.txt") ;
		} else {
			$outp["ec"] = -25;
		}
		return $outp;
	}
/* By Yogy*/
	function delteachers($data){ 
		Sqle::deleteVal("users",array("id"=>$data["deleteid"]),1);
		Sqle::deleteVal("teachers",array("tid"=>$data["deleteid"]));
		Sqle::deleteVal("timeslot",array("tid"=>$data["deleteid"]));
		Sqle::deleteVal("subjects",array("tid"=>$data["deleteid"]));
		Sqle::deleteVal("booked",array("tid"=>$data["deleteid"]));
		Sqle::deleteVal("donefreedemo",array("tid"=>$data["deleteid"]));
		Sqle::deleteVal("moneyaccount",array("uid"=>$data["deleteid"]));
		Sqle::deleteVal("rating",array("teacher_id"=>$data["deleteid"]));
		return array("ec"=>1,"data"=>0);
	}
	function delstudents($data){ 
		Sqle::deleteVal("users",array("id"=>$data["deleteid"]),1);
		Sqle::updateVal("timeslot",array("sid"=>null),array("sid"=>$data["deleteid"]));
		Sqle::deleteVal("booked",array("sid"=>$data["deleteid"]));
		Sqle::deleteVal("donefreedemo",array("uid"=>$data["deleteid"]));
		Sqle::deleteVal("moneyaccount",array("uid"=>$data["deleteid"]));
		return array("ec"=>1,"data"=>0);
	}

	function sendteachermails($data){
		$emails = json_decode($data['emails']);
		$phones = json_decode($data['phones']);
		if($data['cemail'] == 'true'){
			foreach($emails as $email)
				FUN::mailfromfields($email,$data['title'],$data['msg']);
		}
		if($data['csms'] == 'true'){
			foreach($phones as $phone)
				FUN::msgfromfields($phone,$data['msg']);
		}
		return array("ec"=>1,"data"=>0);	
	}

	function callerinfo($data) {
		$str = '';
		$insertarray = Fun::getflds(array("name", "email", "phone", "address", "class", "subject", "grade", "board", "caller_name","caller_rel"),$data);
		$insertarray['tution_type'] = Fun::getutiontype($data);
		$insertarray['created_at'] = time();
		$insertarray['updated_at'] = time();
		$odata=Sqle::insertVal("caller_details",$insertarray);
		$callerarray = Fun::getflds(array("comments","teacher","demo","fees"),$data);
		$callerarray['st_id'] = $odata;
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("caller_call",$callerarray);
		return array("ec"=>1,"data"=>0);

	}

	function calldetails($data){
		$callerarray = Fun::getflds(array("st_id","teacher","demo","fees","comments"),$data);
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("caller_call",$callerarray);
		return array("ec"=>1,"data"=>0);		
	}
/*.......*/	
}
?>
