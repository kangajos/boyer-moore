<?php

class Home extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("status_login") !== TRUE){
			redirect("auth");
		}
	}

	public function index(){
		$content = "";
		$data["title"] ="Dashboard";
		$data["content"] = $content;
		$data["page"] = "admin/pages/home/index";

		$this->load->view("admin/main/main", $data);
	}

	public function tfidf()
	{
		$this->load->model("Preprocessing");

		$this->Preprocessing->init();
	}
}
