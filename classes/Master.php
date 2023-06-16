<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}

	
	// <=======================> 
	public function memuatSemuaEkskul(){
		extract($_POST);
		$totalCount = $this->conn->query("SELECT * FROM `ekskul` where  logo = 0 ")->num_rows;
		$totalCount = $this->mysqli->query($data);
		while ($row = mysqli_fetch_array($ekskul)){
			$memuat_semua_ekskul[] = $row;
		}
		return $memuat_semua_ekskul;
	}

	// <=======================> 
	public function memuatEkskul(){
		$data = $this->conn->query("SELECT * FROM `ekskul` where id = '{$this->settings->userdata('id_ekskul')}'")->num_rows;
		$ekskul = $this->mysqli->query($data);
		while ($row = mysqli_fetch_array($ekskul)){
			$memuat_ekskul[] = $row;
		}
		return $memuat_ekskul;
}



// <=======================> 
	function simpanEkskul(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){

			if(!in_array($k,['id','content'])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}

		if(empty($id)){
			$sql = "INSERT INTO `ekskul` set {$data}";
		}else{
			$sql = "UPDATE `ekskul` set {$data} where id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$cid= empty($id) ? $this->conn->insert_id : $id ;
			$resp['status'] = 'success';
			$resp['cid'] = $cid;
			if(isset($content)){
				file_put_contents(base_app."/ekskul_konten/{$cid}.html",$content);
			$err = "";
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				if(!is_dir(base_app."uploads/logo_ekskul"))
					mkdir(base_app."uploads/logo_ekskul");
				$fname = 'uploads/logo_ekskul/'.$cid.'.png';
				$dir_path =base_app. $fname;
				$upload = $_FILES['img']['tmp_name'];
				$type = mime_content_type($upload);
				$allowed = array('image/png','image/jpeg');
				if(!in_array($type,$allowed)){
					$err.=" But Image failed to upload due to invalid file type.";
				}else{
					$new_height = 200; 
					$new_width = 200; 
			
					list($width, $height) = getimagesize($upload);
					$t_image = imagecreatetruecolor($new_width, $new_height);
					imagealphablending( $t_image, false );
					imagesavealpha( $t_image, true );
					$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
					imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					if($gdImg){
							if(is_file($dir_path))
							unlink($dir_path);
							$uploaded_img = imagepng($t_image,$dir_path);
							if(isset($uploaded_img)){
								$this->conn->query("UPDATE ekskul set `logo_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$cid}' ");
							}
							imagedestroy($gdImg);
							imagedestroy($t_image);
					}else{
					$err.=" But Image failed to upload due to unknown reason.";
					}
				}
			}
			if(empty($id))
				$this->settings->set_flashdata('success',"Ekstrakurikuler Berhasil Ditambahkan".$err);
			else
				$this->settings->set_flashdata('success',"Ekstrakurikuler Berhasil Diperbarui ".$err);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Gagal Menyimpan Ekskul';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}


	// <=======================> 
	function hapusEkskul(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `ekskul` where id = '{$id}' ");
		if($delete){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Ekstrakurikuler Berhasil Dihapus");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;

		}
		return json_encode($resp);
	}

// <=======================> 
	function ekskulYangDikelola(){
		extract($_POST);
		$totalCount = $this->conn->query("SELECT * FROM `ekskul` where id = '{$this->settings->userdata('id_ekskul')}'")->num_rows;
		$search_where = "";
		if(!empty($search['value'])){
			$search_where .= "name LIKE '%{$search['value']}%' ";
			$search_where .= " OR deskripsi LIKE '%{$search['value']}%' ";
			$search_where .= " OR date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' ";
			$search_where = " and ({$search_where}) ";
		}
		$columns_arr = array("unix_timestamp(tanggal_diperbarui)",
							"unix_timestamp(tanggal_diperbarui)",
							"nama_ekskul",
							"deskripsi",
							"status",
							"unix_timestamp(birthdate)");
		$query = $this->conn->query("SELECT * FROM `ekskul`  where  id = '{$this->settings->userdata('id_ekskul')}' {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT * FROM `ekskul`  where  id = '{$this->settings->userdata('id_ekskul')}'  {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}

	
	// <=======================> 
	function dataEkskul(){
		extract($_POST);
 
		$totalCount = $this->conn->query("SELECT * FROM `ekskul` where  logo = 0 ")->num_rows;
		$search_where = "";
		if(!empty($search['value'])){
			$search_where .= "nama_ekskul LIKE '%{$search['value']}%' ";
			$search_where .= " OR deskripsi LIKE '%{$search['value']}%' ";
			$search_where .= " OR date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' ";
			$search_where = " and ({$search_where}) ";
		}
		$columns_arr = array("unix_timestamp(tanggal_diperbarui)",
							"unix_timestamp(tanggal_diperbarui)",
							"nama_ekskul",
							"deskripsi",
							"status",
							"unix_timestamp(birthdate)");
		$query = $this->conn->query("SELECT * FROM `ekskul`  where  logo = 0  {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT * FROM `ekskul`  where  logo = 0  {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}


	// <=======================> 
	
	function simpanPengguna(){
		if(empty($_POST['id'])){
			$_POST['password'] = password_hash(strtolower(substr($_POST['nama_depan'],0 ,1).$_POST['nama_belakang']), PASSWORD_DEFAULT);
		}
		if(isset($_POST['reset_password'])){
			$get=$this->conn->query("SELECT * FROM `pengguna` where id = '{$_POST['id']}'")->fetch_array();
			$_POST['password'] = password_hash(strtolower(substr($get['nama_depan'],0 ,1).$get['nama_belakang']), PASSWORD_DEFAULT);
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k,['id','reset_password']) && !is_array($_POST[$k])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `pengguna` set {$data}";
		}else{
			$sql = "UPDATE `pengguna` set {$data} where id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$uid= empty($id) ? $this->conn->insert_id : $id ;
			$resp['uid'] = $uid;
			$err = "";
			$resp['status'] = 'success';
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				if(!is_dir(base_app."uploads/users"))
					mkdir(base_app."uploads/users");
				$fname = 'uploads/pengguna/foto_profil-'.$uid.'.png';
				$dir_path =base_app. $fname;
				$upload = $_FILES['img']['tmp_name'];
				$type = mime_content_type($upload);
				$allowed = array('image/png','image/jpeg');
				if(!in_array($type,$allowed)){
					$err.=" But Image failed to upload due to invalid file type.";
				}else{
					$new_height = 200; 
					$new_width = 200; 
			
					list($width, $height) = getimagesize($upload);
					$t_image = imagecreatetruecolor($new_width, $new_height);
					imagealphablending( $t_image, false );
					imagesavealpha( $t_image, true );
					$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
					imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					if($gdImg){
							if(is_file($dir_path))
							unlink($dir_path);
							$uploaded_img = imagepng($t_image,$dir_path);
							if(isset($uploaded_img)){
								$this->conn->query("UPDATE pengguna set `foto_profil` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}' ");
							}
							imagedestroy($gdImg);
							imagedestroy($t_image);
					}else{
					$err.=" Format / Jenis Foto Tidak Mendukung";
					}
				}
			}
			if(empty($id))
				$this->settings->set_flashdata('success',"Pengguna Berhasil Ditambah");
			else
				$this->settings->set_flashdata('success',"Data Pengguna Berhasil Diperbarui");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Gagal Menyimpan Pengguna';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	// <=======================> 
	function simpanKetua(){
		if(empty($_POST['id'])){
			$_POST['password'] = password_hash(strtolower(substr($_POST['nama_depan'],0 ,1).$_POST['nama_belakang']), PASSWORD_DEFAULT);
		}
		if(isset($_POST['reset_password'])){
			$get=$this->conn->query("SELECT * FROM `pengguna` where id = '{$_POST['id']}'")->fetch_array();
			$_POST['password'] = password_hash(strtolower(substr($get['nama_depan'],0 ,1).$get['nama_belakang']), PASSWORD_DEFAULT);
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k,['id','reset_password']) && !is_array($_POST[$k])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `pengguna` set {$data}";
		}else{
			$sql = "UPDATE `pengguna` set {$data} where id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$uid= empty($id) ? $this->conn->insert_id : $id ;
			$resp['uid'] = $uid;
			$err = "";
			$resp['status'] = 'success';
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				if(!is_dir(base_app."uploads/users"))
					mkdir(base_app."uploads/users");
				$fname = 'uploads/pengguna/foto_profil-'.$uid.'.png';
				$dir_path =base_app. $fname;
				$upload = $_FILES['img']['tmp_name'];
				$type = mime_content_type($upload);
				$allowed = array('image/png','image/jpeg');
				if(!in_array($type,$allowed)){
					$err.=" But Image failed to upload due to invalid file type.";
				}else{
					$new_height = 200; 
					$new_width = 200; 
			
					list($width, $height) = getimagesize($upload);
					$t_image = imagecreatetruecolor($new_width, $new_height);
					imagealphablending( $t_image, false );
					imagesavealpha( $t_image, true );
					$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
					imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					if($gdImg){
							if(is_file($dir_path))
							unlink($dir_path);
							$uploaded_img = imagepng($t_image,$dir_path);
							if(isset($uploaded_img)){
								$this->conn->query("UPDATE pengguna set `foto_profil` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}' ");
							}
							imagedestroy($gdImg);
							imagedestroy($t_image);
					}else{
					$err.="  Format / Jenis Foto Tidak Mendukung";
					}
				}
			}
			if(empty($id))
				$this->settings->set_flashdata('success',"Ketua Berhasil Ditambahkan");
			else
				$this->settings->set_flashdata('success',"Data Ketua Berhasil DiPerbarui");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Gagal Menyimpan Pengguna';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	
	// <=======================> 
	function menghapusPengguna(){
		extract($_POST);
		// $get = $this->conn->query("SELECT * `users` where id = '{$id}' ")->fetch_array();
		$delete = $this->conn->query("DELETE FROM `pengguna` where id = '{$id}' ");
		if($delete){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Pengguna Berhasil Dihapus");
			if(isset($get['foto_profil'])){
				$get['foto_profil'] = explode("?",$get['foto_profil'])[0];
				if(is_file(base_app.$get['foto_profil']))
				unlink(base_app.$get['foto_profil']);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;

		}
		return json_encode($resp);
	}
	
	// <=======================> 
	function hapusKetua(){
		extract($_POST);
		// $get = $this->conn->query("SELECT * `users` where id = '{$id}' ")->fetch_array();
		$delete = $this->conn->query("DELETE FROM `pengguna` where id = '{$id}' ");
		if($delete){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Ketua Berhasil Dihapus");
			if(isset($get['foto_profil'])){
				$get['foto_profil'] = explode("?",$get['foto_profil'])[0];
				if(is_file(base_app.$get['foto_profil']))
				unlink(base_app.$get['foto_profil']);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;

		}
		return json_encode($resp);
	}

	// <=======================> 
	function dataPengguna(){
		extract($_POST);
		$totalCount = $this->conn->query("SELECT * FROM `pengguna` where id != '{$this->settings->userdata('id')}' ")->num_rows;
		$search_where = "";
		$columns_arr = array("unix_timestamp(tanggal_diperbarui)",
							"unix_timestamp(tanggal_diperbarui)",
							"CONCAT(nama_belakang, ', ',nama_depan,' ',COALESCE(nama_tengah,''))",
							"status",
							"unix_timestamp(birthdate)");

							// FITUR PENCARI
		if(!empty($search['value'])){
			$search_where .= "nama_depan LIKE '%{$search['value']}%' ";
			$search_where .= " OR nama_belakang LIKE '%{$search['value']}%' ";
			$search_where .= " OR nama_tengah LIKE '%{$search['value']}%' ";
			$search_where .= " OR CONCAT(nama_belakang, ', ',nama_depan,' ',COALESCE(nama_tengah,'')) LIKE '%{$search['value']}%' ";
			$search_where .= " OR CONCAT(nama_depan,' ',COALESCE(nama_tengah,''), ' ', nama_belakang) LIKE '%{$search['value']}%' ";
			$search_where .= " OR date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' or id_ekskul in (SELECT id FROM ekskul where nama_ekskul LIKE '%{$search['value']}%' ) ";
			$search_where = " and ({$search_where}) ";
		}
		
		$query = $this->conn->query("SELECT *,CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `pengguna` where id != '{$this->settings->userdata('id')}'  {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$query2 = $this->conn->query("SELECT * FROM `pengguna`  where id_ekskul != '{$this->settings->userdata('id_ekskul')}'  {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT * FROM `pengguna`  where id_ekskul != '{$this->settings->userdata('id_ekskul')}'  {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		$club_arr = [];
		$cids = array_column($query2->fetch_all(MYSQLI_ASSOC),'id_ekskul');
		if(count($cids) > 0){
			$ekskul = $this->conn->query("SELECT `nama_ekskul` as ekskul,id FROM ekskul where id in (".(implode(",",$cids)).")")->fetch_all(MYSQLI_ASSOC);
			$club_arr = array_column($ekskul,'ekskul','id');
		}
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['ekskul'] = isset($club_arr[$row['id_ekskul']]) ? $club_arr[$row['id_ekskul']] : "N/A";
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}

	// <=======================> 
	function dataKetua(){
		extract($_POST);
		$totalCount = $this->conn->query("SELECT * FROM `pengguna` where id_ekskul = '{$this->settings->userdata('id_ekskul')}' and tipe != '{$this->settings->userdata('tipe')}' ")->num_rows;
		$search_where = "";
		$columns_arr = array("unix_timestamp(tanggal_diperbarui)",
							"unix_timestamp(tanggal_diperbarui)",
							"CONCAT(nama_belakang, ', ',nama_depan,' ',COALESCE(nama_tengah,''))",
							"status",
							"unix_timestamp(birthdate)");

							// FITUR PENCARI
		if(!empty($search['value'])){
			$search_where .= "nama_depan LIKE '%{$search['value']}%' ";
			$search_where .= " OR nama_belakang LIKE '%{$search['value']}%' ";
			$search_where .= " OR nama_tengah LIKE '%{$search['value']}%' ";
			$search_where .= " OR CONCAT(nama_belakang, ', ',nama_depan,' ',COALESCE(nama_tengah,'')) LIKE '%{$search['value']}%' ";
			$search_where .= " OR CONCAT(nama_depan,' ',COALESCE(nama_tengah,''), ' ', nama_belakang) LIKE '%{$search['value']}%' ";
			$search_where .= " OR date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' or id_ekskul in (SELECT id FROM ekskul where nama_ekskul LIKE '%{$search['value']}%' ) ";
			$search_where = " and ({$search_where}) ";
		}
		
		$query = $this->conn->query("SELECT *,CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `pengguna` where id_ekskul = '{$this->settings->userdata('id_ekskul')}' and tipe != '{$this->settings->userdata('tipe')}' {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$query2 = $this->conn->query("SELECT * FROM `pengguna`  where id_ekskul = '{$this->settings->userdata('id_ekskul')}' and tipe != '{$this->settings->userdata('tipe')}' {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT * FROM `pengguna`  where id_ekskul != '{$this->settings->userdata('id_ekskul')}' and tipe != '{$this->settings->userdata('tipe')}' {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		$club_arr = [];
		$cids = array_column($query2->fetch_all(MYSQLI_ASSOC),'id_ekskul');
		if(count($cids) > 0){
			$ekskul = $this->conn->query("SELECT `nama_ekskul` as ekskul,id FROM ekskul where id in (".(implode(",",$cids)).")")->fetch_all(MYSQLI_ASSOC);
			$club_arr = array_column($ekskul,'ekskul','id');
		}
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['ekskul'] = isset($club_arr[$row['id_ekskul']]) ? $club_arr[$row['id_ekskul']] : "N/A";
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}

	// <=======================> 
	function simpanPendaftaran(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k,['id','content'])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `pendaftar` set {$data}";
		}else{
			$sql = "UPDATE `pendaftar` set {$data} where id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$cid= empty($id) ? $this->conn->insert_id : $id ;
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"Pendaftaran Berhasil Dilakukan, Ketua Ekskul Akan Memberitahu Penerimaan Melalui Nomor Wa / Email ");
			else
				$this->settings->set_flashdata('success',"Status Pendaftar Berhasil Diperbarui ");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Gagal Menyimpan Pendaftar';
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		return json_encode($resp);
	}

	// <=======================> 
	function hapusPendaftar(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `pendaftar` where id = '{$id}' ");
		if($delete){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Pendaftar Berhasil Dihapus");
		}else{
			$resp['status'] = 'Gagal Menghapus';
			$resp['error'] = $this->conn->error;

		}
		return json_encode($resp);
	}
	
	// <=======================> 
	function dataPendaftarEkskul(){
		extract($_POST);
 
		$totalCount = $this->conn->query("SELECT * FROM `pendaftar` where id_ekskul = '{$this->settings->userdata('id_ekskul')}'")->num_rows;
		$search_where = "";
		$columns_arr = array("unix_timestamp(p.tanggal_diperbarui)",
							"unix_timestamp(p.tanggal_diperbarui)",
							"CONCAT(p.kelas, ' - ',p.jurusan)",
							"p.status");
							// CARI
		if(!empty($search['value'])){
			$search_where .= "p.nama_lengkap LIKE '%{$search['value']}%' ";
			$search_where .= " OR p.nisn LIKE '%{$search['value']}%' ";
			$search_where .= " OR p.kelas LIKE '%{$search['value']}%' ";
			$search_where .= " OR p.jurusan LIKE '%{$search['value']}%' ";
			$search_where .= " OR p.date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' ";
			$search_where = " and ({$search_where}) ";
		}
		
		$query = $this->conn->query("SELECT p.*, CONCAT(p.kelas,' - ',p.jurusan) as `kelas_jurusan`, e.nama_ekskul as ekskul FROM `pendaftar` p inner join ekskul e on p.id_ekskul = e.id where p.id_ekskul = '{$this->settings->userdata('id_ekskul')}'  {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT p.* FROM `pendaftar` p inner join ekskul e on p.id_ekskul = e.id where p.id_ekskul = '{$this->settings->userdata('id_ekskul')}'  {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}

	// <=======================> 
	function dataAnggota(){
		extract($_POST);
		$totalCount = $this->conn->query("SELECT * FROM `anggota` where id_ekskul = '{$this->settings->userdata('id_ekskul')}'")->num_rows;
		$search_where = "";
		if(!empty($search['value'])){
			$search_where .= "a.nama_lengkap LIKE '%{$search['value']}%' ";
			$search_where .= "OR a.nisn LIKE '%{$search['value']}%' ";
			$search_where .= " OR a.kelas LIKE '%{$search['value']}%' ";
			$search_where .= " OR a.date_format(tanggal_diperbarui,'%M %d, %Y') LIKE '%{$search['value']}%' ";
			$search_where = " and ({$search_where}) ";
		}
		$columns_arr = array("unix_timestamp(a.tanggal_diperbarui)",
							"unix_timestamp(a.tanggal_diperbarui)",
							"CONCAT(a.kelas, ' - ',a.jurusan)",
							"(a.jenis_kelamin)");
							
		$query = $this->conn->query("SELECT a.*, CONCAT(a.kelas,' - ',a.jurusan) as `kelas_jurusan`, e.nama_ekskul as ekskul FROM `anggota` a inner join ekskul e on a.id_ekskul = e.id where a.id_ekskul = '{$this->settings->userdata('id_ekskul')}'  {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
		$recordsFilterCount = $this->conn->query("SELECT a.* FROM `anggota` a inner join ekskul e on a.id_ekskul = e.id where a.id_ekskul = '{$this->settings->userdata('id_ekskul')}'  {$search_where} ")->num_rows;
		
		$recordsTotal= $totalCount;
		$recordsFiltered= $recordsFilterCount;
		$data = array();
		$i= 1 + $start;
		while($row = $query->fetch_assoc()){
			$row['no'] = $i++;
			$row['tanggal_diperbarui'] = date("F d, Y H:i",strtotime($row['tanggal_diperbarui']));
			$data[] = $row;
		}
		echo json_encode(array('draw'=>$draw,
							'recordsTotal'=>$recordsTotal,
							'recordsFiltered'=>$recordsFiltered,
							'data'=>$data
							)
		);
	}

	// <=======================> 
	function simpanAnggota(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k,['id',
			'content'])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `anggota` set {$data}";
		}else{
			$sql = "UPDATE `anggota` set {$data} where id_anggota = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$cid= empty($id) ? $this->conn->insert_id : $id ;
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"Data Anggota Behasil Ditambah");
			else
				$this->settings->set_flashdata('success',"Data Anggota Berhasil Di perbarui ");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Gagal Menyimpan';
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		return json_encode($resp);
	}

	// <=======================> 
	function hapusAnggota(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `anggota` where id_anggota = '{$id}' ");
		if($delete){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Anggota Berhasil Dihapus");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;

		}
		return json_encode($resp);
	}	
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'memuat_semua_ekskul':
		echo $Master->memuatSemuaEkskul();
	break;
	case 'memuat_ekskul':
		echo $Master->memuatEkskul();
	break;
	case 'simpan_ekskul':
		echo $Master->simpanEkskul();
	break;
	case 'hapus_ekskul':
		echo $Master->hapusEkskul();
	break;
	case 'ekskul_yang_dikelola':
		echo $Master->ekskulYangDikelola();
	break;
	case 'data_ekskul':
		echo $Master->dataEkskul();
	break;
	case 'simpan_pengguna':
		echo $Master->simpanPengguna();
	break;
	case 'simpan_ketua':
		echo $Master->simpanKetua();
	break;
	case 'menghapus_pengguna':
		echo $Master->menghapusPengguna();
	break;
	case 'hapus_ketua':
		echo $Master->hapusKetua();
	break;
	case 'data_pengguna':
		echo $Master->dataPengguna();
	break;
	case 'data_ketua':
		echo $Master->dataKetua();
	break;
	case 'simpan_pendaftaran':
		echo $Master->simpanPendaftaran();
	break;
	case 'hapus_pendaftar':
		echo $Master->hapusPendaftar();
	break;
	case 'data_pendaftar_ekskul':
		echo $Master->dataPendaftarEkskul();
	break;
	case 'data_anggota':
		echo $Master->dataAnggota();
	break;
	case 'simpan_anggota':
		echo $Master->simpanAnggota();
	break;
	case 'hapus_anggota':
		echo $Master->hapusAnggota();
	break;
	default:
		// echo $sysset->index();
		break;
}