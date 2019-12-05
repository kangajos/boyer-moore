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
			$dataset = strtolower(preg_replace("/(?![.=$'€%-])\p{P}/u", "", $value->jenis));
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

	public function vsm($query)
	{
		$hasil = explode(" ", $query);
		/*echo "STEMMING:";
		echo "<br>";*/
		$tf = array_count_values($hasil); //hitung tf
		foreach ($tf as $key => $valuez) {
			$total_term[] = $valuez;
			/*echo $key;
			echo "<br>";        //hasil preprocessing*/
		}

		$query1 = $this->db->query("SELECT data_id as id_master FROM ensiklopedia_data");
		$des = $query1->num_rows();
		$ids = array();
		foreach ($query1->result_array() as $query11) {
			$ids[] = $query11['id_master'];
		}
		$idfss = array();
		$ditemukan = array();
		foreach ($tf as $key => $valuez) {
			$query2 = $this->db->query("SELECT idf FROM ensiklopedia_bobot WHERE term like '%$key%'");
			$numy = $query2->num_rows();
			if ($numy == 0) { //pengurangan cosine similarity jika term tdk ditemukan
				$df = $tf[$key];
				$idf = log10($des / $df);
				array_push($idfss, $idf);
			} else {
				$data2 = $query2->row_array();
				$idfss[] = $data2['idf'];
			}

			for ($i = 0; $i < $des; $i++) { //seleksi data yang memiliki term sama dengan kata kunci
				foreach ($tf as $key => $valuez) {

					$query3 = $this->db->query("SELECT * FROM ensiklopedia_bobot WHERE id_master='$ids[$i]' AND term like '%$key%'");
					$jml = $query3->num_rows();
					if ($jml > 0) {
						$ditemukan[] = '1';
						$data3 = $query3->row_array();
						$id = $data3['id_master'];
						$termm = $data3['term'];
						$w = $data3['w'];
						$idf = $data3['idf'];
						if (!empty($id)) {
							$this->db->query("INSERT INTO ensiklopedia_temporary VALUES('','$id','$termm','$idf','$w')"); //insert data yang meiliki term sama dgn kata kunci kedalam table temp
						}
					} else {
						$ditemukan[] = '0';
					}
				}
			}

			$jml_ditemukan = array_sum($ditemukan);
			if ($jml_ditemukan == 0) {
				return;
			}

			$query4 = $this->db->query("SELECT id_master, count(*) as NUM FROM ensiklopedia_temporary GROUP BY id_master");
			$jml_temp = $query4->num_rows();
			$query5 = $this->db->query("SELECT id_master FROM ensiklopedia_temporary GROUP BY id_master");
			foreach ($query5->result_array() as $data4) {
				$ids_temp[] = $data4['id_master']; //data id_master yang memiliki term sama dgn kata kunci
			}

			for ($b = 0; $b < $jml_temp; $b++) {
				$query6 = $this->db->query("SELECT * FROM ensiklopedia_temporary WHERE id_master= '$ids_temp[$b]'"); //penghitungan Cosine tiap id_master yang memiliki term sama dgn kata kunci
				$jml = $query6->num_rows();
				foreach ($query6->result_array() as $data5) {
					$bobots[] = $data5['w'];
					$ids[] = $data5['id_master'];
					$idfs[] = $data5['idf'];
				}

				if ($jml == 1) { //perhitungan QD
					$qd[] = ($idfs[0] * $bobots[0]);
				} else {
					for ($ic = 0; $ic < $jml; $ic++) {
						$qds[] = ($idfs[$ic] * $bobots[$ic]);
					}
					$qd[] = array_sum($qds); //nilai QD hasil perhitungan
				}
				unset($idfs);
				unset($bobots);
				unset($qds);
			}
			$q = array();
			foreach ($idfss as $key => $valuez) {
				$q[] = pow($idfss[$key], 2); //menghitung nilai Q
			}
			$q = sqrt(array_sum($q)); //nilai Q
			for ($i = 0; $i < $jml_temp; $i++) { //menghitung nilai |D|
				$query7 = $this->db->query("SELECT w FROM ensiklopedia_bobot WHERE id_master='$ids_temp[$i]'");
				$rowss = $query7->num_rows();
				foreach ($query7->result_array() as $data6) {
					$w_bobot[] = $data6['w'];
				}

				for ($a = 0; $a < $rowss; $a++) {
					$w_kuadrat[] = pow($w_bobot[$a], 2);
				}

				$total_bobot = array_sum($w_kuadrat);
				$pjg_dok[] = sqrt($total_bobot); //nilai |D|
				unset($w_bobot);
				unset($w_kuadrat);
			}
			$insert_batch = array();
			for ($i = 0; $i < $jml_temp; $i++) {
				$cosine = $qd[$i] == 0 ? 0 : $qd[$i] / ($q * $pjg_dok[$i]);
				$insert_batch[] = array("id_master" => $ids_temp[$i], "cosine" => $cosine);
				//if ($cos[$i] > 0.3) {
//				$this->db->query("INSERT into ensiklopedia_rank VALUES('','$ids_temp[$i]','$cos[$i]')"); //insert nilai cosine tiap produk yang memiliki kemiripan kedalam tabel rank
				//}
			}
			if (!empty($insert_batch)) {
				$this->db->insert_batch("ensiklopedia_rank", $insert_batch);
			}
		}
	}

	public function tf_idf($data_id = null)
	{
		sleep(1);
		$result = $this->db->get_where("ensiklopedia_bobot", array("id_master" => $data_id))->result();
		$data['tfidf'] = $result;
		$this->load->view("pages/search/tf_idf", $data);
	}
}
