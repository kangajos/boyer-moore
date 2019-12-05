<?php

use \Sastrawi\Stemmer\StemmerFactory as StemmerFactory;

//use \Sastrawi\StopWordRemover\StopWordRemoverFactory as StopWordRemoverFactory;
class Preprocessing extends CI_Model
{
	public function init()
	{
		$stemmerFactory = new StemmerFactory();
		$stemmer = $stemmerFactory->createStemmer();
		$time_start = microtime(true);

		$sql = $this->db->query("SELECT data_id, jenis, deskripsi, manfaat, kandungan, klasifikasi, sub_klasifikasi FROM ensiklopedia_data WHERE cek !=1");
		$cek = $sql->num_rows();
		//cek record
		if ($cek >= 1) {
			$get_data = $sql->result_array();
			foreach ($get_data as $row) {
				$id_data = $row['data_id'];
				$data = $row['jenis'];
				$data .= ' ';
				$data .= $row['manfaat'];
				$data .= ' ';
				$data .= $row['kandungan'];
				$data .= ' ';
				$data .= $row['klasifikasi'];
				$data .= ' ';
				$data .= $row['sub_klasifikasi'];
				$data .= ' ';
				$data .= $row['deskripsi'];
				$token = $this->tokenization($data);
				//$filtering= $this->filtering($token);
				$stemming = $this->stemming($id_data, $data, $stemmer);
				unset($token, $filtering, $stemming);
			}
			$this->tfidf();
//			echo "<script>alert('Berhasil di setujui');window.history.back(-1);</script>";
			echo '<br>Total waktu eksekusi dalam menit: ' . (microtime(true) - $time_start) / 60;
		} else {
			die('Data sudah ter-index');
		}
	}

	public function tokenization($data)
	{
		//start tokenization
		echo "NAMA SUBJECT : ";
		echo "<br>";
		echo $data;
		echo "<br>";
		echo "------";
		echo "<br>";
		echo "TOKENISASI :";
		echo "<br>";
		$token = explode(" ", $data);
		foreach ($token as $key => $dataa) {
			$dataa = strtolower($dataa);
			//hilangkan beberapa tanda baca
			$dataa = str_replace("'", " ", $dataa);
			$dataa = str_replace('"', " ", $dataa);
			$dataa = str_replace(".", " ", $dataa);
			$dataa = str_replace(";", " ", $dataa);
			$dataa = str_replace(":", " ", $dataa);
			$dataa = str_replace(",", " ", $dataa);
			$dataa = str_replace("-", " ", $dataa);
			$dataa = str_replace("[", " ", $dataa);
			$dataa = str_replace("]", " ", $dataa);
			$dataa = str_replace("/", " ", $dataa);
			$dataa = str_replace("&", " ", $dataa);
			$dataa = str_replace("(", " ", $dataa);
			$dataa = str_replace(")", " ", $dataa);
			$dataa = str_replace("!", " ", $dataa);
			$dataa = str_replace("+", " ", $dataa);
			$dataa = str_replace("$", " ", $dataa);
			$dataa = str_replace("@", " ", $dataa);
			$dataa = str_replace("%", " ", $dataa);
			$dataa = str_replace(" ", " ", $dataa);
			$dataa = trim($dataa);
			echo $dataa;
			echo "<br>";
			$dataas[] = $dataa;
		}
		foreach ($dataas as $key => $value) {
			if ($value == null) {
				unset($dataas[$key]);
			}
			$new_ensklopedi = array_values($dataas);
		}
		echo "------";
		echo "<br>";
		//end of tokenization
		return $new_ensklopedi;
	}

	public function filtering($dataas)
	{
		//start filtering
		$rows = file_get_contents('stopword_combine.txt');
		$stopword = explode(" ", $rows);
		echo "FILTERING :";
		echo "<br>";
		$dataa = implode(" ", $dataas);
		foreach ($stopword as $i => $value) {
			$dataa = preg_replace('/\b' . $stopword[$i] . '\b/', '', $dataa);
		}
		echo $dataa;
		echo "<br>";
		echo "------";
		echo "<br>";
		return $dataa;
		// end of filtering
	}

