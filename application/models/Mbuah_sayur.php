<?php

class Mbuah_sayur extends CI_Model
{
	public function getAll($limit = 12, $not_in = "")
	{
		if (!empty($not_in)) {
			$this->db->where_not_in("data_id", $not_in);
		}
		return $this->db->order_by("created_at", "DESC")->get("ensiklopedia_data", $limit)->result();
	}

	public function getById($where = array())
	{
		return $this->db->where($where)->get("ensiklopedia_data")->row();
	}

	public function getBuah()
	{
		return $this->db->where("kategori", "buah")->order_by("created_at", "DESC")->get("ensiklopedia_data")->result();
	}

	public function getSayur()
	{
		return $this->db->where("kategori", "sayur")->order_by("created_at", "DESC")->get("ensiklopedia_data")->result();
	}

	public function insert_data($params = array())
	{
		$insert = $this->db->insert("ensiklopedia_data", $params);
		$data_id = !empty($params['data_id']) ? $params['data_id'] : "";
		if (!empty($_FILES['userfile']['name'])) {
			$this->uploadImage($data_id);
		}
		return $insert ? true : false;
	}

	public function uploadImage($data_id)
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for ($i = 0; $i < $cpt; $i++) {
			$fileName = explode(".", $files['userfile']['name'][$i]);
			$fileName = end($fileName);
			$fileName = date("YmdHis") . "." . $fileName;
			$_FILES['userfile']['name'] = $fileName;
			$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
			$_FILES['userfile']['size'] = $files['userfile']['size'][$i];

			$config = array();
			$config['upload_path'] = './img/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);
			$cek = $this->upload->do_upload("userfile");
			if ($cek) {
				$params = array("jenis_foto" => $fileName, "id_master" => $data_id);
				$this->db->insert("ensiklopedia_foto", $params);
			}

		}
	}

	public function update_data($params = array(), $where = array())
	{
		$this->db->update("ensiklopedia_data", $params, $where);
		$insert = $this->db->affected_rows();
		$data_id = !empty($where['data_id']) ? $where['data_id'] : "";
		if (!empty($_FILES['userfile']['name'])) {
			$this->uploadImage($data_id);
		}

		if ($insert > 0) {
			$this->db->where("id_master", $data_id)->delete("ensiklopedia_bobot");
			$this->db->where("data_id", $data_id)->update("ensiklopedia_data", array("cek" => 0));
		}
		return $insert > 0 ? true : false;
	}

}
