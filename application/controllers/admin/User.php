<?php
class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("status_login") !== TRUE){
			redirect("auth");
		}
	}

	public function index()
	{
		$data["title"] = "Data User";
		$data["page"] = "admin/pages/user/index";
		$data["content"] = $this->db->where("level !=", 1)->get("ensiklopedia_user")->result();

		$this->load->view("admin/main/main", $data);
	}
}
