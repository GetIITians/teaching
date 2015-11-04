<?php 
/**
* 
*/
class Forum extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("General_model","general");
		$this->load->model("Forum_model","forum");
		$this->tempname = "Template/CI_template"; 
		$this->config->set_item('enable_query_strings', FALSE);
		$this->load->helper('help_helper');
	}

	function index()
	{	$data["view_name"] = "forum/index";
		$data["view_data"]["questions"] = $this->forum->getQueDetails();
		$this->load->view($this->tempname,$data);
	}

	function ask() 
	{
		$data["view_name"] = "forum/ask";
		$data["view_data"]["que_title"] = $this->input->post("title");
		$this->load->view($this->tempname,$data);
	}

	function submitQue()
	{ 	
		$data["uid"] = $this->general->check_email_exist("forum_users",$this->input->post("email"));
		if(!$data["uid"]) {
			$this->general->add_record("forum_users",array("email" => $this->input->post("email")));
			$data["uid"] = $this->db->insert_id();
		}
		$data["title"] = $this->input->post("title");
		$data["slug"] = slug_maker($data["title"]);
		$data["des"] = $this->input->post("des");
		$data["asktime"] = time();
		$this->general->add_record("forum_questions",$data);
		redirect(base_url().'forum');
		
	}

	function answer($queid,$queslug='',$ansid=NULL)
	{ 
		$data["view_name"] = "forum/answers";
		$data["view_data"]["question"] = $this->general->get_records("forum_questions",array('id'=>$queid));
		$data["view_data"]["answers"] = $this->forum->getAnsDetails($queid,$ansid);
		$this->load->view($this->tempname,$data);
	}

	function submitAns()
	{
		$data["tid"] = $this->input->post("tid");
		$data["qid"] = $this->input->post("qid");
		$data["ans"] = $this->input->post("ans");
		$data["anstime"] = time();
		$this->general->add_record("forum_answers",$data);
		redirect(site_url('forum/answer/'.$data["qid"]));
	}
	function check_user()
	{
		if($this->input->post('ajax')) {
			$uid = $this->general->check_email_exist("users",$this->input->post("email"));
			if($uid) 
				$this->load->view('forum/emailexist');
		}
	}
}




?>