<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('adminhelp');
		$this->Adminhelp = new Adminhelp();
	}

	public function index()
	{
		$data['view_name']		=	'Admin/index';
		$data['view_data']		=	[];
		$data['nav']['active']	=	1;
		$data['nav']['tables']	=	$this->db->list_tables();
		$data['nav']['collapse']=	'';
		$this->load->view('Admin/Template/Template.php', $data);
/*
		$this->table->set_heading('Id','The Title','The Author','The Contents');

		$config['base_url']		=	'http://localhost/CodeIgniter/index.php/page/index';
		$config['total_rows']	=	$this->db->get('data')->num_rows();
		$config['per_page']		=	2;
		$config['num_links']	=	2;

		$this->pagination->initialize($config);

		$data['view_name']				=	'site_view';
		$data['header']['title']		=	'Pagination View';
		$data['view_data']['records']	=	$this->db->get(
												'data',
												$config['per_page'],
												$this->uri->segment(3)
											);	
		$this->load->view('templates/template.php', $data);
*/
	}

	public function table()
	{
		$this->load->library('pagination');
		$this->load->library('table');

		$data['view_name']			=	'Admin/table';
		$data['view_data']			=	[];
		$data['nav']['active']		=	2;
		$data['nav']['tables']		=	$this->db->list_tables();
		$data['nav']['collapse']	=	'in';

		$tableColumn = array(
			"booked"	=>	"`tid`,`starttime`,`sid`,`duration`,`feedback`,`feedbackStatus`,`c_id`,`s_id`,`t_id`,`bookedat`",
			"teachers"	=>	"`tid`,`rating`,`rating_total`,`jsoninfo`,`teachingexp`,`lang`",
			"user_query"=>	"`q_id`,`name`,`phone`,`email`,`msg`,`time`",
		);
		$columns = (array_key_exists($this->uri->segment(3), $tableColumn)) ? $tableColumn[$this->uri->segment(3)] : '*' ;
		$query						=	$this->db->query('SELECT '.$columns.' FROM '.$this->uri->segment(3));
		//$data['view_data']['debug'] = $this->db->last_query();
		$template = array(
			'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover table">'
		);
		$this->table->set_template($template);
		$data['view_data']['table'] =	$this->table->generate($query);


		$this->load->view('Admin/Template/Template.php', $data);
	}

}

?>