<?php
ob_start();
$action = $_GET['action'];
include './absensi/admin_class.php';
$crud = new Action();
if($action == "data_anggota"){
	$get = $crud->dataAnggota();
	if($get)
		echo $get;
}
if($action == "riwayat_absensi"){
	$get = $crud->riwayatAbsensi();
	if($get)
		echo $get;
}
if($action == "laporan_absensi"){
	$get = $crud->laporanAbsensi();
	if($get)
		echo $get;
}
if($action == "simpan_absensi"){
	$save = $crud->simpanAbsensi();
	if($save)
		echo $save;
}


ob_end_flush();
?>
