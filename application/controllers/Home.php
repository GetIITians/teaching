<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('help');

		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
	}

	public function doubt()
	{
		$data = json_decode($this->input->post('content'),true);
		$data['user_id'] = 12345;

		if ($this->db->insert('user_query', $data)) {
			Fun::mailfromfile(gi("adminmailid"), "php/mail/doubt.txt", $data);
			$message = "Thank you for contacting us. Our represntative will get back to you as soon as possible.";
			Funs::sendmail($data['email'], 'Thank you for contacting getIITians', $message);
			echo "true";
		} else {
			echo "false";
		}
	}

	public function joinus()
	{
		global $_ginfo;
		$pageinfo=array("issubmitted"=>false,"msg"=>"Dear IITian, welcome to getIITians please tell us something about yourself.");
	}
}
?>