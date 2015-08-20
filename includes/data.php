<?php

$view_default=array(
	"Template/top.php"=>array(
	  "css"=>array("css/materialize.css","css/custom-stylesheet.css","css/jquery.bxslider.css",
	  	"css/bootstrap.min.css","css/glyphicon.css","css/google-icons.css"),
		"title"=>array(
					'index'		=>	'Get IITians',
					'aboutus'	=>	'Get IITians',
					'contactus'	=>	'Get IITians',
					'joinus'	=>	'Get IITians',
					'signup'	=>	'Get IITians',
					'login'		=>	'Get IITians',
					'reset'		=>	'Get IITians',
					'profile'	=>	'Get IITians',
					'search'	=>	'Get IITians',
				)
		),
	'Template/bottom.php'=>array(
		"needpopup"=>true,
		"needbody"=>true
		),
	'Template/table.php'=>array(
		"width" => null,
		"height" => null,
		"func" => null,
		"rows" => array()
	),
	"popup.php"=>array(
		"title"=>"This popup is made in India",
		"body"=>"",
		"bodyinfo"=>array(),
		"footer"=>"",
		"footerinfo"=>array(),
		"name"=>"",
		'stylebody'=>'',
		'stylemain'=>'min-width:200px;'
	),
	"Template/cutecheckbox.php"=>array(
		"onchange"=>"",
		"id"=>"",
		"label"=>"Check",
		"class"=>"",
		"inpattr"=>array("value"=>""),
//		"divattr"=>array("style"=>"margin-top:-28px;padding:0px;margin-bottom:-28px;"),
		"divattr"=>array("style"=>"")
	),
	"Template/check1.php"=>array(
		"onchange"=>"",
		"id"=>"",
		"label"=>"Check",
		"class"=>"",
		"name"=>"",
		"value"=>"",
		"inpattr"=>array(),
		"divattr"=>array("style"=>"")
	)
);
$_ginfo=array();
$_ginfo["attributes"]=array("name","value","style","class","id","type","ph","onclick","dc",'rows',"disabled","align","valign","action","autofocus","style","rel","type","href","value","src","selected","target","for","checked");
$_ginfo["attrs_shortcut"]=array("ph"=>"placeholder","dc"=>"data-condition");
$_ginfo["alliits"]=array('Delhi', 'Kharagpur', 'Kanpur', 'Bombay', 'Madras', 'Roorkee', 'Guwhati', 'Ropar', 'Bhuvneshwar', 'Hydrabad', 'Gandhinagar', 'Patna', 'Rajsthan', 'Mandi', 'Indore', 'BHU,Varanasi', 'ISM Dhanbad');
$_ginfo["alldegrees"]=array('B.Tech', 'M. Tech', 'Phd', 'M.B.A', 'M.Sc.');
$_ginfo["languages"]=array("English","Hindi","Tamil","Chiness");//need to delete it.
$_ginfo['encodeddataofteacherstable'] = array('sub'=>array("Mathematics","Physics","Chemistry","Biology","Science(6-10)","Others"),'grade'=>array("6th to 8th","9th to 10th","11th to 12th","IIT JEE"),'lang'=>array("English","Hindi","Assamese","Sanskrit","Bengali","Mayalayam","Tamil","Gujarati","Marathi","Telugu","Oriya","Urdu","Kannada","Punjabi"),'known'=>array("Facebook","Email","Friends","Others"),'home'=>array("Yes","No"));
//changes by himanshu
$_ginfo["weekdays_long"]=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$_ginfo["month"]=array("January","February","March","April","May","June","July","August","September","October","November","December");
$_ginfo['end_year']=2025;
//changed ends
$_ginfo["action_constrain"]=array(
	"cofirmotp"=>array("need"=>array("otp")),
	"mohit"=>array("need"=>array("month","year")),
	"teacherModifySlots"=>array("need"=>array("datets","slots")),
	"addrembulkts"=>array("need"=>array("time","days","startdate","enddate")),
	"addtopics"=>array("need"=>array("class","subject","topic","timer","price")),
	"deltopics"=>array("need"=>array("deleteid")),
	"signupotp"=>array("need"=>array("phone", "type")),
	"signup"=>array("need"=>array("email","password","name","phone","otp")),
	"changepassaction"=>array("need"=>array("oldpass","newpass","newcpass")),
	"saveuserdetails"=>array("users"=>"all"),
	"studentBookSlots" => array("datets", "slots", "cst"),
	"disptopics" => array("need" => array("tid")),
	"updatebio" => array("need" => array("teachermoto")),
	"addmoney" => array("need" => array("uid", "money")),
	"review" => array("need" => array("starttime", "feedback", "tid", "rate")),
	"acceptrej" => array("need" => array("tid", "isselected")),
	"adminprofile_users" => array("users" => array("a")),
	"forgotpass" => array("need" => array("email"))
);


