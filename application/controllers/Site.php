<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('General');
		$this->General = new General();
		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
	}
}
?>