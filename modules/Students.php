<?php
class Students{
	function bookslotfinal($data){//need to change them.
		$need=array('tid','daytime',"slot" );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			Sqle::updateVal("timeslot",array("sid"=>User::loginId(),"conf"=>"t"),array("tid"=>$data["tid"],"daytime"=>$data["daytime"],"slot"=>$data["slot"],"sid"=>0 ));
			$time=Fun::timetostr($data["daytime"]+3600*$data["slot"] );
			Fun::notf( $data["tid"],"php/notf/n1.txt" , array("Student name"=>User::name(User::loginId()),"time"=>$time ) );
			Fun::notf( User::loginId(),"php/notf/n2.txt" , array("Teacher Name"=>User::name($data["tid"]),"time"=>$time ) );
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function feedbackform_student($data){//need to change them.
		$need=array('tid','daytime',"slot","rate","feedback" );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$constrain= Fun::getflds(array("tid","slot","daytime"),$data);
			$constrain["sid"]=User::loginId();
			$odata=Sqle::updateVal("timeslot", Fun::getflds(array("rate","feedback"),$data)   , $constrain  );
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function studentBookSlots($data) { 
		global $_ginfo;
		$outp = array("ec" => 1, "data" => 0);
		$inpslots = intexplode("-", $data["slots"]);
		$bookedslots = grouplist( $inpslots );
		list($c_id, $s_id, $t_id) = intexplode("-", $data["cst"]);
		$dbpush = array();
/* by yogy */
		$query="select * from timeslot where sid=".User::loginId()." AND (".Fun::starttimeconsstu($data['datets'],$inpslots).")";	
		if(count(Sqle::getA($query))!=0) {
			$outp["ec"] = "-30";
		} else {
/* ...... */
		$query = "select accountbalance.mymoney, users.name as teachername, users.email as teacheremail,users.phone as teacherphone, users1.name as studentname, users1.email as studentemail,users1.phone as studentphone, subjectlist.* from ".qtable("subjectlist")." left join users on users.id = {tid} left join users as users1 on users1.id = {sid} left join ".qtable("accountbalance")." on accountbalance.uid = {sid} where c_id = $c_id AND s_id = $s_id AND t_id = $t_id AND tid={tid} ";
		$cstinfo = Sqle::getR($query, array("sid" => User::loginId(), "tid" => $data["tid"]));
		if($cstinfo==null) {
			$outp["ec"] = "-28";
		} else {
			foreach($bookedslots as $i => $row) {
			$timetotime[] = Fun::timetotime_t3($data["datets"]+($row[0]-1)*1800);
			$dispdur[] = '('.number_format(($row[1]*1800)/3600.0 , 1)." hr)";
			} 
			$cstinfo['stimes']=yogyimplode(", "," and ",conmerge($timetotime,$dispdur));
			$cstinfo["priceused"] = floor(($cstinfo["price"]*count($inpslots))/2);
			$isdonedemo = (Sqle::selectVal("donefreedemo", "*", array("tid" => $data["tid"], "uid" => User::loginId()), 1) != null );
			if( $cstinfo["priceused"] > $cstinfo["mymoney"] && $isdonedemo ) {
				$outp["ec"] = "-29";
			} else {
				$cstinfo["date"] = Fun::timetodate($data["datets"]);
				if($isdonedemo) {
					Funs::addremmoney(-$cstinfo["priceused"], -1, null, $cstinfo);
				} else {
					Sqle::insertVal("donefreedemo", array("tid" => $data["tid"], "uid" => User::loginId(), "time" => time()));
				}
				Fun::mailfromfile($cstinfo["studentemail"], "php/mail/classbook_student.txt", $cstinfo);
				Fun::mailfromfile($cstinfo["teacheremail"], "php/mail/classbook.txt", $cstinfo);
				Fun::mailfromfile($_ginfo["adminmailid"], "php/mail/classbook_admin.txt", $cstinfo);
				Fun::msgfromfile($cstinfo["studentphone"], "php/mail/classbook_student_msg.txt", $cstinfo);
				Fun::msgfromfile($cstinfo["teacherphone"], "php/mail/classbook_msg.txt", $cstinfo);
				foreach($bookedslots as $i => $row) {
					$starttime = $data["datets"]+($row[0]-1)*1800;
					$duration = $row[1]*1800;
					if( !gi("isrealwiziq") ) {
						$wiziqo = null;
					} else {
						$wiziqo = Funs::wiziq(array("action" => "tryaddclass", "s_time" => $starttime, "duration" => $duration ));
					}
					$insrow = array($data["tid"], $starttime, User::loginId(), $duration, $c_id, $s_id, $t_id, getval("curl", $wiziqo), getval("surl", $wiziqo), getval("rurl", $wiziqo), getval("cid", $wiziqo), time() );
					$dbpush[] = $insrow;
				}
				foreach($inpslots as $i => $val) {
					Sqle::updateVal("timeslot", array("sid" => User::loginId()), array("tid" => $data["tid"], "starttime" => $data["datets"]+($val-1)*1800 ));
				}

				$query = "insert into booked (tid, starttime, sid, duration, c_id, s_id, t_id, url, surl, rurl, class_id, bookedat) ".Fun::makeDummyTableColumns($dbpush, null, "iiiiiiissssi")."";
				$outp["data"] = Sqle::q( $query );
			}
		}
	}
		return $outp;
	}

	public static function review($data) {
		$outp = array("ec" => 1, "data" => 0);
		$data["sid"] = User::loginId();
		$slotinfo = Sqle::getR("select * from ".qtable("bookedclasses")." where starttime={starttime} AND tid={tid} AND sid={sid}", $data);
		if($slotinfo!=null) {
			Funs::addremmoney($slotinfo["classcharge"], -5, $data["tid"], $slotinfo);
			$outp["data"] = Sqle::updateVal("booked", Fun::getflds( array("feedback", "rate"), $data), Fun::setifunset( Fun::getflds( array("tid", "starttime"), $data ), "sid", User::loginId() )  );
			$stinfo = Sqle::getR("select users.name as teachername, users.email as temail, users1.name as studentname, users1.email as semail from users, users as users1 where users.id={tid} AND users1.id={sid} limit 1" , $data);
			Fun::mailfromfile($stinfo["temail"], "php/mail/review_teacher.txt", $stinfo);
			Fun::mailfromfile($stinfo["semail"], "php/mail/review_student.txt", $stinfo);
			Fun::mailfromfile(gi("adminmailid"), "php/mail/review_admin.txt", $stinfo);
		}
		return $outp;
	}
/* By Yogy*/	
function resignup($data){
		global $_ginfo;
		$outp=array("ec"=>1,"data"=>0);
		if((gets("phone")!=$data["otp"] ) && $_ginfo["needsignupotp"] ){
			$outp["ec"]=-17;
		} else {
			$update_mob_data=Fun::getflds(array("phone"),$data);
			$update_mob_data["type"]="s";
			$temp=User::updateMob($update_mob_data);
			if(!($temp>0)){
				$outp["ec"]=$temp;
			}
		}
		return $outp;
	}
/* .... */	
}