<?php

class things extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->tempname = "Template/CI_template"; 
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
		$this->unauthenticatepage = "Template/unauthenticatepage";
	}

	function index()
	{
		$data["view_data"] = "";
		if(User::isloginas('a')){
		$data["view_name"] = "Things/home";
		$this->load->view($this->tempname,$data);
		}	
		else{
			$data["view_name"] = $this->unauthenticatepage; 
			$this->load->view($this->tempname,$data);
		}
	}

	function view($id)
	{	$data["view_data"]="";
		if(User::isloginas('a')){
		$data["view_name"] = "Things/single_view";
		$this->db->where(array("id"=>$id));
		$data["view_data"]["thingsa_info"] =  $this->db->get("thingsa_details")->result_array()[0];
		$this->load->view($this->tempname,$data);	
		}	
		else{
			$data["view_name"] = $this->unauthenticatepage; 
			$this->load->view($this->tempname,$data);
		}
	}
}
