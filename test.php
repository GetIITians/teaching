<?php
include "includes/app.php";

/*
	function wiziqtime() {
		return date("Y-m-d H:i", now());
	}
	function wiziq() {
		global $_ginfo;
		$secretAcessKey="A9m0hoLiBLlixWgBgpUVuw==";
		$access_key="f0fWFgPNdys=";

		// $data["tmid"]="saini@mail.com";
		// $data["class_title"]="Timepass";
		// $data["s_time"]="2015-05-19 15:30";

		$webServiceUrl="http://class.api.wiziq.com/";

		$obj = new getTeacher();
		return $obj->getTeacher($secretAcessKey,$access_key,$webServiceUrl,[]);
	}

	var_dump(wiziq());

*/

$query = "select accountbalance.mymoney, users.name as teachername, users.email as teacheremail,users.phone as teacherphone, users1.name as studentname, users1.email as studentemail,users1.phone as studentphone, subjectlist.* from ".qtable("subjectlist")." left join users on users.id = {tid} left join users as users1 on users1.id = {sid} left join ".qtable("accountbalance")." on accountbalance.uid = {sid} where c_id = 5 AND s_id = 22 AND t_id = 247 AND tid={tid} ";
$cstinfo = Sqle::getR($query, array("sid" => User::loginId(), "tid" => '19'));

echo "<pre>";var_dump($cstinfo);echo "</pre>";