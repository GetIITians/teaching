<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public $css = array(
			"css/materialize.css",
			"css/custom-stylesheet.css",
			"css/jquery.bxslider.css",
			"css/bootstrap.min.css",
			"css/glyphicon.css",
			"css/google-icons.css"
		);

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('help');
		$this->load->model('blog_model');
		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
		$data['top']['css'] = $this->css;
		$data['navbar']['page'] = 'blog';

		$this->load->library('pagination');
		$config['base_url']		=	site_url('blog');
		$config['total_rows']	=	$this->db->get('blogpost')->num_rows();
		$config['per_page']		=	2;
		$config['uri_segment']	=	'2';
		$this->pagination->initialize($config);
		
		$data['records'] = $this->db->get('blogpost', $config['per_page'], $this->uri->segment(2))->result_array();

		$this->load->view('Blog/home', $data);
	}

	public function view()
	{
		$data['top']['css'] = $this->css;
		$data['navbar']['page'] = 'blog';

		$this->db->where('slug',$this->uri->segment(2));
		$data['records'] = $this->db->get('blogpost')->result_array();

		$this->load->view('Blog/post', $data);
		
	}

}