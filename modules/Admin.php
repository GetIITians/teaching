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
		$insertarray = Fun::getflds(array("name", "email", "phone", "source", "address", "class", "subject", "board", "caller_name","caller_rel"),$data);
		$insertarray['tution_type'] = Fun::gettutiontype($data);
		$insertarray['created_at'] = time();
		$insertarray['updated_at'] = time();
		$odata=Sqle::insertVal("caller_details",$insertarray);
		$callerarray = Fun::getflds(array("comments","teacher_id","demo_id","fees"),$data);
		$callerarray['st_id'] = $odata;
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("caller_call",$callerarray);
		$details['demostatus'] = Sqle::getA("select name from caller_demo where id = '".$data['demo_id']."'")[0]['name'];
		$tdetail = Sqle::getA("select name,phone from users where id = '".$data['teacher_id']."'")[0];
		$details['stname'] = $data['name'];
		$details['stphone'] = $data['phone'];
		$details['tename'] = $tdetail['name'];
		$details['tephone'] = $tdetail['phone'];
			if($data['demo_id']!=0){
				Fun::msgfromfile('9250303639' ,"caller_dir/mail/demo_msg_admin.txt", $details);
				Fun::msgfromfile('7838451002' ,"caller_dir/mail/demo_msg_admin.txt", $details);
			}
		return array("ec"=>1,"data"=>0);

	}

	function calldetails($data){
		$callerarray = Fun::getflds(array("st_id","teacher_id","demo_id","fees","comments"),$data);
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("caller_call",$callerarray);
		$details['demostatus'] = Sqle::getA("select name from caller_demo where id = '".$data['demo_id']."'")[0]['name'];
		$tdetail = Sqle::getA("select name,phone from users where id = '".$data['teacher_id']."'")[0];
		foreach (json_decode($data['sdetails']) as $key => $value)
			$details['st'.$key] = $value;
		$details['tename'] = $tdetail['name'];
		$details['tephone'] = $tdetail['phone'];
			
		if($data['demo_id']!=$data['demo_old_id']){
			if($data['demo_id']!=0){
				Fun::msgfromfile('9250303639' ,"caller_dir/mail/demo_msg_admin.txt", $details);
				Fun::msgfromfile('7838451002' ,"caller_dir/mail/demo_msg_admin.txt", $details);
			}
		}
		return array("ec"=>1,"data"=>0);		
	}
	///// Work Removed of this function /////
	function caller_addteacher($data){
		$str = '';
		$insertarray = Fun::getflds(array("name", "email", "phone", "address"),$data);
		$insertarray['created_at'] = time();
		$insertarray['updated_at'] = time();
		$odata=Sqle::insertVal("caller_teacher",$insertarray);
		return array("ec"=>1,"data"=>0);		
	}

	function caller_prefixmails($data){
		foreach (json_decode($data['sdetails']) as $key => $value)
			$details['st'.$key] = $value;
		foreach (json_decode($data['tdetails']) as $key => $value)
			$details['te'.$key] = $value;
		if($data['teacherc']=='true')
			Fun::mailfromfile($details["teemail"] ,"caller_dir/mail/te".$data['mailtype'].".html", $details);
		if($data['studentc']=='true')
			Fun::mailfromfile($details["stemail"] ,"caller_dir/mail/st".$data['mailtype'].".html", $details);	
		return array("ec"=>1,"data"=>0);	
	}
	function caller_sendmsg($data){
		foreach (json_decode($data['sdetails']) as $key => $value)
			$details['st'.$key] = $value;
		foreach (json_decode($data['tdetails']) as $key => $value)
			$details['te'.$key] = $value;
		if($data['email']=='true'){
			if($data['teacherc']=='true')
				Fun::mailfromfields($details["teemail"],$data['sub'],$data['msg']);
			if($data['studentc']=='true')
				Fun::mailfromfields($details["stemail"],$data['sub'],$data['msg']);	
		}
		if($data['sms']=='true'){
			if($data['teacherc']=='true')
				Fun::msgfromfields($details["tephone"],$data['msg']);
			if($data['studentc']=='true')
				Fun::msgfromfields($details["stphone"],$data['msg']);	
		}
		return array("ec"=>1,"data"=>0);	
	}

	function editcallerinfo($data){
		$insertarray = Fun::getflds(array("name", "email", "phone", "source", "address", "class", "subject", "board", "caller_name","caller_rel"),$data);
		$insertarray['tution_type'] = Fun::gettutiontype($data);
		$insertarray['updated_at'] = time();
		Sqle::updateVal("caller_details",$insertarray,array("id"=>$data['id']));
		return array("ec"=>1,"data"=>0);
	}

	function caller_delete_info($data){
		Sqle::deleteVal("caller_details",array("id"=>$data["id"]));
		Sqle::deleteVal("caller_call",array("st_id"=>$data["id"]));
		return array("ec"=>1,"data"=>0);
	}
/*.......*/	
}
?>
