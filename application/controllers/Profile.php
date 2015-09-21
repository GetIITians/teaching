<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Profilehelp');
		$this->Profilehelp = new Profilehelp();
		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
		echo "string";
	}

	public function edit()
	{
		echo json_encode($this->input->post('sub'));
	}
}
?>