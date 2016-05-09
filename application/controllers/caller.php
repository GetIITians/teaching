<?php

class caller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->tempname = "Template/CI_template";
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
		$this->unauthenticatepage = "Template/unauthenticatepage";
	}

	function index($t_id=Null)
	{   $data["view_data"] = "";
		if(User::isloginas('a')){
		$data["view_name"] = "Caller/home";
		$data["view_data"]['t_id'] = $t_id;
		}
		else
			$data["view_name"] = $this->unauthenticatepage;
		$this->load->view($this->tempname,$data);
	}

	function view($id)
	{
		$data["view_data"]="";
		if(User::isloginas('a')){
			$data["view_name"] = "Caller/single_view";
			$this->db->where(array("id"=>$id));
			$data["view_data"]["caller_info"] =  $this->db->get("caller_details")->result_array()[0];
			$prevnext = $this->db->query("SELECT (SELECT id FROM caller_details WHERE id < ".$id." ORDER BY id DESC LIMIT 1) AS previd,( SELECT id FROM caller_details WHERE id > ".$id." ORDER BY id ASC LIMIT 1) AS nextid")->result()[0];
			$data["view_data"]["previous"] = (is_null($prevnext->previd)) ? HOST.'caller' : HOST.'caller/view/'.$prevnext->previd ;
			$data["view_data"]["next"] = (is_null($prevnext->nextid)) ? HOST.'caller' : HOST.'caller/view/'.$prevnext->nextid ;
		}	else {
			$data["view_name"] = $this->unauthenticatepage;
		}
//			$this->db->where(array("id"=>$id));
//			var_dump($this->db->get("caller_details")->result_array());
//			var_dump($this->db->query("SELECT (SELECT id FROM caller_details WHERE id < ".$id." ORDER BY id DESC LIMIT 1) AS previd,( SELECT id FROM caller_details WHERE id > ".$id." ORDER BY id ASC LIMIT 1) AS nextid")->result()[0]);
		$this->load->view($this->tempname,$data);
	}
}
