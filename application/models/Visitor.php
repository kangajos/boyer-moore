<?php

class Visitor extends CI_Model
{
	function ip_user()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];

		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

		} else {
			$ip = $_SERVER['REMOTE_ADDR'];

		}
		return $ip;
	}

	/**
	 * @see http://php.net/manual/en/function.get-browser.php;
	 * @return
	 */
	function browser_user()
	{
		$browser = $this->_userAgent();
		return $browser['name'] . ' v.' . $browser['version'];
	}

	/**
	 * Deteksi UserAgent / Browser yang digunakan
	 * @return [type] [description]
	 */
	function _userAgent()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version = "";
		$os_array = array(
			'/windows nt 10.0/i' => 'Windows 10',
			'/windows nt 6.2/i' => 'Windows 8',
			'/windows nt 6.1/i' => 'Windows 7',
			'/windows nt 6.0/i' => 'Windows Vista',
			'/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
			'/windows nt 5.1/i' => 'Windows XP',
			'/windows xp/i' => 'Windows XP',
			'/windows nt 5.0/i' => 'Windows 2000',
			'/windows me/i' => 'Windows ME',
			'/win98/i' => 'Windows 98',
			'/win95/i' => 'Windows 95',
			'/win16/i' => 'Windows 3.11',
			'/macintosh|mac os x/i' => 'Mac OS X',
			'/mac_powerpc/i' => 'Mac OS 9',
			'/linux/i' => 'Linux',
			'/ubuntu/i' => 'Ubuntu',
			'/iphone/i' => 'iPhone',
			'/ipod/i' => 'iPod',
			'/ipad/i' => 'iPad',
			'/android/i' => 'Android',
			'/blackberry/i' => 'BlackBerry',
			'/webos/i' => 'Mobile'
		);
		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $u_agent)) {
				$platform = $value;
				break;
			}
		}
		// Next get the name of the useragent yes seperately and for good reason
		if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
			$bname = 'Internet Explorer';
			$ub = "MSIE";

		} elseif (preg_match('/Firefox/i', $u_agent)) {
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";

		} elseif (preg_match('/Chrome/i', $u_agent)) {
			$bname = 'Google Chrome';
			$ub = "Chrome";
		} elseif (preg_match('/Safari/i', $u_agent)) {
			$bname = 'Apple Safari';
			$ub = "Safari";
		} elseif (preg_match('/Opera/i', $u_agent)) {
			$bname = 'Opera';
			$ub = "Opera";

		} elseif (preg_match('/Netscape/i', $u_agent)) {
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		//  finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
				$version = $matches['version'][0];

			} else {
				$version = $matches['version'][1];
			}
		} else {
			$version = $matches['version'][0];
		}

		// check if we have a number
		$version = ($version == null || $version == "") ? "?" : $version;

		return array(
			'userAgent' => $u_agent,
			'name' => $bname,
			'version' => $version,
			'platform' => $platform,
			'pattern' => $pattern
		);
	}

	/**
	 * @return name Operating System
	 */
	function os_user()
	{
		$OS = $this->_userAgent();
		return $OS['platform'];
	}

	function insert_viewer()
	{
		// Check bila sebelumnya data pengunjung sudah terrekam
		if (!isset($_COOKIE['VISITOR'])) {
			$ip = $this->ip_user();
			$browser = $this->browser_user();
			$os = $this->os_user();
			// Masa akan direkam kembali
			// Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
			// Cookie akan disimpan selama 24 jam
			$duration = time() + 60 * 60 * 24;
			// simpan kedalam cookie browser
			setcookie('VISITOR', $browser, $duration);
			// current time
			$dateTime = date('Y-m-d H:i:s');
			$params = array(
				"ip" => $ip,
				"os" => $os,
				"browser" => $browser,
				"created_at" => $dateTime,
			);
			// SQL Command atau perintah SQL INSERT
//			$sql = "INSERT INTO statistik (ip, os, browser, created_at) VALUES ('$ip', '$os', '$browser', '$dateTime')";
			// variabel { $db } adalah perwakilan dari koneksi database lihat config.php
			$query = $this->db->insert("ensiklopedia_visitor", $params);
		}
	}

	function insert_viewer_perpage($page_id)
	{
		// Check bila sebelumnya data pengunjung sudah terrekam
		if (!isset($_COOKIE[$page_id])) {
			$ip = $this->ip_user();
			$browser = $this->browser_user();
			$os = $this->os_user();
			// Masa akan direkam kembali
			// Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
			// Cookie akan disimpan selama 24 jam
			$duration = time() + 60 * 60 * 24;
			// simpan kedalam cookie browser
			setcookie($page_id, $browser, $duration);
			// current time
			$dateTime = date('Y-m-d H:i:s');
			$where = array(
				"page_id" => $page_id,
			);
			$cek = $this->db->select("page_id")->where($where)->get("ensiklopedia_visitor_perpage")->row();
			if (!empty($cek)) {
				$this->db->query("UPDATE ensiklopedia_visitor_perpage SET total = (total+1) WHERE page_id='$page_id'");
			} else {
				$params = array("page_id" => $page_id, "total" => 1);

				$this->db->insert("ensiklopedia_visitor_perpage", $params);
			}
		}
	}
}
