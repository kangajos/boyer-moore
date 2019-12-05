<?php

class Sayuran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mbuah_sayur", "buah");
	}

	public function index()
	{
		$content = $this->buah->getSayur();
		$data["title"] = "Data Sayur";
		$data["content"] = $content;
		$data["page"] = "admin/pages/sayur/index";

		$this->load->view("admin/main/main", $data);
	}

	public function detail($id = "")
	{
		$content = $this->db->get_where("ensiklopedia_data", array("data_id" => $id))->row();
		$data["content"] = $content;
		$data["foto"] = $this->db->get_where("ensiklopedia_foto", array("id_master" => $id))->result();

		$this->load->view("admin/pages/sayur/detail", $data);
	}

	public function edit($id = "")
	{
		$content = $this->db->get_where("ensiklopedia_data", array("data_id" => $id))->row();
		$data["content"] = $content;
		$data["foto"] = $this->db->get_where("ensiklopedia_foto", array("id_master" => $id))->result();

		$this->load->view("admin/pages/sayur/edit_data", $data);
	}

	public function save_post()
	{
		$data_id = date("Y-m-d") . "-" . uniqid();
		$kategori = "sayur";
		$nama = $this->input->post("nama");
		$jenis = $this->input->post("jenis");
		$deskripsi = $this->input->post("deskripsi");
		$manfaat = $this->input->post("manfaat");
		$kandungan = $this->input->post("kandungan");
		$klasifikasi = $this->input->post("klasifikasi");
		$sub_klasifikasi = $this->input->post("sub_klasifikasi");
		$tanggal = date("Y-m-d H:i:s");

		$params = array(
			"data_id" => $data_id,
			"kategori" => $kategori,
			"nama" => $nama,
			"jenis" => $jenis,
			"deskripsi" => $deskripsi,
			"kandungan" => $kandungan,
			"manfaat" => $manfaat,
			"klasifikasi" => $klasifikasi,
			"sub_klasifikasi" => $sub_klasifikasi,
			"created_at" => $tanggal
		);

		$insert = $this->buah->insert_data($params);
		$msg = "Data gagal ditambahkan.";
		if ($insert == 1){
			$msg = "Data berhasil ditambahkan.";
		}
		$this->session->set_flashdata("msg", $msg);
		redirect("admin/sayuran");
	}

	public function delete($data_id = "")
	{
		$this->db->where("data_id", $data_id)->delete("ensiklopedia_data");
		$this->db->where("id_master", $data_id)->delete("ensiklopedia_foto");

		$msg = "Data berhasil dihapus.";
		$this->session->set_flashdata("msg", $msg);
		redirect("admin/sayuran");
	}

	public function update_post()
	{
		$data_id = $this->input->post("data_id");
		$nama = $this->input->post("nama");
		$jenis = $this->input->post("jenis");
		$deskripsi = $this->input->post("deskripsi");
		$manfaat = $this->input->post("manfaat");
		$kandungan = $this->input->post("kandungan");
		$klasifikasi = $this->input->post("klasifikasi");
		$sub_klasifikasi = $this->input->post("sub_klasifikasi");
		$tanggal = date("Y-m-d H:i:s");

		$params = array(
			"nama" => $nama,
			"jenis" => $jenis,
			"deskripsi" => $deskripsi,
			"kandungan" => $kandungan,
			"manfaat" => $manfaat,
			"klasifikasi" => $klasifikasi,
			"sub_klasifikasi" => $sub_klasifikasi,
			"created_at" => $tanggal
		);

		$where = array("data_id" => $data_id);

		$insert = $this->buah->update_data($params, $where);
		$msg = "Data gagal diubah.";
		if ($insert == 1){
			$msg = "Data berhasil diubah.";
		}
		$this->session->set_flashdata("msg", $msg);
		redirect("admin/sayuran");
	}
}
