<?php

class Mboyermoore extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function badCharHeuristic($str, $size, &$badchar)
	{
		for ($i = 0; $i < 256; $i++)
			$badchar[$i] = -1;

		for ($i = 0; $i < $size; $i++)
			$badchar[ord($str[$i])] = $i;
	}

	function BoyerMoore($str, $pat)
	{
		$m = strlen($pat);
		$n = strlen($str);
		$i = 0;
		$result = "";
		$this->badCharHeuristic($pat, $m, $badchar);

		$s = 0;
		while ($s <= ($n - $m)) {
			$j = $m - 1;

			while ($j >= 0 && $pat[$j] == $str[$s + $j])
				$j--;

			if ($j < 0) {
				$arr[$i++] = $s;
				$s += ($s + $m < $n) ? $m - $badchar[ord($str[$s + $m])] : 1;
			} else
				$s += max(1, $j - $badchar[ord($str[$s + $j])]);
		}

		for ($j = 0; $j < $i; $j++) {
			if ($result == "") {
				$result = $arr[$j];
			} else {
				$result = $result . "," . $arr[$j];
			}

		}

		return $result;
	}


	function pemecah_kalimat($text)
	{
		$replace = ' ';
		$search = array("-", "'", ")", "(", ",", "/", "\",", ".", "=", "?", "!", ":", ";", "1", "0", "2", "3", "4", "5", "6", "7", "8", "9", "--", '"', '%', '+', '<', '>', '&lt', '&gt', "\n");
		$word = str_replace($search, $replace, strtolower(trim($text)));
		$wordb = explode(' ', $word);

		return $wordb;
	}

	public function Search($keyword)
	{
		$post = $this->db->escape_str($keyword);
		$Tokenzing = $this->pemecah_kalimat(strip_tags($post));
		$Arr = "";
		$Arr2 = array();
		for ($tok = 0; $tok < count($Tokenzing); $tok++) {
			$Word = $this->db->escape_str($Tokenzing[$tok]);
			$Word2 = strtolower(trim($Word));
			if ($Word2 != "") {
				$Word = $Word2;
			}
			if ($Word != "") {
				if ($Arr == "") {
					$Arr = "term like '%" . $Word . "%'";
				} else {
					$Arr = $Arr . " or term like '%" . $Word . "%'";
				}
				array_push($Arr2, $Word);
			}
		}
		$arr = array();
		$arr[0] = $Arr;
		$arr[1] = array_unique($Arr2);
		return $arr;
	}

	public function createTerm()
	{
		$dataset = $this->db->select("data_id,CONCAT(jenis,' ', deskripsi,' ', manfaat, kandungan, ' ',klasifikasi, ' ',sub_klasifikasi) as terms")
			->get("ensiklopedia_data")->result();
		foreach ($dataset as $item) {
			$terms = str_replace("\n", " ", implode(" ", $this->pemecah_kalimat($item->terms)));
			$this->db->update("ensiklopedia_data", array("term" => trim($terms)), array("data_id" => $item->data_id));
		}

	}
}
