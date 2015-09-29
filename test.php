<?php
include "includes/app.php";
/*
		$string = "Aerospace Engineering
		Agricultural and Food Engineering
		Applied Geology
		Applied Geophysics
		Applied Mathematics
		Architecture
		Biochemical Engineering and Biotechnology
		Biological Engineering
		Biological Sciences
		Biologically-inspired Systems Science
		Biotechnology
		Ceramic Engineering
		Chemical Engineering
		Chemical Science and Technology
		Chemistry
		Civil Engineering
		Civil and Infrastructure Engineering
		Computer Science and Engineering
		Design
		Economics
		Electrical Engineering
		Electronics and Communication Engineering
		Electronics and Electrical Communication Engineering
		Electronics and Electrical Engineering
		Electronics and Instrumentation Engineering
		Electronics Engineering
		Energy Engineering
		Engineering Design
		Engineering Physics
		Engineering Science
		Environmental Engineering
		Exploration Geophysics
		Geological Technology
		Geophysical Technology
		Industrial Chemistry
		Industrial Engineering
		Instrumentation Engineering
		Manufacturing Science and Engineering
		Material Science and Metallurgical Engineering
		Materials Science and Engineering
		Materials Science and Technology
		Mathematics and Computing
		Mathematics and Scientific Computing
		Mechanical Engineering
		Metallurgical and Materials Engineering
		Metallurgical Engineering
		Metallurgical Engineering and Materials Science
		Mineral Engineering
		Mining Engineering
		Mining Machinery Engineering
		Mining Safety Engineering
		Naval Architecture and Ocean Engineering
		Petroleum Engineering
		Pharmaceutics
		Physics
		Polymer Science and Technology
		Process Engineering
		Production and Industrial Engineering
		Quality Engineering Design and Manufacturing
		Systems Science
		Textile Technology";

		$pieces	= explode("\n", $string);
		$id 	= 771;
		echo "<pre>";var_dump(count($pieces));echo "</pre>";
		foreach ($pieces as $value) {
			$data = array(
				'id' => $id,
				'topicname' => trim(preg_replace('/\s+/', ' ', $value))
			);
			echo "<pre>";var_dump($data['topicname']);echo "</pre>";
			//$this->db->insert('all_topics', $data);
			$id++;
		}
*/
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

/*
		$t_id 	= 773;
		for ($s_id=60; $s_id < 119; $s_id++) {
			$data = array(
				'c_id' => '10',
				's_id' => $s_id,
				't_id' => $t_id
			);
			$this->db->insert('all_cst', $data);
			$t_id++;
		}

*/
//$cst = Funs::cst_tree();
//echo "<pre>";var_dump(Funs::cst_tree());echo "</pre>";
//echo "<pre>";var_dump(site_url());echo "</pre>";

echo "<pre>";var_dump(phpinfo());echo "</pre>";