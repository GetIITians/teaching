<?php
class User extends Sql{
	public static function accountTypes(){
		return array('a', 't','s');
		//a:Admin
		//u:user
	}
	public static function accountNames($t){
		$dataANames=array('a'=>'Admin','s'=>'Student','t'=>'Teacher');
		return $dataANames[$t];
	}
	public static function isValidType($t){
		return in_array($t, self::accountTypes()  );
	}
	public static function islogin(){
		if ( isset($_SESSION['login']) && isset($_SESSION['login']["id"])  && isset($_SESSION['login']["type"]) &&  $_SESSION['login']["id"] > 0   && 	self::isValidType($_SESSION["login"]["type"]))
			return $_SESSION['login'];
		else
			return false;
	}
	public static function loginType(){
		$temp=self::islogin() ;
		return ($temp ? $temp['type']:$temp);
	}
	public static function loginId(){
		$temp=self::islogin() ;
		return ($temp ? $temp['id']:$temp);
	}

	public static function logout(){
		$_SESSION['login']=null;
	}

	public static function login($id, $type){
		$temp = array("id" => $id, "type" => $type);
		sets("login", $temp);
		return $temp;
	}

	public static function isloginas($t){
		return (self::islogin() && self::loginType()==$t);
	}
	public static function isloginin($t){
		for($i=0;$i<strlen($t);$i++){
			if(User::isloginas($t[$i]))
				return true;
		}
		return false;
	}
	public static function isUserExist($email){
		$temp=Sqle::selectVal( "users","email,password",array('email'=>$email),1);
		return !($temp==null);
	}
	public static function isValidSignUp($data){
		return (preg_match("/\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/",$data['email']) && 	$data['password']!="" && self::isValidType($data['type']) );
	}
	public static function isValidSignUpData($data){
		if(!self::isValidSignUp($data))
			return 0;//not valid input
		else if(self::isUserExist($data['email']))
			return -1;//account already exist.
		else
			return 1;//yes, This is valid SignUpable data.
	}
	public static function signUp($data){//email,password,type keys are compulsary !!
		global $_ginfo;
		$data['create_time']=$data['update_time']=time();
		if(!self::isValidSignUp($data))
			return -3;//not valid input
		else if(self::isUserExist($data['email']))
			return -16;//account already exist.
		else{
			$data["username"]=$data["email"];
			$ip=$_SERVER['REMOTE_ADDR'];
			$data['last_ip']=$ip;
			$data['profilepic']="photo/human1.png";
			$temp=array('id'=>Sqle::insertVal('users',$data),'type'=>$data['type']);
			$_SESSION['login']=$temp;
			return $temp;
		}
	}
/* BY YOGY*/	
public static function updateMob($data){
		global $_ginfo;
		$data['update_time']=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$data['last_ip']=$ip;
		$temp=array('id'=>Sqle::updateVal('users',$data,array("id"=>User::loginId())),'type'=>$data['type']);
		return $temp;
	}
/* ..... */	
	public static function signIn($email,$password){
		$temp=Sqle::selectVal("users",'id,type,password,conf',array('email'=>$email),1);
		if($temp==null)
			return -6;//account not exist
		else if($temp['password']!=$password)
			return -4;//password didn't matched !
		else if($temp['conf']=='d')
			return -21;//Your account is deactivated ! 
		else{
			$temp=array('id'=>$temp['id'],'type'=>$temp['type']);
			$_SESSION['login']=$temp;
			return $temp;
		}
	}

	public static function changePassword($oldp=null, $newp){
		if(self::islogin()){
			$match = array('id'=>self::loginId());
			if($oldp != null) {
				$match['password'] = $oldp;
			}
			return Sqle::updateVal('users',array('password'=>$newp), $match, 1);
		}
		else
			return false;
	}
	public static function userProfile($uid){
		$uid=0+$uid;
		return $uid>0?(Sqle::selectVal("users","*",array('id'=>$uid ),1)):null;
	}
	public static function myprofile(){
		if(User::islogin())
			return self::userProfile(User::loginId());
		else
			return null;
	}
	public static function updateLoginTime(){
		$timenow=time();
		Sqle::updateVal("users",array('last_login'=>$timenow),array('id'=>User::loginId()));
	}
	public static function name($uid){
		$temp=Sqle::selectVal("users","name",array("id"=>$uid),1);
		if($temp!=null)
			return $temp["name"];
		else
			return $temp;
	}

	public static function passreset($email) {
		$uinfo = Sqle::getR("select * from users where email={email} limit 1", array("email" => $email));
		if($uinfo!=null) {
			$uinfo["password"] = Fun::encode2($uinfo["password"]);
			$reseturl = BASE."forgotPassword?".http_build_query( Fun::getflds(array("id", "password"), $uinfo) );
			$uinfo["link"] = $reseturl;
			Fun::mailfromfile($email, "php/mail/passwordreset.txt", $uinfo);
			return true;
		}
		return null;
	}

	public static function fglogin($data){//must have key, { type, data[type], email} Additional : { name, phone, email}
		if( in_array($data["type"], array("fblogin", "gpluslogin")) ){
			$ins_data=Fun::getflds(array("name", "phone", "email"), $data);
			$trylogin = Sqle::selectVal("users", "*", array( $data["type"] => $data[$data["type"]] ),1);
			if(!$trylogin) {
				$ins_data["password"] = rand(100000, 999999);
				$ins_data["type"] = "s";
				$ins_data[$data["type"]] = $data[$data["type"]];
				return User::signUp($ins_data);
			} else {
				return User::login($trylogin["id"], $trylogin["type"]);
			}
		}
	}


}
?>
