<?php

class thingshimanshu extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->tempname = "Template/CI_template"; 
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
		$this->errormsg = "its only for Himanshu only.";
		$this->himanshu_id = 76;
		$this->unauthenticatepage = "Template/unauthenticatepage";
	}

	function index()
	{ 
		if(User::loginId()==$this->himanshu_id){
			$data["view_data"] = "";
			$data["view_name"] = "thingshimanshu/home";
		} else {
			$data["view_data"]["errormsg"] = $this->errormsg;
			$data["view_name"] = $this->unauthenticatepage;
		}
		$this->load->view($this->tempname,$data);
	}

	function view($id)
	{	
		if(User::loginId()==$this->himanshu_id){
			$data["view_data"]="";
			$data["view_name"] = "thingshimanshu/single_view";
			$this->db->where(array("id"=>$id));
			$data["view_data"]["thingsahimanshu_info"] =  $this->db->get("thingsahimanshu_details")->result_array()[0];
		} else {
			$data["view_data"]["errormsg"] = $this->errormsg;
			$data["view_name"] = $this->unauthenticatepage;
		}
		$this->load->view($this->tempname,$data);	
	}
}
