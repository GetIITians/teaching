<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function index(){
	$CI =& get_instance();
}

function active0(){
	//	$this->Adminhelp->active0();
}

function active1(){
	// Adminhelp::active1();
}

if ( ! function_exists('cleanIP'))
{
	function cleanIP($ipaddress){
		if (strpos($ipaddress,'.') !== false)
			$ipaddress = str_replace('.', '', $ipaddress);
		if (strpos($ipaddress,':') !== false)
			$ipaddress = str_replace(':', '', $ipaddress);
		if (strpos($ipaddress,'::') !== false)
			$ipaddress = str_replace('::', '', $ipaddress);
		return $ipaddress;
	}
}