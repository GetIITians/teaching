<?php
class Actions {

//For Not login people

	function fillotp($data){
		$need=array('otp');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			if(isset($_SESSION["signupdata"]) && $_SESSION["signupdata"]["otp"]==$data["otp"]){
				$info=$_SESSION["signupdata"];
				$temp=User::signUp(array('type'=>'t','email'=>$info['email'],'password'=>$info['password'],'name'=>$info["name"],"phone"=>$info["phone"] ));
				if($temp>0){
					$datatoinsert=Fun::getflds(array('experience','addinfo','iit','iitentryyear','degree'),$info);
					$datatoinsert["tid"]=$temp['id'];
					$datatoinsert["isselected"]=($info["sec"]=="1"?'t':'f');
					$odata=Sqle::insertVal("teachers",$datatoinsert);
					$_SESSION['login']=$temp;
				}
				else
					$ec=-18;
			}
			else
				$ec=-17;
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

	function teacherreg($data){
		$need=array('name','email','phone','password','experience','addinfo','iit','iitentryyear','degree',"sec");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$data['type']='t';
			if(!User::isValidSignUp($data))
				$ec=-3;
			else if(User::isUserExist($data['email']))
				$ec=-16;
			else{
				$data['otp']=rand(1000000,9999999);
				$_SESSION["signupdata"]=$data;
				Fun::mailfromfile($data["email"],"php/mail/m1.txt",array("name"=>$data["name"],"otp"=>$data["otp"]));
				$ec=1;
			}
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function teacherregcreatea($data){
		$need=array('name','email','phone','password','experience','addinfo','iit','iitentryyear','degree');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$temp=User::signUp(array('type'=>'t','email'=>$data['email'],'password'=>$data['password'],"phone"=>$data["phone"],"address"=>$data["address"]));
			if($temp>0){
				$datatoinsert=Fun::getflds(array('experience','addinfo','iit','iitentryyear','degree'),$data);
				$datatoinsert["tid"]=$temp['id'];
				$odata=Sqle::insertVal("teachers",$datatoinsert);
			}
			else
				$ec=$temp;
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function sendotp($data){//this function is not used.
		$need=array("phone");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$otp=rand(100000,999999);
			sets("phone",$otp);
			Fun::mailfromfile($data["phone"],"php/mail/otp.txt",array("otp"=>$otp));
			Fun::msgfromfile($data["phone"],"php/mail/otp.txt",array("otp"=>$otp));
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

	function signupotp($data){
		$outp=array("ec"=>1,"data"=>0);
		$outp["ec"]=Funs::otpstore($data["phone"], ($data["type"]=='s' ? $data["name"] : $data["fname"]),$data["email"] );
		return $outp;
	}
	function resignupotp($data){
		$outp=array("ec"=>-5,"data"=>0);
		$outp["ec"]=Funs::otpstore($data["phone"], ($data["type"]=='s' ? $data["name"] : $data["fname"]));
		
		return $outp;
	}
	function confirmotp($data){//this function is not used.
		$outp=array("ec"=>1,"data"=>0);
		if(gets("phone")!=$data["otp"])
			$outp["ec"]=-17;
		return $outp;
	}
	function mohit($data){
		$outp=array("ec"=>1,"data"=>0);
		$outp["data"]=array(11,33,$data["month"]);
		return $outp;
	}
	function signup($data){
		global $_ginfo;
		$outp=array("ec"=>1,"data"=>0);
		if((gets("phone")!=$data["otp"] || gets("email")!=$data["otp_mail"] ) && $_ginfo["needsignupotp"] ){
			$outp["ec"]=((gets("phone")!=$data["otp"])? -17 : -18);
		} else {
			$signup_data=Fun::getflds(array("phone","name","email","password"),$data);
			$signup_data["type"]="s";
			$temp=User::signUp($signup_data);
			if(!($temp>0)){
				$outp["ec"]=$temp;
			} else {
				Fun::mailfromfile( $signup_data["email"], "php/mail/signupmail.txt", $signup_data );
				Fun::mailfromfile( gi("adminmailid"), "php/mail/signup_admin.txt", $signup_data);
			}
		}
		return $outp;
	}
	function changepassword($data){
		$outp=array("ec"=>1,"data"=>0);
		if(!User::changePassword($data["opassword"],$data["npassword"]))
			$outp["ec"]=-26;
		return $outp;
	}
	function saveuserdetails($data){
		$outp=array("ec"=>1,"data"=>0);
		$canneed=array("name", "email", "phone", "gender", "dob");
		$toupdate=Fun::getflds($canneed, $data);
		$myf=User::userProfile(null, array("email"=>getval("email",$toupdate,'')));
		if(isset($toupdate["email"]) && !( $myf==null || $myf["id"]==$data["uid"] )){
			$outp["ec"] = -16;
		} else{
			$outp["data"] = Sqle::updateVal("users",$toupdate,array("id"=>User::loginId()));
		}
		return $outp;
	}

	function forgotpass($data) {
		$outp = array("ec"=>1,"data"=>0);
		if(!(User::passreset($data["email"]))) {
			$outp["ec"] = -6;
		}
		return $outp;
	}

	function resetpass($data) {
		$outp = array("ec"=>1, "data"=>0);
		$outp["data"] = User::changePassword( null,  $data["password"] );
		return $outp;
	}
/* By Yogy */
	function emailexist($data) {
		$outp = array("ec"=>1, "data"=>0);
		if(User::isUserExist($data['email']))
			$outp["ec"]=-16;
		return $outp;
	}
	/*	Things for all*/
	function thingseinfo($data) {
		$insertarray = Fun::getflds(array("category", "responsibility", "start", "end"),$data);
		$insertarray["details"] = Fun::getthingfrmt($data['details'],'w');
		$insertarray['created_at'] = time();
		$insertarray['start'] = strtotime($insertarray['start']);
		$insertarray['end'] = strtotime($insertarray['end']);
		$odata=Sqle::insertVal("thingse_details",$insertarray);
		$insertarray["responsibility"] = Fun::getfname($insertarray["responsibility"]);
		$insertarray["details"] = Fun::getthingfrmt($data['details'],'m');
		$insertarray["duration"] = gmdate("H:i", $insertarray['end']-$insertarray['start']);
		$insertarray['started'] = date("H:i", $insertarray['start']);
		$insertarray['ended'] = date("H:i", $insertarray['end']);
		Fun::msgfromfile(Fun::getuserno("Himanshu Jain"),"caller_dir/mail/thingsdone_admin.txt", $insertarray);
		Fun::msgfromfile(Fun::getuserno("Anupriya Jain"),"caller_dir/mail/thingsdone_admin.txt", $insertarray);
		return array("ec"=>1,"data"=>0);
	}
	function thingsahisdetails($data){
		$tahisarray = Fun::getflds(array("td_id","status","comments"),$data);
		$tahisarray['created_at'] = time();
		$odata = Sqle::insertVal("thingsa_hisdetails",$tahisarray);
		$getarray = Sqle::getA("Select * from thingsa_details where id =".$data['td_id'])[0];
		if(Fun::getuserno($getarray["responsibility"]) && $data['status'] == "Allotted"){
			$getarray['due_date'] = date('d-M-Y',$getarray['due_date']);
			Fun::msgfromfile(Fun::getuserno($getarray["responsibility"]),"caller_dir/mail/emp_msg.txt", $getarray);
		}
		return array("ec"=>1,"data"=>0);		
	}

		function thingsa_delete_info($data){
		Sqle::deleteVal("thingsa_details",array("id"=>$data["id"]));
		Sqle::deleteVal("thingsa_hisdetails",array("td_id"=>$data["id"]));
		return array("ec"=>1,"data"=>0);
	}
	function thingsainfo($data) {
		$insertarray = Fun::getflds(array("category", "details", "responsibility"),$data);
		$insertarray['due_date'] = strtotime($data['due_date']);
		$insertarray['created_at'] = time();
		$insertarray['updated_at'] = time();
		$odata=Sqle::insertVal("thingsa_details",$insertarray);
		$callerarray = Fun::getflds(array("status","comments"),$data);
		$callerarray['td_id'] = $odata;
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("thingsa_hisdetails",$callerarray);
		
		if(Fun::getuserno($insertarray["responsibility"]) && $data['status'] == "Allotted"){
			$insertarray['due_date'] = date('d-M-Y',$insertarray['due_date']);
			Fun::msgfromfile(Fun::getuserno($insertarray["responsibility"]),"caller_dir/mail/emp_msg.txt", $insertarray);
		}
		return array("ec"=>1,"data"=>0);
	}
	function editthingsainfo($data){
		$insertarray = Fun::getflds(array("category", "details", "responsibility","due_date"),$data);
		$insertarray['due_date'] = strtotime($data['due_date']);
		$insertarray['updated_at'] = time();
		Sqle::updateVal("thingsa_details",$insertarray,array("id"=>$data['id']));
		return array("ec"=>1,"data"=>0);
	}
	/*	Things for all*/

	/*	Things for Himanshu(copy)*/
	function thingsehimanshuinfo($data) {
		$insertarray = Fun::getflds(array("category", "responsibility",),$data);
		$insertarray["details"] = Fun::getthingfrmt($data['details'],'w');
		$insertarray['created_at'] = time();
		$odata=Sqle::insertVal("thingsehimanshu_details",$insertarray);
		return array("ec"=>1,"data"=>0);
		
	}
	function thingsahimanshuhisdetails($data){
		$tahisarray = Fun::getflds(array("td_id","status","comments"),$data);
		$tahisarray['created_at'] = time();
		$odata = Sqle::insertVal("thingsahimanshu_hisdetails",$tahisarray);
		return array("ec"=>1,"data"=>0);		
	}

	function thingsahimanshu_delete_info($data){
		Sqle::deleteVal("thingsahimanshu_details",array("id"=>$data["id"]));
		Sqle::deleteVal("thingsahimanshu_hisdetails",array("td_id"=>$data["id"]));
		return array("ec"=>1,"data"=>0);
	}

	function thingsahimanshuinfo($data) {
		$insertarray = Fun::getflds(array("category", "details", "responsibility"),$data);
		$insertarray['due_date'] = strtotime($data['due_date']);
		$insertarray['created_at'] = time();
		$insertarray['updated_at'] = time();
		$odata=Sqle::insertVal("thingsahimanshu_details",$insertarray);
		$callerarray = Fun::getflds(array("status","comments"),$data);
		$callerarray['td_id'] = $odata;
		$callerarray['created_at'] = time();
		$odata = Sqle::insertVal("thingsahimanshu_hisdetails",$callerarray);
		return array("ec"=>1,"data"=>0);
	}
	function editthingsahimanshuinfo($data){
		$insertarray = Fun::getflds(array("category", "details", "responsibility","due_date"),$data);
		$insertarray['due_date'] = strtotime($data['due_date']);
		$insertarray['updated_at'] = time();
		Sqle::updateVal("thingsahimanshu_details",$insertarray,array("id"=>$data['id']));
		return array("ec"=>1,"data"=>0);
	}

	/*	Things for Himanshu(copy)*/

/* .......*/
}
?>
