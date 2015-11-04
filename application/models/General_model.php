<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class general_model extends CI_Model
{
		function add_record($table_name,$data) 
	{
		$this->db->insert($table_name, $data);
		return;
	}

	function get_records($table_name,$clau=NULL,$orderby=NULL,$limit=NULL,$offset=NULL)
	{ 	if(!empty($orderby)) 
			$this->db->order_by($orderby[0],$orderby[1]);
		if(!empty($clau)) 
			$this->db->where($clau);
		return $this->db->get($table_name,$limit,$offset)->result_array();
	}
	
	function update_record($table_name,$data)
	{	
		$this->db->where('id',$data['id'])->update($table_name,$data);
		return true;
	}

	function delete_record($table_name,$id)
	{
		$this->db->where('id',$id)->delete($table_name);
		return true;

	}

		function check_email_exist($tablename,$email)
	{
		$query = "SELECT id from $tablename WHERE email = '$email'";
		$arr = $this->db->query($query)->row();
		if(!empty($arr))
			return $arr->id;
		else
			return false;
	}

}




?>