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