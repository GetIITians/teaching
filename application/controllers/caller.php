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
	{	$data["view_data"]="";
		if(User::isloginas('a')){
		$data["view_name"] = "Caller/single_view";
		$this->db->where(array("id"=>$id));
		$data["view_data"]["caller_info"] =  $this->db->get("caller_details")->result_array()[0];
		}	
		else
			$data["view_name"] = $this->unauthenticatepage; 
		$this->load->view($this->tempname,$data);
	}
}
