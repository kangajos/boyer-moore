<?php

use \Sastrawi\Stemmer\StemmerFactory as StemmerFactory;
use \Sastrawi\StopWordRemover\StopWordRemoverFactory as StopWordRemoverFactory;

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mbuah_sayur", "data");
	}

	public function index()
	{
		$time_start_s = microtime(true);
		$query = trim($this->input->get("q"));
		$query = strtolower($query);
		$query = preg_replace('/(?:\[test:[^]]+\])(*SKIP)(*F)|(?:\[\w[^]]+\])/', '', $query);

		$this->db->truncate("ensiklopedia_rank");
		$getDataset = $this->db->select("data_id, jenis")->get("ensiklopedia_data")->result();
		$inserBatch = array();
		foreach ($getDataset as $key => $value) {
			$time_start = microtime(true);
			$dataset = strtolower(trim($value->jenis . " " . $value->deskripsi . " " . $value->kandungan . " " . $value->manfaat . " " . $value->klasifikasi));
			$dataset = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $dataset;
			//process calculate boyer moore//
			$similarity = similar_text($query, $dataset, $percent);
			$time = substr((microtime(true) - $time_start), 0, 4);
			$inserBatch[] = array(
				"id_master" => $value->data_id,
				"percent_similarity" => round($percent, 2),
				'time' => $time
			);

		}
		// insert scoring similarity
		$this->db->insert_batch("ensiklopedia_rank", $inserBatch);
		$cek = $this->db->select("id_master")->get("ensiklopedia_rank")->num_rows();
		if ($cek == 0) {
			$results = array("result" => null, "proses" => 0, "ditemukan" => 0, "");
		} else {
			$result = $this->db->select("
			ensiklopedia_rank.time, 
			ensiklopedia_rank.percent_similarity, 
			ensiklopedia_data.data_id,
			ensiklopedia_data.nama,
			ensiklopedia_data.jenis,
			ensiklopedia_data.deskripsi,
			ensiklopedia_data.created_at")->from("ensiklopedia_rank")
				->join("ensiklopedia_data", "ensiklopedia_rank.id_master=ensiklopedia_data.data_id")
//				->where("cast(cosine as decimal(5,2) ) >=", $avg)
				->order_by("ensiklopedia_rank.percent_similarity", "DESC")->group_by("ensiklopedia_rank.id_master")->get();
			$proses = substr((microtime(true) - $time_start_s), 0, 4);
			$results = array("result" => $result->result(), "proses" => $proses, "ditemukan" => $result->num_rows(), "");
		}


		$data["content"] = $results;
		$data["page"] = "pages/search/search_result";
		$this->load->view("main/front-end", $data);
	}

	public function detail($data_id = "")
	{
		$this->load->model("Visitor", "visit");
		$data["content"] = $this->data->getById(array("data_id" => $data_id));
		$data["page"] = "pages/search/search_detail";
		$this->load->view("main/front-end", $data);
	}
}
