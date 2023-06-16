<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	// LOGIN ADMINISTRATOR / WAKA
	public function admin(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from pengguna where nama_pengguna = ? and `tipe` = 1 ");
		$stmt->bind_param("s",$nama_pengguna);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$data = $result->fetch_array();
			if(password_verify($password, $data['password'])){
				foreach($data as $k => $v){
					if(!is_numeric($k) && $k != 'password'){
						$this->settings->set_userdata($k,$v);
					}
				}
				$this->settings->set_userdata('login_type',1);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Nama Pengguna Atau Password Salah';
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Nama Pengguna Atau Password Salah';
		}
		return json_encode($resp);
	}
	public function adminLogout(){
		if($this->settings->sess_des()){
			redirect('admin/FormLogin.php');
		}
	}


	public function pembina(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from pengguna where nama_pengguna = ? and `tipe` = 2 ");
		$stmt->bind_param("s",$nama_pengguna);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$data = $result->fetch_array();
			if(password_verify($password, $data['password'])){
				foreach($data as $k => $v){
					if(!is_numeric($k) && $k != 'password'){
						$this->settings->set_userdata($k,$v);
					}
				}
				$this->settings->set_userdata('login_type',1);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Nama Pengguna atau Password Salah';
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Nama Pengguna atau Password Salah';
		}
		return json_encode($resp);
	}
	public function pembinaLogout(){
		if($this->settings->sess_des()){
			redirect('pembina_ekskul/FormLogin.php');
		}
	}
	
	public function ketua(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from pengguna where nama_pengguna = ? and `tipe` = 3 ");
		$stmt->bind_param("s",$nama_pengguna);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$data = $result->fetch_array();
			if(password_verify($password, $data['password'])){
				foreach($data as $k => $v){
					if(!is_numeric($k) && $k != 'password'){
						$this->settings->set_userdata($k,$v);
					}
				}
				$this->settings->set_userdata('login_type',3);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Nama Pengguna atau Password Salah';
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Nama Pengguna atau Password Salah';
		}
		return json_encode($resp);
	}
	public function ketuaLogout(){
		if($this->settings->sess_des()){
			redirect('ketua_ekskul/FormLogin.php');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'admin':
		echo $auth->admin();
		break;
	case 'admin_logout':
		echo $auth->adminLogout();
		break;
	case 'pembina':
		echo $auth->pembina();
		break;
	case 'pembina_logout':
		echo $auth->pembinaLogout();
		break;
	case 'ketua':
		echo $auth->ketua();
		break;
	case 'ketua_logout':
		echo $auth->ketuaLogout();
		break;
	default:
		echo $auth->index();
		break;
}