	public function stemming($id_master, $dataa, $stemmer)
	{
		$StopWordRemover = array('yang', 'untuk', 'pada', 'ke', 'para', 'namun', 'menurut', 'antara', 'dia', 'dua',
			'ia', 'seperti', 'jika', 'jika', 'sehingga', 'kembali', 'dan', 'tidak', 'ini', 'karena',
			'kepada', 'oleh', 'saat', 'harus', 'sementara', 'setelah', 'belum', 'kami', 'sekitar',
			'bagi', 'serta', 'di', 'dari', 'telah', 'sebagai', 'masih', 'hal', 'ketika', 'adalah',
			'itu', 'dalam', 'bisa', 'bahwa', 'atau', 'hanya', 'kita', 'dengan', 'akan', 'juga',
			'ada', 'mereka', 'sudah', 'saya', 'terhadap', 'secara', 'agar', 'lain', 'anda',
			'begitu', 'mengapa', 'kenapa', 'yaitu', 'yakni', 'daripada', 'itulah', 'lagi', 'maka',
			'tentang', 'demi', 'dimana', 'kemana', 'pula', 'sambil', 'sebelum', 'sesudah', 'supaya',
			'guna', 'kah', 'pun', 'sampai', 'sedangkan', 'selagi', 'sementara', 'tetapi', 'apakah',
			'kecuali', 'sebab', 'selain', 'seolah', 'seraya', 'seterusnya', 'tanpa', 'agak', 'boleh',
			'dapat', 'dsb', 'dst', 'dll', 'dahulu', 'dulunya', 'anu', 'demikian', 'tapi', 'ingin',
			'juga', 'nggak', 'mari', 'nanti', 'melainkan', 'oh', 'ok', 'seharusnya', 'sebetulnya',
			'setiap', 'setidaknya', 'sesuatu', 'pasti', 'saja', 'toh', 'ya', 'walau', 'tolong',
			'tentu', 'amat', 'apalagi', 'bagaimanapun', 'hinggah', 'hingga', 'camat', 'toh', 'ya', 'walau', 'tolong', 'tentu', 'amat', 'apalagi', 'bagaimanapun', 'maupun', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '41', '24', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

		$output = $stemmer->stem($dataa);
		$output = explode(" ", $output);
		for ($i = 0; $i < count($output); $i++) {
			if (in_array($output[$i], $StopWordRemover)) {
				$output[$i] = "";
			}
		}

		echo "STEMMING:";
		echo "<br>";

		$tf = array_count_values(array_filter($output));
		//$max_tf = max(array_count_values($output));

		foreach ($tf as $key => $value) {
			$num = $this->db->query("SELECT count(id_bobot) as num FROM ensiklopedia_bobot ")->row()->num;
			$new_id = $id_master . "-" . $num;
			//$tf_norm = $value / $max_tf;
			echo $key;
			echo "<br>";
			//$this->insert_data($new_id, $id_master, $key, $tf_norm, $value);
			$this->insert_data($new_id, $id_master, $key, $value);

		}

		echo "------";
		echo "<br>";
	}

	public function insert_data($new_id = "", $id_master = "", $key = "", $tf = "")
	{
		$params = array("id_bobot" => $new_id, "id_master" => $id_master, "term" => $key, "tf" => $tf, "idf" => 0, "w" => 0);
		//cekterm
		if (!empty($tf)) {
			$this->db->insert("ensiklopedia_bobot", $params);
			$this->db->update("ensiklopedia_data", array("cek" => 1), array("data_id" => $id_master));
		}
	}

	public function tfidf()
	{
		$d = $this->db->query("SELECT count(data_id) as d FROM ensiklopedia_data")->row();
		$d = isset($d->d) ? $d->d : 0;


		$ee = $this->db->query("SELECT id_master, term, tf FROM ensiklopedia_bobot")->result_array();
		foreach ($ee as $data) {
			$term = $data['term'];
			$tf = $data['tf'];
			$id_master = $data['id_master'];
			$df = $this->db->query("SELECT count(id_master) as df FROM ensiklopedia_bobot WHERE term='$term' group by id_master")->row();
			//hitung idf
			$df = isset($df->df) ? $df->df : 0;
			$log = $d == 0 ? 0 : $d / $df;
			$idf = log10($log);


			//hitung w
			$w = $idf * $tf;
			$this->db->update("ensiklopedia_bobot", array("idf" => $idf, "w" => $w), array("term" => $term, "id_master" => $id_master));
		}
		echo "<br>=====TF-IDF SELESAI=====";
	}
}
