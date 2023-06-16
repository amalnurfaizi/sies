<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}	

	function dataAnggota(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT * FROM anggota a inner join ekskul e on a.id_ekskul = e.id where a.id_ekskul = '$id_ekskul' ");

		if(isset($att_id)){
			$record = $this->db->query("SELECT * FROM catatan_kehadiran where id_kehadiran ='$att_id' ");
		if($record->num_rows > 0){
			while($row = $record->fetch_assoc()){
				$data['record'][] = $row;
				$data['id_kehadiran'] = $row['id_kehadiran'];
			}
		}
		}
		while($row = $get->fetch_assoc()){
			$data['data'][] = $row;
		}
		return json_encode($data);
	}
	
	
	
	function riwayatAbsensi(){
		extract($_POST);
		$get = $this->db->query("SELECT * FROM anggota a inner join ekskul e on a.id_ekskul = e.id where a.id_ekskul = '$id_ekskul' ");

		$record = $this->db->query("SELECT ck.*,dk.* FROM catatan_kehadiran ck inner join daftar_kehadiran dk on dk.id = ck.id_kehadiran where dk.id_ekskul='$id_ekskul' and dk.doc = '$doc' ");
		$data = array();
		while($row = $get->fetch_assoc()){
			$data['data'][] = $row;
		}
		if($record->num_rows > 0){
			while($row = $record->fetch_assoc()){
				$data['record'][] = $row;
				$data['id_kehadiran'] = $row['id_kehadiran'];
		}
		}
		$qry = $this->db->query("SELECT e.nama_ekskul as `ekskul` FROM ekskul e where e.id = {$id_ekskul} ");
		foreach($qry->fetch_array() as $k => $v){
			$data['details'][$k] =$v; 
		}
		$data['details']['doc'] =date('M d, Y',strtotime($doc)); 

		return json_encode($data);
	}
	function laporanAbsensi(){
		extract($_POST);
		$get = $this->db->query("SELECT * FROM anggota a inner join ekskul e on a.id_ekskul = e.id where a.id_ekskul = '$id_ekskul' ");

		$record = $this->db->query("SELECT ck.*,dk.* FROM catatan_kehadiran ck inner join daftar_kehadiran dk on dk.id = ck.id_kehadiran where dk.id_ekskul ='$id_ekskul' and date_format(dk.doc,'%Y-%m') = '$doc' ");
		$data = array();
		while($row = $get->fetch_assoc()){
			$data['data'][] = $row;
		}
		if($record->num_rows > 0){
			while($row = $record->fetch_assoc()){
				$data['record'][$row['id_anggota']][] = $row;
				$data['id_kehadiran'] = $row['id_kehadiran'];
		}
		}
		$noc = $this->db->query("SELECT * FROM daftar_kehadiran where id_ekskul='$id_ekskul' and date_format(doc,'%Y-%m') = '$doc' ");
				$data['details']['noc'] = $noc->num_rows;


				$qry = $this->db->query("SELECT e.nama_ekskul as `ekskul` FROM ekskul e where e.id = {$id_ekskul} ");
				foreach($qry->fetch_array() as $k => $v){
					$data['details'][$k] =$v; 
				}

		$data['details']['doc'] =date('F ,Y',strtotime($doc)); 

		return json_encode($data);
	}
	function simpanAbsensi(){
		extract($_POST);
		$data  = " id_ekskul = '$id_ekskul' ";
		$data .= ", doc = '$doc' ";
		$data2  = " id_ekskul = '$id_ekskul' ";
		$data2 .= "and doc = '$doc' ";
		// echo "SELECT * FROM attendance_list where $data2 ".(!empty($id) ? " and attendance_id != {$id} " : '');
		$check = $this->db->query("SELECT * FROM daftar_kehadiran where $data2 ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
				
				$save = $this->db->query("INSERT INTO daftar_kehadiran set $data ");
			if($save){
				$id = $this->db->insert_id;
				foreach($id_anggota as $k => $v) {
					$data = " id_kehadiran = '$id' ";
					$data .= ", id_anggota = '$k' ";
					$data .= ", type = '$type[$k]' ";
						  $this->db->query("INSERT INTO catatan_kehadiran set $data ");
				}
			}
		}else{
			$save = $this->db->query("UPDATE daftar_kehadiran set $data where id =$id ");
			if($save){
				foreach($id_anggota as $k => $v) {
					$data = " id_kehadiran = '$id' ";
					$data .= "and id_anggota = '$k' ";
						  $this->db->query("UPDATE catatan_kehadiran set type = '$type[$k]' where $data ");
				}
			}
		}

		if($save){
			return 1;
		}
	}


}