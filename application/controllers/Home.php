<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('help');
		$this->load->model('home_model','homedb');

		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
	}

	public function doubt()
	{
		$data = json_decode($this->input->post('content'),true);
		$data['user_id'] = (int)("00".cleanIP($this->input->ip_address()));

		echo ($this->homedb->insert($data)) ? "true" : "false" ;

		//Funs::sendmail($to, $subject, $body);
	}
}
?>