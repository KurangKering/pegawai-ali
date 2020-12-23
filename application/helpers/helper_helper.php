<?php
Use eftec\bladeone;

if (!function_exists('view')) {
	function view($view, $data = [], $string = false) {
		$views = APPPATH .'/views';
		$cache = APPPATH . '/cache';
		
		if (!defined("BLADEONE_MODE")) {
			define("BLADEONE_MODE",1);	
		}
		$blade=new bladeone\BladeOne($views,$cache);
		if ($string == false) {
			echo $blade->run($view,$data);
		} else {
			return $blade->run($view,$data);
		}
	}
}
if (!function_exists('hBulan')) {
	function hBulan($bulan = null) {
		$daftar =  array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		if ($bulan) {
			return $daftar[$bulan];
		} 
		return $daftar;
	}
}


if (!function_exists('hJK')) {
	function hJK($status = null) {
		$daftar =  array(
			'L' => 'Laki-Laki',
			'P' => 'Perempuan',

		);
		if ($status) {
			return $daftar[$status];
		} 
		return $daftar;
	}
}

if (!function_exists('indoDate')) {
	function indoDate ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '') {
		if (trim ($timestamp) == '')
		{
			$timestamp = time ();
		}
		elseif (!ctype_digit ($timestamp))
		{
			$timestamp = strtotime ($timestamp);
		}
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace ("/S/", "", $date_format);
		$pattern = array (
			'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
			'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
			'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
			'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
			'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
			'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
			'/April/','/June/','/July/','/August/','/September/','/October/',
			'/November/','/December/',
		);
		$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
			'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
			'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
			'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
			'Oktober','November','Desember',
		);
		$date = date ($date_format, $timestamp);
		$date = preg_replace ($pattern, $replace, $date);
		if ($suffix) {
			$date = "{$date} {$suffix}";
		}
		return $date;
	} 
}

if (!function_exists('formatDate')) {
	function formatDate($date, $format_asal ="d-m-Y", $format_akhir = "Y-m-d") {

		$date = DateTime::createFromFormat($format_asal, $date);
		if ($date) {
			return $date->format($format_akhir);
		}
		return null;
		
	}
}

if (!function_exists('hRupiah')) {
	function hRupiah($angka){

		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;

	}

}
