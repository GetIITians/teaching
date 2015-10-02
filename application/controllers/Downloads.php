<?php

class Downloads extends CI_Controller {
	
	public $css = array(
			"css/materialize.css",
			"css/custom-stylesheet.css",
			"css/jquery.bxslider.css",
			"css/bootstrap.min.css",
			"css/glyphicon.css",
			"css/google-icons.css"
		);

	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
		$this->config->set_item('enable_query_strings', FALSE);
		$this->data['top']['css'] = $this->css;
		$this->data['navbar']['page'] = 'downloads';

	}

	public function index()
	{

		$this->data["downloads"]= directory_map('download/', FALSE, TRUE);
		$this->load->view('Downloads/home', $this->data);
	}

	public function view() 
	{  
		$this->data["authorname"]=directory_map('download/'.urldecode($this->uri->segment(2)),FALSE,TRUE);
		$this->load->view('Downloads/view',$this->data);

	}


}



?>