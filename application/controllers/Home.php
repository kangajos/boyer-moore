<?php

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Visitor","visit");
		$this->visit->insert_viewer();
		$this->load->model("Mbuah_sayur", "data");
	}

	public function index()
	{
		$data["page"] = "pages/home/index";
		$data["content"] = $this->data->getAll();
		$this->load->view("main/front-end", $data);
	}
}
