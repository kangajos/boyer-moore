<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata("status_login") === TRUE){
			redirect("admin");
		}
		$this->load->view("auth/index");
	}

	public function register()
	{
		if ($this->session->userdata("status_login") === TRUE){
			redirect("admin");
		}
		$this->load->view("auth/register");
	}

	public function register_post()
	{
		$nama = $this->input->post("nama");
		$email = $this->input->post("email");
		$username = $this->input->post("username");
		$password1 = $this->input->post("password1");
		$password2 = $this->input->post("password2");
		$or_where = array("username" => $username, "email" => $email);
		$cek = $this->db->or_where($or_where)->get("ensiklopedia_user")->row();
		// print_r($cek);
		// die();
		$flag = false;
		$msg = "";
		if (!empty($cek)) {
			if (!empty($cek->email)) {
				$flag = true;
				$msg = "Email ini ($email) sudah terdafatar<br> Silahkan gunakan yang lain.<br>";
			}

			if (!empty($cek->username)) {
				$flag = true;
				$msg .= "Username ini ($username) sudah terdafatar<br> Silahkan gunakan yang lain.<br>";
			}
		}

		if ($password1 != $password2) {
			$flag = true;
			$msg .= "Konfirmasi password Anda salah,harap isi yang benar!";
		}
		if ($flag) {
			$this->session->set_flashdata("msg", $msg);
			redirect("auth/register");
		}
		$params = array(
			"username" => $username,
			"email" => $email,
			"password" => md5($password1),
			"nama" => $nama,
			"keahlian" => "Biologin",
			"level" => 2,
			"status" => 1
		);
		$msg = "Selamat, Anda berhasil register akun.<br>Silahkan login untuk memulai.";
		$this->session->set_flashdata("msg", $msg);
		$this->db->insert("ensiklopedia_user", $params);
		redirect("auth");
	}

	public function login_post()
	{
		$usernam = $this->input->post("username");
		$password = $this->input->post("password");
		$where = array("username" => $usernam, "email" => $usernam);
		$cek = $this->db->or_where($where)->get("ensiklopedia_user");

		if ($cek->num_rows() == 1) {
			$data = $cek->row();
			if ($data->password == md5($password)) {
				$data_session = array(
					"status_login" => true,
					"level" => $data->level,
					"email" => $data->email,
					"username" => $data->username,
					"nama" => $data->nama,
				);
				$this->session->set_userdata($data_session);
				redirect("admin");
			}
			$this->session->set_flashdata("msg", "Login failed, Please try gain.");
			redirect("auth");
		}
		$this->session->set_flashdata("msg", "Login failed, Please try gain.");
		redirect("auth");
	}

	public function out()
	{
		$this->session->sess_destroy();
		redirect("auth");
	}
}
