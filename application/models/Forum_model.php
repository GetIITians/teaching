<?php 
/**
* 
*/
class Forum_model extends CI_model
{
	function getQueDetails()
	{
		$query = "SELECT forum_questions.*,forum_users.email AS useremail,users.name AS username,answers.countans FROM forum_questions LEFT JOIN forum_users ON forum_questions.uid=forum_users.id LEFT JOIN users ON forum_users.email=users.email LEFT JOIN (SELECT qid ,COUNT(ans) AS countans FROM forum_answers ) AS answers ON answers.qid=forum_questions.id ORDER BY forum_questions.asktime DESC";
		return $this->db->query($query)->result_array();
	}

	function getAnsDetails($queid)
	{
		$query = "SELECT forum_answers.*,users.name AS teachername FROM forum_answers LEFT JOIN users ON  forum_answers.tid=users.id WHERE forum_answers.qid=$queid ORDER BY forum_answers.anstime DESC";
		return $this->db->query($query)->result_array();
	}
	
}



?>