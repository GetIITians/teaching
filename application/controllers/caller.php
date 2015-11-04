<?php

class caller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->tempname = "Template/CI_template"; 
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
	}

	function index()
	{
		$data["view_name"] = "Caller/home";
		$data["view_data"] = "";
		$this->load->view($this->tempname,$data);
	}

	function view($id)
	{	
	//	$this->load->model("general_model","general");
	//	$this->load->model("caller_model","caller");
		$data["view_name"] = "Caller/single_view";
		$query = "SELECT caller_call.*,caller_teacher.* FROM `caller_call` LEFT JOIN caller_teacher ON caller_teacher.id = caller_call.teacher_id where st_id='".$id."' and caller_call.created_at = (select max(created_at) from caller_call where st_id='".$id."') ";
		$data["view_data"]["teaching_info"] =  $this->db->query($query)->result_array()[0];
		$this->db->where(array("id"=>$id));
		$data["view_data"]["caller_info"] =  $this->db->get("caller_details")->result_array()[0];
	//	$data["view_data"]["caller_info"] = $this->general->get_records("caller_details",array("id"=>$id))[0];
	//	$data["view_data"]["teaching_info"] = $this->caller->teachinginfo($id)[0]; 
		$this->load->view($this->tempname,$data);	
	}
}
