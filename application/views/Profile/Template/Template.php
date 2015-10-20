<?php 
	$this->load->view('Template/top');
	$this->load->view('Template/navbarnew');
	$this->load->view($view_name, $view_data);
	$this->load->view('Template/footer');
	$this->load->view('Template/bottom');
?>