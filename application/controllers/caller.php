<?php
/**
* 
*/
class Caller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Caller_model');
		$this->tempname = 'Template/CI_template'; 
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
	}

	function index()
	{
		$data["view_name"] = "Caller/index";
		$data["view_data"] = "";
		$this->load->view($this->tempname,$data);
	}

	function view($id)
	{	
		$data["view_name"] = "Caller/single_view";
		$data["view_data"]["caller_info"] = $this->General_model->get_records("caller_details",array("id"=>$id))[0];
		$data["view_data"]["teaching_info"] = $this->Caller_model->teachinginfo($id)[0]; 
		$this->load->view($this->tempname,$data);	
	}
}
