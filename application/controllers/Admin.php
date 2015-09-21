<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('adminhelp');
		$this->Adminhelp = new Adminhelp();
		$this->config->set_item('enable_query_strings', FALSE);
	}

	public function index()
	{
		$data['view_name']		=	'Admin/home';
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
		$this->load->helper('form');

		$data['view_name']			=	'Admin/table';
		$data['view_data']			=	[];
		$data['nav']['active']		=	2;
		$data['nav']['tables']		=	$this->db->list_tables();
		$data['nav']['collapse']	=	'in';

		$data['view_data']['tableName'] = $tableName = $this->uri->segment(3);

		$config['base_url']		=	site_url('admin/table/'.$tableName);
		$config['total_rows']	=	$this->db->get($tableName)->num_rows();
		$post_per_page = $this->input->post('per_page');
		if (!isset($_SESSION['admin']['per_page'])) $_SESSION['admin']['per_page'] = 10;
		$data['view_data']['per_page'] = $config['per_page'] = ($post_per_page) ? (($post_per_page !== 'all') ? $post_per_page : $config['total_rows']) : $_SESSION['admin']['per_page'] ;
		$_SESSION['admin']['per_page'] = $config['per_page'];
		$config['uri_segment']	=	'4';

		$this->pagination->initialize($config);

		$order_by = array(
				'all_cst' => 'c_id',
				'booked' => 'bookedat',
				'donefreedemo' => 'time',
				'teachers' => 't_id',
				'timeslot' => 'starttime',
				'user_query' => 'q_id'
			);

		if (!isset($_SESSION['admin'][$tableName]['orderby'])) $_SESSION['admin'][$tableName]['orderby'] = '';
		$field = $this->input->post('orderby');
		$data['view_data']['orderby'] = $orderby = ($field) ? $field : $_SESSION['admin'][$tableName]['orderby'] ;
		$_SESSION['admin'][$tableName]['orderby'] = $orderby;

		//var_dump($_SESSION['admin'][$tableName]['orderbyoption']);
		if (!isset($_SESSION['admin'][$tableName]['orderbyoption'])) $_SESSION['admin'][$tableName]['orderbyoption'] = 'ASC';
		$data['view_data']['orderbyoption'] = $orderbyoption = ($this->input->post('asc')) ? $this->input->post('asc') : (($this->input->post('desc')) ? $this->input->post('desc') : 'ASC' );
		$_SESSION['admin'][$tableName]['orderbyoption'] = $orderbyoption;
		//var_dump($_SESSION['admin'][$tableName]['orderbyoption']);

		$tableColumn = array(
			"booked"	=>	"tid,starttime,sid,duration,feedback,feedbackStatus,c_id,s_id,t_id,bookedat",
			"teachers"	=>	"tid,rating,rating_total,jsoninfo,teachingexp,lang",
			"user_query"=>	"q_id,name,phone,email,msg,time",
		);
		$columns = (array_key_exists($tableName, $tableColumn)) ? $tableColumn[$tableName] : '*' ;
		$this->db->select($columns);
		if ($orderby != '') {
			$this->db->order_by($orderby, $orderbyoption);
		}
		$data['view_data']['records'] = $this->db->get($tableName, $config['per_page'], $this->uri->segment(4));
		$data['view_data']['fields'] = (array_key_exists($tableName, $tableColumn)) ? explode(',',$tableColumn[$tableName]) : $this->db->list_fields($tableName) ;

		$template = array(
			'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover table">'
		);
		$this->table->set_template($template);

		$this->load->view('Admin/Template/Template.php', $data);
	}

}

?>