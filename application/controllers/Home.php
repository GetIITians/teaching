<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Help');
		$this->Help = new Help();
		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
		echo "string";
	}

	public function doubt()
	{
		$content = json_decode($this->input->post('content'));


		//Funs::sendmail($to, $subject, $body);
		echo json_encode($content);
	}
}
?>