<?php 
/**
* 
*/
class Forum extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("General","general");
		$this->load->model("Forum_model","forum");
		$this->tempname = "Template/CI_template"; 
		$this->config->set_item('enable_query_strings', FALSE);
	}

	function index()
	{	$data["view_name"] = "forum/index";
		$data["view_data"]["questions"] = $this->forum->getQueDetails();
		print_r($data["view_data"]["questions"]);
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
		$this->general->add_record("forum_users",array("email" => $this->input->post("email")));
		$data["uid"] = $this->db->insert_id();
		$data["title"] = $this->input->post("title");
		$data["des"] = $this->input->post("des");
		$data["asktime"] = time();
		$this->general->add_record("forum_questions",$data);
		redirect(base_url().'forum');
		
	}

	function answers($queid)
	{
		$data["view_name"] = "forum/answers";
		$data["view_data"]["question"] = $this->general->get_records("forum_questions",array('id'=>$queid));
		$data["view_data"]["answers"] = $this->forum->getAnsDetails($queid);
		$this->load->view($this->tempname,$data);
	}

	function submitAns()
	{
		$data["tid"] = $this->input->post("tid");
		$data["qid"] = $this->input->post("qid");
		$data["ans"] = $this->input->post("ans");
		$data["anstime"] = time();
		$this->general->add_record("forum_answers",$data);
		redirect(site_url('forum/answers/'.$data["qid"]));
	}
}




?>