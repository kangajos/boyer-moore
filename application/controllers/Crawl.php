<?php

class Crawl extends CI_Controller
{

	public function index()
	{
		die("Stop!");
		$res = $this->db->get("ensiklopedia_data_master")->result();
		$insert_batch = array();
		foreach ($res as $re) {
			$res1 = $this->db->where("id_master", $re->id_master)->get("ensiklopedia_jenis")->row();
			$res2 = $this->db->where("id_master", $re->id_master)->get("ensiklopedia_klasifikasi")->row();
			$res3 = $this->db->where("id_master", $re->id_master)->get("ensiklopedia_manfaat")->row();
			$res4 = $this->db->where("id_klasifikasi", $res2->id_klasifikasi)->get("ensiklopedia_sub_klasifikasi")->result();
			$sub_klasifikasi = "";
			foreach ($res4 as $item) {
				$sub_klasifikasi .= $item->sub_klasifikasi."\n";
			}
			$klasifikasi = "kindom : ".$res2->kindom;
			$klasifikasi .= "\ndivisi:".$res2->divisi;
			$klasifikasi .= "\nkelas : ".$res2->kelas;
			$klasifikasi .= "\nordo : ".$res2->ordo;
			$klasifikasi .= "\nfamili : ".$res2->famili;
			$klasifikasi .= "\ngenus : ".$res2->genus;
			$klasifikasi .= "\nspesies : ".$res2->spesies;
			$insert_batch[] = array(
				"data_id" => $re->id_master,
				"kategori" => $re->kategori,
				"nama" => $re->nama_judul,
				"jenis" => $res1->jenis,
				"deskripsi" => $res1->deskripsi_gambar,
				"kandungan" => "-",
				"manfaat" => $res3->manfaat,
				"klasifikasi" => $klasifikasi,
				"sub_klasifikasi" => $sub_klasifikasi,
				"created_at" => date("Y-m-d H:i:s"),
			);
		}
		$this->db->truncate("ensiklopedia_data");
		$this->db->insert_batch("ensiklopedia_data", $insert_batch);
//		echo "<pre>";
//		print_r($insert_batch);
	}
}