$_ginfo["error"]=array(
	"-1"=>"Session expired",
	"-2"=>"You are not right person to perform this action.",
	"-3"=>"Incorrect formate of input",
	"-4"=>"Password incorrect",
	"-5"=>"Username doesn't exist",
	"-6"=>"Email id not registered",
	"-7"=>"Action handler not defined",
	"-8"=>"Session expired or You are not right person to perform this action.",
	"-9"=>"Not sufficient arguments.",
	"-16"=>"This email id used Already",
	"-17"=>"Phone OTP is incorrect",
	"-18"=>"Email OTP is incorrect",
	"-19"=>"You cannot choose slot of past.",
	"-20"=>"You Cannot generate link",
	"-21"=>"Your account deactivated",
	"-22"=>"Nobody is login",
	"-23"=>"File not uploaded",
	"-24"=>"You cannot do so much repeatition.",
	"-25"=>"Error",
	"-25"=>"Subject Already Added",
	"-26"=>"Password cant be changed",
	"-27"=>"Wiziq Error",
	"-28"=>"No Such CST exist",
	"-29"=>"You don't have sufficient money in your account.",

	"1"=>"Positive"
);
$_ginfo["calrepeatlimit"]=365;
$_ginfo["wiziqlimit"]=3;
$_ginfo["needotp"] = true;
$_ginfo["needsignupotp"] = true;
$_ginfo['imgheight']=200;
$_ginfo['imgwidth']=200;

$_ginfo["price"]=array(
		array('<1000','price<1000'),
		array('1000-2000','1000<=price AND price<=2000'),
		array('>2000','2000<=price'),
	);

$_ginfo["timer"]=array(
		array('<1 hr','timer<1'),
		array('1-5 hr','1<=timer AND timer<=5'),
		array('>5 hr','5<timer'),
	);

$_ginfo["numsearchr"]=array("loadonce"=>20, "loadadd"=>10);

$_ginfo["moneyaccount"] = array(
	"-1" => "You booked class of {classname}, {subjectname}, {topicname} with teacher {teachername} ",
	"-2" => "Admin added in your account",
	"-3" => "You have received by Admin",
	"-4" => "{studentname} booked your class on {date}",
	"-5" => "You taught class of {classname}, {subjectname}, {topicname} to {studentname} ",
	"-6" => "You added in account of {name}({type})"
);

$_ginfo['teacherJsoninfo']=array("college","subother","minfees","resume", "calvarification", "degree","degreeother","branch","city","zipcode","state","country","linkprofile","feedback","knowaboutusother","sub","grade","knowaboutus","home");
$_ginfo['teacherInfo']=array("tid","iit","iitentryyear","degree","experience","addinfo","isselected","rate","youtubelink","jsoninfo","teachingexp","lang","teachermoto");
$_ginfo['teacherJsoninfolist']=array('sub','grade','lang');




$_ginfo["adminmailid"] = "himanshu@getiitians.com";


$_ginfo["isrealmail"] = (server == "server");
$_ginfo["isrealmsg"] = (server == "server");
$_ginfo["isrealwiziq"] = (server == "server");




?>