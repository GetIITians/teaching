<?php 
/**
* 
*/
class Caller_model extends CI_model
{
	function teachinginfo()
	{
		$query = "SELECT * FROM `caller_call` where st_id=1 and created_at = (select max(created_at) from caller_call where st_id=1)";
		return $this->db->query($query)->result_array();
	}

}



?>