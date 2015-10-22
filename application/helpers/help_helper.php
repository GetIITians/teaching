<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

if( ! function_exists('slug_maker')) {
	function slug_maker($str) {
		$arr = explode(' ',strtolower(preg_replace('/[^A-Za-z0-9\-\ ]/', '', $str))); 
		if(count($arr)>10) {
			for($i=0;$i<10;$i++) 
				$slugarr[] = $arr[$i];
		} else 
			$slugarr = $arr;
		return implode("-",$slugarr);
	}
}
if(! function_exists('whereclause')) {
	function whereclause($fieldname,$value) {
		if(!empty($value))
			return $fieldname.'='.$value;
		else
			return true;	
	}
}

 

