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
/*.......*/	
}
?>
