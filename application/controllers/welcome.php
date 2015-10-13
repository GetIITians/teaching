<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public $cururl;
	public $cleanurl;
	public function __construct(){
		parent::__construct();
		$this->cururl=Fun::getcururl();
		$this->cleanurl=Fun::getcururl(true);
	}
	public function index(){ 
		$pageinfo=array();
		Fun::issetlogout();
		/* Narayan Waraich */
		$total_users = sql::getArray("select type from users where type !='a'");
		$pageinfo['teachers'] = $pageinfo['students'] = 0;
		foreach ($total_users as $value) {
			if ($value['type'] == 't')
				$pageinfo['teachers']++;
			if ($value['type'] == 's')
				$pageinfo['students']++;
		}
		$reviews = $this->db
				->select('student.name as student,class.feedback,teacher.name as teacher,teacher.profilepic')
				->from('booked class')
				->join('users student', 'class.sid = student.id')
				->join('users teacher', 'class.tid = teacher.id')
				->where('class.feedback !=', 'NULL')
				->where('class.feedbackStatus =', 'yes')
				->where('class.feedbackHomepage =', 'yes')
				->get()
				->result_array();
		//echo $this->db->last_query();
		$pageinfo['reviews'] = $reviews;
		/* --------------- */
		$pageinfo['cst'] = Funs::cst_tree();
		/* --------------- */
		load_view('index.php',$pageinfo);
		//$arr=array("action"=>"studentBookSlots","cst"=>"6-36-421","datets"=>"1440700200","demo"=>"1","slots"=>"1-2-3","tid"=>"10");
		//handle_request($arr);
/*			$arr=array("action"=>"search",
			"blocked"=> "true",
			"class"=> "",
			"home"=> "",
			"ignoreloadonce"=> "20",
			"isloadold"=> "0",
			"lang"=> "1-2-3-4-5-6-7-8-9-10-11-12-13-14",
			"max"=> "0",
			"maxl"=> "20",
			"orderby"=> "",
			"pincode"=> "",
			"price"=> "",
			"search"=> "",
			"subject"=> "",
			"timer"=> "",
			"timeslot"=> "1-2-3-4-25-26-27-28-5-6-7-8-29-30-31-32-9-10-11-12-33-34-35-36-13-14-15-16-37-38-39-40-17-18-19-20-41-42-43-44-21-22-23-24-45-46-47-48",
			"timeslotbooked"=> "1",
			"topic"=> "",
			"topicsadded"=> "1");
		$a=new Actiondisp();
		$a->search($arr);
*/		//$arr=array("action"=>"confirm_class","sid"=>127,"tid"=>136,"starttime"=>1444026600);
		handle_request($arr);
		}
	
	public function joinus(){
		global $_ginfo;
		$pageinfo=array("issubmitted"=>false,"msg1"=>"");
		$msg="Dear IITian, welcome to getIITians please tell us something about yourself.";

		if(isset($_FILES["uploadfile_clgvarification"]) && $_FILES["uploadfile_clgvarification"]["size"]>0  ){
			$uf=Fun::uploadfile_post($_FILES["uploadfile_clgvarification"]);
			if($uf["ec"]>0)
				$_POST["calvarification"]=$uf["fn"];
		}

/*    BY YOGY     */
		if(isset($_FILES["ex_uploadfile_clgvarification"]) && $_FILES["ex_uploadfile_clgvarification"]["size"]>0  ){
			$arr=Fun::rearrangefilearray($_FILES["ex_uploadfile_clgvarification"]);	
			for($i=0;$i<count($arr);$i++) { 
				if(!empty($arr[$i]["name"])) {
					$j=$i+1;
					$uf=Fun::uploadfile_post($arr[$i],array(),'excalvari'.$j);
					if($uf["ec"]>0)
						$_POST["ex_calvarification"][]=$uf["fn"];
				}
				else {
					$_POST["ex_calvarification"][]='';	
				}

			}
		}
/* ............... */
		if(isset($_FILES["resumefile"]) && $_FILES["resumefile"]["size"]>0  ){
			$uf=Fun::uploadfile_post($_FILES["resumefile"], array(), 'resume');
			if($uf["ec"]>0)
				$_POST["resume"]=$uf["fn"];
		}

		if(Fun::isSetP("fname", "lname", "email", "phone", "password", "subother", "degreeother","branch","dob","city","zipcode","state","linkprofile","feedback")){
			
			$pageinfo["issubmitted"]=true; 
			$_POST=Fun::mergeifunset($_POST,array("degree"=>"","college"=>"","resume"=>"","calvarification"=>"","minfees"=>"","country"=>"", "teachingexp" => "", "gender" => ""));
			$_POST['name']=$_POST["fname"]." ".$_POST["lname"];
			if((gets("phone")!=$_POST["otp"] || gets("email")!=$_POST["otp_mail"] ) && $_ginfo["needsignupotp"] )
				$temp=((gets("phone")!=$_POST["otp"])? -17 : -18);
			else 
				$temp=1;
			if($temp>0) {
				$temp=User::signUp(array("name"=>$_POST["name"],"email"=>$_POST["email"],"password"=>$_POST["password"],"type"=>'t',"phone"=>$_POST["phone"],"dob"=>Fun::strtotime_t3($_POST["dob"]),"gender"=>$_POST["gender"]));
				//echo "<pre>";var_dump($_POST);echo "</pre>";
				if($temp>0){
					$datatoinsert=array("lang"=>Fun::getmulchecked($_POST,"lang",14),"teachingexp"=>$_POST["teachingexp"]);
					$datatoinsert["tid"]=$temp['id'];
					$datatoinsert["isselected"]=$_ginfo["joinus_need_to_confirm"]?'f':'t';
					//echo "<pre>";var_dump($datatoinsert);echo "</pre>";
					$adddata=Fun::getflds(array("college","subother","minfees","resume", "calvarification", "degree","degreeother","branch","city","zipcode","state","country","linkprofile","feedback","knowaboutusother"),$_POST);
/* BY YOGY*/		$adddata=Fun::mergeifunset($adddata,Fun::getarrflds(array("ex_college","ex_collegeother","ex_degree","ex_degreeother","ex_branch","ex_calvarification"),$_POST)); /*...........*/
					$adddata["sub"]=Fun::getmulchecked($_POST,"sub",6);
					$adddata["grade"]=Fun::getmulchecked($_POST,"grade",4);
					$adddata["knowaboutus"]=Fun::getmulchecked($_POST,"knowaboutus",4);
					$adddata["home"]=Fun::getmulchecked($_POST,"home",2);
					$datatoinsert["jsoninfo"]=json_encode($adddata);
					//echo "<pre>";print_r($adddata);echo "</pre>";
					$odata=Sqle::insertVal("teachers",$datatoinsert);
					$post_data = $_POST;
					Fun::mailfromfile( gi("adminmailid"), "php/mail/joinus_admin.txt", array("teachername" => $post_data["name"] ));
					Fun::mailfromfile( $post_data["email"], "php/mail/joinus_teacher.txt", array("teachername" => $post_data["name"] ));
				  	//Fun::redirect(BASE."account");
					$msg="Dear ".$_POST["name"].", thanks for contacting us. We will soon get back to you.";
					Fun::redirect(BASE."profile");
				}
			}		
			$data=json_encode($_POST);
			$fn=time()."_".$_SERVER['REMOTE_ADDR']."_".strlen($data)."";
			$uf="joinusdata/".$fn;
//      file_put_contents($uf, $data);
//      chmod($uf,0777);
		}
		else{
		}
		$pageinfo["msg"]=$msg;
		if($pageinfo["issubmitted"]==true){
			$pageinfo["msg"]="thanks for contacting us. We will soon get back to you."; 
			if($temp<0) { 
				$pageinfo["msg"]=errormsg($temp);  
			}
		} 
		load_view("joinustmp2.php",$pageinfo);
	}
	
	public function aboutus(){
		$aboutVar = array();
		load_view("aboutus.php", $aboutVar);
	}

	public function reset(){
		load_view("reset.php");
	}

	public function contactus(){
		$msg="";
		if(Fun::isSetP("name","phone","email","msg")){
			$contactus_data=Fun::getflds(array("name","phone","email","msg"),$_POST);
			$temp = User::loginId();
			if($temp) {
				$contactus_data["user_id"] = $temp;
			} else {
				$contactus_data["user_id"] = null;
			}
			
			$result = Help::contactUs($contactus_data);
			if($result>0){
				Fun::mailfromfile(gi("adminmailid"), "php/mail/contact.txt", $contactus_data);
				$msg="Thank you for contacting us. We will soon get in touch with you.<i class=\"material-icons\">insert emoticon</i>";
			}
			else
				$msg="Error submitting your query. Please try again";
		}
		$contactVar=array("msg"=>$msg);
		load_view("contactus.php",$contactVar);
	}
	public function joinusreal(){
		global $_ginfo;
		$pageinfo=array("msg"=>"");
		if(Fun::isSetP("name","iit","email","iitentryyear","password","degree","phone")){
			$temp=User::signUp(array("name"=>$_POST["name"],"email"=>$_POST["email"],"password"=>$_POST["password"],"type"=>'t',"phone"=>$_POST["phone"]));
			if($temp>0){
				$datatoinsert=Fun::getflds(array('iit','iitentryyear','degree'),$_POST);
				$datatoinsert["tid"]=$temp['id'];
				$datatoinsert["isselected"]=$_ginfo["joinus_need_to_confirm"]?'f':'t';
				$odata=Sqle::insertVal("teachers",$datatoinsert);
				Fun::redirect(BASE."account");
			}
			else{
				$pageinfo["msg"]="Error occured";
			}
		}
		$pageinfo["alliit"]=$_ginfo["alliits"];
		$pageinfo["yearjoiniit"]=Fun::oneToN(date('Y'),1980,false);
		$pageinfo["alldeg"]=$_ginfo["alldegrees"];
		load_view('joinus.php',$pageinfo);
	}


	public function login(){
		$pageinfo=array("loginmsg"=>"");
		if(Fun::isSetP("email","password")){
			$temp=User::signIn($_POST["email"],$_POST["password"]);
			if($temp>0){ 
				if(isses("redirecturl")) {
					Fun::redirect(gets("redirecturl"));
				} else {
					Fun::redirect(BASE."profile");
				}
			}
			else
				$pageinfo["loginmsg"]="Invalid email/password";
		}
		load_view("login.php",$pageinfo);
	}

	public function signup(){  
		$handle_signup=handle_request(Fun::mergeifunset($_POST, array("action"=>"signup")));
		if($handle_signup["ec"]>0) {
			Fun::redirect(BASE."profile");
		}
		$pageinfo=array();
		$pageinfo["signupmsg"]=errormsg($handle_signup["ec"],ispost("signup"));
		load_view('signup.php',$pageinfo);
	}
	
	public function cal($tid=0){
		global $_ginfo;
		$tid=Funs::gettid($tid);
		$bulkupload=handle_request(Fun::mergeifunset($_POST,array("action"=>"addrembulkts")));

		load_view("Template/top.php");
		load_view("Template/navbarnew.php");
		load_view("cal.php", Funs::get_teacher_cal_info($tid) );

		load_view("Template/footernew.php");
		load_view("popup.php",array("name"=>"timeslot"));
		load_view("Template/bottom.php");
	}
	public function topics($tid=0){
		$tid=0+$tid;
		if($tid==0)
			$tid=User::loginId();
		if(Fun::isSetP("class","subject","topic","timer","price") && User::isloginas('t') ){
			$insert_data=Fun::getflds(array("timer","price"),$_POST);
			$difarr=array("class"=>"c_id","subject"=>"s_id","topic"=>"t_id");
			foreach($difarr as $i=>$val){
				$insert_data[$val]=$_POST[$i];
			}
			$insert_data["tid"]=User::loginId();
			Sqle::insertVal("subjects", $insert_data );
			Fun::redirect($this->cururl);
	
		}
		if(Fun::isSetG("deleteid")){
			Sqle::deleteVal("subjects",array("id"=>$_GET["deleteid"],"tid"=>User::loginId()),1);
			Fun::redirect($this->cleanurl);
		}
		$cst_tree=Funs::cst_tree();
		$pageinfo=array('cst_tree'=>$cst_tree,"tid"=>$tid);
		$pageinfo["class_olist"]=Funs::cst_tree2classlist($cst_tree);
		$pageinfo["mysubj"]=Sql::getArray("select subjects.*,all_classes.classname, all_subjects.subjectname, all_topics.topicname from subjects left join all_classes on all_classes.id=subjects.c_id left join all_subjects on all_subjects.id=subjects.s_id left join all_topics on all_topics.id=subjects.t_id where tid=?",'i',array(&$tid));

		load_view("Template/top.php",$pageinfo);
		load_view("Template/navbar.php",$pageinfo);
		load_view('topics.php',$pageinfo);
		load_view("Template/footer.php",$pageinfo);
		load_view("Template/bottom.php",$pageinfo);

	}
	
	public function profile($tid=0,$tabid=1) {
		$this->load->library('uri'); 
		if (!empty($this->uri->segment(2))) {
			$tid = $this->uri->segment(2);	
		}
		if(!empty($this->uri->segment(3))) {
			$tabid = $this->uri->segment(3);
		}
		/* By Yogy */
		$pageinfo=array();
		$pageinfo["resignupmsg"]='';
		if(isset($_POST['resignup'])) {
			$handle_signup=handle_request(Fun::mergeifunset($_POST, array("action"=>"resignup")));
			if($handle_signup["ec"]<0) {
				sets("resignupmsg",errormsg($handle_signup["ec"],ispost("resignup")));
				Fun::redirect(BASE."profile/".$tid."/5");
			} else {
				Fun::redirect(BASE."profile/".$tid."/5");	
			}
		}
		if(isses("resignupmsg")) {
			$pageinfo["resignupmsg"]=gets("resignupmsg");
			unsets("resignupmsg");
		} 
		/* ...... */	

		$numtabs=6;
		global $_ginfo;
		$tid=Funs::gettid($tid);
		$tabid=max(min($numtabs,(0+$tabid)),1);
		$uprofile=User::userProfile($tid);

		if($uprofile==null){
			Fun::redirect(HOST);
		}

		if($uprofile!=null){
			$bulkupload_timeslot=handle_request(Fun::mergeifunset($_POST,array("action"=>"addrembulkts")));
			$addtopic=handle_request(Fun::mergeifunset($_POST,array("action"=>"addtopics")));
			$remtopic=handle_request(Fun::mergeifunset($_GET,array("action"=>"deltopics")));
			if(isset($_FILES["profilepic"])){
				Fun::uploadpic($_FILES["profilepic"], "profilepic", "profilepicbig", 100);
			}
			if($uprofile["type"]=='t' ){
				if(isset($_FILES["profile_upload"]) && $_FILES["profile_upload"]["size"]>0  ){
						$uf=Fun::profile_upload_file($_FILES["profile_upload"]);

						$name=preg_replace('/\\.[^.\\s]{3,4}$/', '', $bigpic);
						$pic=$name."_small.".pathinfo($_FILES['profile_upload']['name'],PATHINFO_EXTENSION);
						resizeimg($bigpic,$pic,$_ginfo['imgheight'],$_ginfo['imgwidth']);
						$sql="select * from users where id='$tid'";
						$olddata=sql::getArray($sql);
				}
				if(isset($_POST['getText']) && $_POST['getText']!='') {
						$displayte=$_POST['getText'];
						$sql="update teachers set teachermoto='$displayte' where tid='$tid'";
						sql::query($sql);
				}
				$tid=Funs::gettid($tid);
				$tabid=max(min($numtabs,(0+$tabid)),1);
				$bulkupload_timeslot=handle_request(Fun::mergeifunset($_POST,array("action"=>"addrembulkts")));
				$addtopic=handle_request(Fun::mergeifunset($_POST,array("action"=>"addtopics")));
				$remtopic=handle_request(Fun::mergeifunset($_GET,array("action"=>"deltopics")));
				$cst_tree=Funs::cst_tree();
				$topicinfo=array('cst_tree'=>$cst_tree,"tid"=>$tid);
				$topicinfo["class_olist"]=Funs::cst_tree2classlist($cst_tree);
				$topicinfo["mysubj"]=Sql::getArray("select subjects.*,all_classes.classname, all_subjects.subjectname, all_topics.topicname from subjects left join all_classes on all_classes.id=subjects.c_id left join all_subjects on all_subjects.id=subjects.s_id left join all_topics on all_topics.id=subjects.t_id where tid=?",'i',array(&$tid));
				//$pageinfo=array();
				$pageinfo["aboutinfo"]=Sqle::getR("select teachers.*, users.*, takendemo.isdonedemo from teachers left join users on users.id=teachers.tid left join ".qtable("takendemo")." on takendemo.tid = teachers.tid where teachers.tid={tid} limit 1", array("tid" => $tid, "uid" => 0+User::loginId()));
				if($pageinfo["aboutinfo"]==null){
						Fun::redirect(HOST);
				}
				$pageinfo["calinfo"]=Funs::get_teacher_cal_info($tid);
				$pageinfo["myclasses"] = Funs::get_teacher_classes($tid);
				$pageinfo["topicinfo"]=$topicinfo;
				$pageinfo["topicinfo"]["isdonedemo"] = $pageinfo["aboutinfo"]["isdonedemo"];
				$pageinfo["tid"]=$tid;
				$pageinfo["tabid"]=$tabid;
				$tempArr=explode(' ',$pageinfo['aboutinfo']['name']);
				$pageinfo['firstName']=$tempArr[0];
				$pageinfo['lastName']=$tempArr[1];
				$jsonArray=str2json($pageinfo['aboutinfo']['jsoninfo']); 
				$pageinfo['city']=$jsonArray['city'];
				$pageinfo['jsonArray']=$jsonArray;  
				$tempSubjects=Funs::extractFields($pageinfo['aboutinfo']['jsoninfo'],$_ginfo['encodeddataofteacherstable']['sub'],'sub');
				$pageinfo['subArray']=explode(' , ', $tempSubjects);
				$tempGrades=explode('-',$jsonArray['grade']);
				// foreach ($tempGrades as $value) {
				// 		$gradeArray[]=$_ginfo['encodeddataofteacherstable']['grade'][$value-1];
				// }
				$pageinfo['gradeArray']=$tempGrades;//$gradeArray;
				$tempLang=explode('-',$pageinfo['aboutinfo']['lang']);
				// foreach ($tempLang as $value) {
				// 		$langArray[]=$_ginfo['encodeddataofteacherstable']['lang'][$value-1];
				// }
				$pageinfo["ejsoninfo"] = str2json($pageinfo["aboutinfo"]["jsoninfo"]);
				$pageinfo['langArray'] = $tempLang;// $langArray;
				$pageinfo["isme"] = (User::loginId() == $tid);
				mergeifunset($pageinfo, Funs::moneyaccount($tid));
				$pageinfo["rlist"] = Sqle::getA("select * from ".qtable("allreviews")." where tid={tid} ", array("tid" => $tid));
				$pageinfo["cansee"] = (User::loginId() == $tid || User::isloginas("a"));
				$pageinfo["canedit"] = (User::loginId() == $tid);
				if(User::isloginas('s')){
					$pageinfo["st_detail"]= User::userProfile(User::loginId());
				} 
				load_view("profile.php",$pageinfo);            
			}
			else if($uprofile['type']=='s') {
				load_view("studentprofile.php",Funs::student_profile($tid));
			}            
			else if($uprofile['type']=='a') {
				load_view("adminprofile.php",Funs::admin_profile($tid, $uprofile));
			}            
		}
	}

	public function edit($tid=0){ 
		$page=array("issubmitted"=>false);
		$sql="Select * from users where id='$tid' and type='t'";
		$temp=Sql::getArray($sql);
		$sql="Select * from teachers where tid='$tid'";
		$temp1=Sql::getArray($sql);

		if(isset($_FILES["resumefile"]) && $_FILES["resumefile"]["size"]>0  ){
				$uf=Fun::uploadfile_post($_FILES["resumefile"], array(), 'resume');
				if($uf["ec"]>0)
					$_POST["resumefile"]=$uf["fn"];
		}
		if(Fun::isSetP("fname", "lname","action","subother","teachingexp","dob","city","zipcode","state","linkprofile")){
			$page["issubmitted"]=true;
			$_POST=Fun::mergeifunset($_POST,array("resume"=>"","minfees"=>"","country"=>""));

			$_POST['name']=$_POST["fname"]." ".$_POST["lname"];
			$name=$_POST['name'];
			$dob=date($_POST['dob']);

			$sql="UPDATE users SET name='$name',dob='$dob' where id='$tid'";
			Sql::query($sql);

			$lang=Fun::getmulchecked($_POST,"lang",14);
			
			//$datatoinsert["isselected"] = $_ginfo["joinus_need_to_confirm"]?'f':'t';
			$adddata['subother']=$_POST['subother'];
			$adddata['city']=$_POST['city'];
			$adddata['country']=$_POST['country'];
			$adddata['zipcode']=$_POST['zipcode'];
			$adddata['state']=$_POST['state'];
			$adddata['minfees']=$_POST['minfees'];
			$adddata['linkprofile']=$_POST['linkprofile'];
			$jsonArray=str2json($temp1[0]['jsoninfo']);
			$adddata['knowaboutusother']=$jsonArray['knowaboutusother'];
			$adddata['college'] = $jsonArray['college'];
			$adddata['degree'] = $jsonArray['degree'];
			$adddata['degreeother'] = $jsonArray['degreeother'];
			$adddata['calvarification'] = $jsonArray['calvarification'];
			$adddata['branch'] = $jsonArray['branch'];
			if($_POST['resumefile']=='')
			$_POST['resumefile']=$jsonArray['resume'];
			$adddata['resume']=$_POST['resumefile'];
			$adddata['feedback']=$jsonArray['feedback'];
			$adddata["sub"] = Fun::getmulchecked($_POST,"sub",6);
			$adddata["grade"] = Fun::getmulchecked($_POST,"grade",4);
			$adddata["home"] = Fun::getmulchecked($_POST,"home",2);
			$jsoninfo = json_encode($adddata);
			$exp=$_POST["teachingexp"];
			$sql="UPDATE teachers set teachingexp='$exp',lang='$lang',jsoninfo='$jsoninfo' where tid='$tid'"; 
			Sql::query($sql);
				// chmod($uf,0777);
		}
		load_view('joinustmp3.php',array('info'=>$temp,'tid'=>$tid,'info_t'=>$temp1,'issubmitted'=>$page['issubmitted']));
	}    
    public function edit1(){ 
    	$tid= User::loginId();
		$sql="Select * from teachers where tid='$tid'";
		$temp1=Sql::getArray($sql);
		if(Fun::isSetP("fname", "lname","dob")){ 
			$jsonArray=str2json($temp1[0]['jsoninfo']);
			$exclgcount=substr_count(implode("",array_keys($jsonArray)),"ex_collegeother");
/*    BY YOGY     */
		if(isset($_FILES["ex_uploadfile_clgvarification"]) && $_FILES["ex_uploadfile_clgvarification"]["size"]>0  ){
			$arr=Fun::rearrangefilearray($_FILES["ex_uploadfile_clgvarification"]);	
			for($i=0;$i<count($arr);$i++) { 
				if(!empty($arr[$i]["name"])) {
					$j=$i+1+$exclgcount;
					$uf=Fun::uploadfile_post($arr[$i],array(),'excalvari'.$j);
					if($uf["ec"]>0)
						$_POST["ex_calvarification"][]=$uf["fn"];
				}
				else {
					$_POST["ex_calvarification"][]='';	
				}

			}
		}
/* ............... */
			$_POST['name']=$_POST["fname"]." ".$_POST["lname"];
			$name=$_POST['name'];
			$dob=Fun::strtotime_t3($_POST["dob"]);
			$sql="UPDATE users SET name='$name',dob='$dob' where id='$tid'";
			Sql::query($sql);
			$lang=Fun::getmulchecked($_POST,"lang",14);
			$adddata['subother']=$_POST['subother'];
			$adddata['city']=$_POST['city'];
			$adddata['country']=$_POST['country'];
			$adddata['zipcode']=$_POST['zipcode'];
			$adddata['state']=$_POST['state'];
			$adddata['minfees']=$jsonArray['minfees'];
			$adddata['linkprofile']=$jsonArray['linkprofile'];
			$adddata['knowaboutusother']=$jsonArray['knowaboutusother'];
			$adddata['college'] = $jsonArray['college'];
			$adddata['degree'] = $jsonArray['degree'];
			$adddata['degreeother'] = $jsonArray['degreeother'];
			$adddata['calvarification'] = $jsonArray['calvarification'];
			$adddata['branch'] = $jsonArray['branch'];
			$adddata['resume']=$jsonArray['resume'];
			$adddata['feedback']=$jsonArray['feedback'];
			$adddata["sub"] = Fun::getmulchecked($_POST,"sub",6);
			$adddata["grade"] = Fun::getmulchecked($_POST,"grade",4);
			$adddata["home"] = Fun::getmulchecked($jsonArray,"home",2);
			$adddata=	Fun::mergeifunset($adddata,Fun::getsamenameflds($jsonArray,array("ex_college","ex_collegeother","ex_degree","ex_degreeother","ex_branch","ex_calvarification"),$exclgcount));
			$adddata=Fun::mergeifunset($adddata,Fun::getarrflds(array("ex_college","ex_collegeother","ex_degree","ex_degreeother","ex_branch","ex_calvarification"),$_POST,$exclgcount)); /*...........*/
			print_r($adddata);
			$jsoninfo = json_encode($adddata);
			$sql="UPDATE teachers set lang='$lang',jsoninfo='$jsoninfo' where tid='$tid'"; 
			Sql::query($sql);
		}
		Fun::redirect(BASE."profile");
	}

	public function search(){

		global $_ginfo;
		$cst_tree=Funs::cst_tree();
		$class_olist=Funs::cst_tree2classlist($cst_tree);
		$pageinfo["class_olist"]=$class_olist;
		$pageinfo["cst_tree"]=$cst_tree;
		$pageinfo["allts"]=Funs::timeslotlist_t2();
		$pageinfo["lang"]=Funs::doublesplit($_ginfo['encodeddataofteacherstable']["lang"]);
		$pageinfo["price"]=Funs::doublesplit($_ginfo['price']);
		$pageinfo["timer"]=Funs::doublesplit($_ginfo['timer']);
		$pageinfo["search"]=$pageinfo["class"]=$pageinfo["subject"]=$pageinfo["topic"]="";
		if ($this->uri->segment(2)) {
			foreach ($cst_tree as $class_id => $class_details) {
				// If referred by homepage dropdown
				if($class_details['name'] == $this->uri->segment(2)) {
					$pageinfo["class"] = (string)$class_id;
					if ($this->uri->segment(3)) {
						foreach ($class_details['children'] as $subject_id => $subject_details) {
							if ($subject_details['name'] == str_replace('_', ' ', $this->uri->segment(3))) {
								$pageinfo["subject"] = (string)$subject_id;
								if ($this->uri->segment(4)) {
									foreach ($subject_details['children'] as $topic_id => $topic_details) {
										if($topic_details['name'] == str_replace('_', ' ', $this->uri->segment(4))){
											$pageinfo["topic"] = (string)$topic_id;
										}
									}
								}
							}
						}
					}
				}
			}
		}
		$pageinfo["search"] = get("q","");
		load_view("search_old.php",$pageinfo);
	}



	//Made by ::Himanshu Rohilla::
	public function acceptOrReject($tid = 0){
		$sql="SELECT * from teachers LEFT JOIN users ON users.id=teachers.tid";
		$arrResult=array();
		if($tid != 0)
			$sql="select * from teachers,users where teachers.tid=users.id and tid=$tid";
		$result=Sql::getArray($sql);
		$arrResult=array("result"=>$result, "tid"=>$tid);
		load_view("acceptOrReject.php",$arrResult);

		if(Fun::isSetP("check")){
			$compareFields=$_POST['check'];
			$compareFields=implode("-", $compareFields);
			//self::compareMany($compareFields);
			echo '<script>window.location.href = "'.BASE.'compareMany/'.$compareFields.'"</script>';
		}
	}
	//Made by ::Himanshu Rohilla::
	public function accept($tid){
		$sql="UPDATE teachers set isselected='a' where tid=$tid";
		$result=Sql::query($sql);
		echo '<h3>You accepted this user<br><br></h3>';
		self::view($tid);
	}
	//Made by ::Himanshu Rohilla::
	public function reject($tid){
		$sql="UPDATE teachers set isselected='r' where tid=$tid";
		$result=Sql::query($sql);
		echo '<h3>You rejected this user<br><br></h3>';
		self::view($tid);
	}
	//Made by ::Himanshu Rohilla::
	public function view($tid){
		$sql="select * from teachers,users where teachers.tid=users.id AND users.id=$tid";
		$result=Sql::getArray($sql);
		load_view("viewuser.php",array('result'=>$result));
		echo '<b><a style="margin-left:10px;font-size:30px;" href="'.(BASE."acceptOrReject").'" style="font-size:30px;">Go Back</a></b>';
	}
	public function compareMany($tidString){
		$tidArray=explode("-", $tidString);
		$i=0;
		foreach($tidArray as $id){
			$sql="select * from teachers,users where teachers.tid=users.id AND users.id=$id";
			$result[$i++]=Sql::getArray($sql);
		}
		load_view("compare.php",array('result'=>$result));
	}
	public function testCSV(){
		$csvVar=array();
		load_view("testCSV.php",$csvVar);
	}
	public function confirmSlots($date){
		$date = date('d-m-Y', strtotime($date));
		$startdate = $date.' 00:00:00';
		$startstamp=strtotime($startdate);
		$enddate = $date.' 23:59:59';
		$endstamp=strtotime($enddate);
		$id=User::loginId();
		$sql="select * from timeslot where tid=$id";
		$table=sql::getArray($sql);
		$finalrows=array();
		foreach($table as $row){
			if($row['starttime']>=$startstamp && $row['starttime']<$endstamp)
				$finalrows[]=$row['starttime'];
		}

		load_view("confirmSlots.php",array('finalrows'=>$finalrows,'timeslots'=>Funs::timeslotlist(true)));
	}

	public function forgotPassword() {
		$pageinfo = array();
		$uinfo = User::userProfile(get("id"));
		if($uinfo!=null && Fun::encode2($uinfo["password"] ) == get("password")  ) {
			sets("login", array("id" => $uinfo["id"], "type" => $uinfo["type"] ));
			load_view("forgotPassword.php", array());
		} else {
			Fun::redirect(HOST);
		}
	}
	public function changepassword(){
		$pageinfo=array();
		$cphandle=handle_request(Fun::setifunset($_POST,"action","changepassword"));
		$pageinfo['cpmsg']=errormsg($cphandle["ec"],ispost("changepassword"));
		load_view("changepass.php",$pageinfo);
	}
	public function account(){
		$pageinfo=array('cpmsg'=>'');
		load_view("changepass.php",$pageinfo);
	}
				public function review($tid) {
				$sql="select * from reviews where tid=$tid";
				$allreviews=sql::getArray($sql);
				//finalArray is the array which we are passing in our view
				$m=0;
				$sid=User::loginId();
				foreach ($allreviews as $key => $value) {
						$finalArray[$m]['content']=$value['content'];
						$finalArray[$m]['time']=date("M d, Y h:i A",strtotime($value['time']));
								$id=$value['sid'];
								$sql="select * from users where id=$id";
								$temp=sql::getArray($sql);
						$finalArray[$m]['sname']=$temp[0]['name'];
						$finalArray[$m]['id']=$value['id'];
								$id=$value['id'];
								$sql="select count(sid) from likes where rid=$id and like_dislike='-1'";
								$temp=sql::getArray($sql);
						$finalArray[$m]['dislike']=$temp[0]['count(sid)'];
								$sql="select count(sid) from likes where rid=$id and like_dislike='1'";
								$temp=sql::getArray($sql);
						$finalArray[$m]['like']=$temp[0]['count(sid)'];
								$sql="select count(*) from likes where sid='$sid' and rid='$id'";
								$temp=sql::getArray($sql);
						if($temp[0]['count(*)']>0)
								$finalArray[$m]['disableTag']=true;
						else
								$finalArray[$m]['disableTag']=false;
						$id=$value['tid'];
						$m++;
				}
				$sql="select * from users where id=$id";
				$temp=sql::getArray($sql);
				load_view("review.php",array('finalArray'=>$finalArray,'tname'=>$temp[0]['name']));
		}
	public function myslots($tid) {
		if(isset($_FILES["timeslot_upload"]) && $_FILES["timeslot_upload"]["size"]>0){
			$uf=Fun::uploadfiles_t2($_FILES["timeslot_upload"]);
			$filelink="";
			foreach($uf['fn'] as $key => $value) {
				if($key==0)
					$filelink=$value;
				else
					$filelink=$filelink.','.$value;
			}
			foreach ($uf['message'] as $key => $value) {
				echo $value[$key].'<br>';
			}
			if($uf['count']>0){
				$count=$uf["count"];
				echo '<b>'.$count.' files uploaded succesfully.<br></b>';
			}
			if(isset($_POST['slotid'])) {
				foreach ($_POST['slotid'] as $key => $value) {
					if($value!='')
						$times=$value;
				}
			}
			$sql="select testfiles from timeslot where tid='$tid' and starttime='$times'";
			$previousdatafiles=sql::getArray($sql);
			$previousdatafiles=$previousdatafiles[0]['testfiles'];
			if($previousdatafiles!='' && $filelink!='')
				$filelink=$previousdatafiles.','.$filelink;
			if($filelink!='') {
				$sql="update timeslot set testfiles='$filelink' where tid='$tid' and starttime='$times'";
				sql::query($sql);
			}
		}
		if(isset($_FILES["timeslot_uploadsoln"]) && $_FILES["timeslot_uploadsoln"]["size"]>0){
			$uf=Fun::uploadfiles_t2($_FILES["timeslot_uploadsoln"]);
			$filelink="";
			foreach($uf['fn'] as $key => $value) {
				if($key==0)
					$filelink=$value;
				else
					$filelink=$filelink.','.$value;
			}
			foreach ($uf['message'] as $key => $value) {
				echo $value[$key].'<br>';
			}
			if($uf['count']>0){
				$count=$uf["count"];
				echo '<b>'.$count.' files uploaded succesfully.<br></b>';
			}
			if(isset($_POST['slotid'])) {
				foreach ($_POST['slotid'] as $key => $value) {
					if($value!='')
						$times=$value;
				}
			}
			$sql="select solnfiles from timeslot where tid='$tid' and starttime='$times'";
			$previousdatafiles=sql::getArray($sql);
			$previousdatafiles=$previousdatafiles[0]['solnfiles'];
			if($previousdatafiles!='' && $filelink!='')
				$filelink=$previousdatafiles.','.$filelink;
			if($filelink!='') {
				$sql="update timeslot set solnfiles='$filelink' where tid='$tid' and starttime='$times'";
				sql::query($sql);
			}
		}

		$sql="select * from timeslot where tid='$tid'";
		$temp=sql::getArray($sql);
		load_view("fileupload.php",array('temp'=>$temp,'tid'=>$tid));   
	}
	public function deleteFile($firstArg,$secondArg,$thirdArg,$type) {
		$tempArray=explode(',', $thirdArg);
		$file=$firstArg.'/'.$secondArg.'/'.$tempArray[0];
		$starttime=$tempArray[1];
		$tid=$tempArray[2];
		$sql="select * from timeslot where tid='$tid' and starttime='$starttime'";
		$temp=sql::getArray($sql);
		$testfiles=$temp[0][$type];
		$tempArray=explode(',', $testfiles);
		$finalFiles="";
		foreach ($tempArray as $key => $value) {
			if($value==$file)
				$finalFiles=$finalFiles;
			else{
				if($finalFiles!='')
					$finalFiles=$finalFiles.','.$value;
				else
					$finalFiles=$value;
			}
		}
		if($type=='testfiles')
			$sql="update timeslot set testfiles='$finalFiles' where tid='$tid' and starttime='$starttime'";
		else if($type=='solnfiles')
			$sql="update timeslot set solnfiles='$finalFiles' where tid='$tid' and starttime='$starttime'";
		sql::query($sql);
		unlink($finalFiles);
		header('Location:'.BASE.'myslots/'.$tid);
	}

	public function studentprofile() {
		load_view("studentprofile.php",array());
	}

  public function hiring() {
    load_view("hiring.php",array());
  }
  
  	public function privacypolicy() {
    	load_view("privacypolicy.php",array());
  	}
  
  	public function termsofuse() {
    	load_view("terms.php",array());
  	}
  
  	public function reviews() {
    	load_view("review.php",array());
  	}
	public function rating(){
		$total_no_of_ratings 	=	(int)($this->input->post('rating_count') ? $this->input->post('rating_count') : 0);
		$rating_avg 			=	(float)($this->input->post('rating_avg') ? $this->input->post('rating_avg') : 0);
		$uid 					=	(int)$this->input->post('uid');
		$tid 					=	(int)$this->input->post('tid');
		$rating 				=	(int)$this->input->post('rating');
		$prev_rating			=	(int)$this->input->post('previous_rating');
		$rating_id 				=	(int)($this->input->post('rating_id') ? $this->input->post('rating_id') : NULL);

		if($prev_rating == 0)
		{
			$data_rating 		= array(
				'user_id'		=> $uid,
				'teacher_id'	=> $tid,
				'rating'		=> $rating
				);
			$this->db->insert('rating', $data_rating);
			$last_insert_id 	= $this->db->insert_id();


			$new_average_rating = round(((($rating_avg*$total_no_of_ratings)+$rating)/($total_no_of_ratings+1)),2);

			$data_teachers 		= array(
				'rating' 		=> $new_average_rating,
				'rating_total' 	=> ($total_no_of_ratings+1)
				);
			$this->db->where('tid', $tid);
			$this->db->update('teachers', $data_teachers);

			$reply = array(
				'previous_rating' 	=> $rating,
				'rating_count' 		=> ($total_no_of_ratings+1),
				'rating_avg' 		=> $new_average_rating,
				'tid' 				=> $tid,
				'rating_id' 		=> $last_insert_id
				);
			echo json_encode($reply);
		}
		elseif($prev_rating > 0)
		{
			$data_rating 	= array(
				'rating'	=> $rating
				);
			$this->db->where('id', $rating_id);
			$this->db->update('rating', $data_rating);

			$new_average_rating = round((((($rating_avg*$total_no_of_ratings)-$prev_rating)+$rating)/$total_no_of_ratings),2);
			$data_teachers 		= array(
				'rating' 		=> $new_average_rating,
				'rating_total' 	=> $total_no_of_ratings
				);
			$this->db->where('tid', $tid);
			$this->db->update('teachers', $data_teachers);

			$reply = array(
				'previous_rating' 	=> $rating,
				'rating_count' 		=> $total_no_of_ratings,
				'rating_avg' 		=> $new_average_rating,
				'tid' 				=> $tid,
				'rating_id' 		=> $rating_id
				);
			echo json_encode($reply);
		}
	}

	public function approve_review(){
		$tid 		=	$this->input->post('tid');
		$starttime 	=	$this->input->post('starttime');
		$dbColumn 	=	$this->input->post('dbColumn');

		$data 		= 	array(
			$dbColumn	=>	'yes'
		);
		$this->db->where('tid', $tid);
		$this->db->where('starttime', $starttime);
		$this->db->update('booked', $data);

		echo "successfull";
	}

	public function wiziq_status(){
		var_dump($_POST);
		var_dump($_POST['form']);
	}

	public function narayan(){

	$t_id 	= 832;
	for ($s_id=119; $s_id < 119; $s_id++) {
		$data = array(
			'c_id' => '11',
			's_id' => $s_id,
			't_id' => $t_id
		);
		$this->db->insert('all_cst', $data);
		$t_id++;
	}


	}
}

?>