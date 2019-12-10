<?php

use \Sastrawi\Stemmer\StemmerFactory as StemmerFactory;
use \Sastrawi\StopWordRemover\StopWordRemoverFactory as StopWordRemoverFactory;

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mbuah_sayur", "data");
		$this->load->model("Mboyermoore", "boyer");
	}

	public function index()
	{
		$this->db->update("ensiklopedia_data", array("similarity" => null));
		$time_start_s = microtime(true);
		$query = trim($this->input->get("q"));
		$query = strtolower($query);
		$query = preg_replace('/(?:\[test:[^]]+\])(*SKIP)(*F)|(?:\[\w[^]]+\])/', '', $query);
		$keyword = $this->boyer->Search($query);
		$row = $this->db->query("SELECT data_id, term FROM ensiklopedia_data WHERE $keyword[0] ")->result();
		$Pembagi = 0;
		foreach ($row as $key => $val) {
			$time_start = microtime(true);
			$NKesamaan = " ";
			for ($q = 0; $q < count($keyword[1]); $q++) {
				$search = $keyword[1][$q];
				$Kesamaan = $this->boyer->BoyerMoore($val->term, $search);
				if (strlen($Kesamaan) >= 1) {
					if ($NKesamaan == " ") {
						$NKesamaan = "[" . $Kesamaan . "]";
					} else {
						$NKesamaan = $NKesamaan . ",[" . $Kesamaan . "]";
					}
				}
			}
			$Pembagi = explode(" ", $val->term);
			$exp = explode(",", $NKesamaan);
			$Kesamaan = count($exp) / count($Pembagi);
			$time = substr((microtime(true) - $time_start), 0, 4);
			$this->db->query("UPDATE `ensiklopedia_data` SET similarity='" . $Kesamaan . "',time='" . $time . "' WHERE data_id='" . $val->data_id . "'");
		}

//		$inserBatch = array();
//		foreach ($getDataset as $key => $value) {
//			$time_start = microtime(true);
//			$dataset = strtolower(trim($value->jenis . " " . $value->deskripsi . " " . $value->kandungan . " " . $value->manfaat . " " . $value->klasifikasi));
//			$dataset = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $dataset);
//			//process calculate boyer moore//
//			$similarity = similar_text($query, $dataset, $percent);
//			$time = substr((microtime(true) - $time_start), 0, 4);
//			$inserBatch[] = array(
//				"id_master" => $value->data_id,
//				"percent_similarity" => round($percent, 2),
//				'time' => $time
//			);
//
//		}

			$result = $this->db->select("
			ensiklopedia_data.data_id,
			ensiklopedia_data.nama,
			ensiklopedia_data.jenis,
			ensiklopedia_data.deskripsi,
			ensiklopedia_data.similarity,
			ensiklopedia_data.time,
			ensiklopedia_data.created_at")
				->from("ensiklopedia_data")
				->order_by("ensiklopedia_data.similarity", "DESC")
				->where("ensiklopedia_data.similarity >", 0)->get();
			$proses = substr((microtime(true) - $time_start_s), 0, 4);
			$results = array("result" => $result->result(), "proses" => $proses, "ditemukan" => $result->num_rows(), "");



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

	public function create()
	{
		$this->boyer->createTerm();
	}
}
