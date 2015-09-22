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
		echo str_replace('.', '', $this->input->ip_address());

	}

	public function doubt()
	{
		$data = json_decode($this->input->post('content'),true);
		$data['user_id'] = str_replace('.', '', $this->input->ip_address());

		//Call the Home_model.php's insert function

		//Funs::sendmail($to, $subject, $body);
		echo json_encode($content);
	}
}
?>