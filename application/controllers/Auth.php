<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('login_model');

	}

	// public function index()
	// {
	// 	if (isset($_SESSION['login_true_sys']) OR isset($_SESSION['login_true_sysadmin'])) {
	// 		redirect('backend','refresh');
	// 		//redirect("javascript: window.history.go(-1)" );
	// 	}else{
	// 		redirect('auth/login','refresh');
	// 	}
	// }

	public function login()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run() == TRUE){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = $this->login_model->checkLogin($username,$password);
			if(isset($user[0]->user_id)){
				if($user[0]->user_status_id == 'Y')
				{
					$_SESSION['uid'] = $user[0]->user_id;
					$_SESSION['utype']  = $user[0]->type_user_id;

					if($user[0]->type_user_id == 'A')
					{
						$_SESSION['login_true_sysadmin'] = $user[0]->uname;
						$_SESSION['login_true'] = $user[0]->uname;
					}
					elseif($user[0]->type_user_id == 'U')
					{
						$_SESSION['login_true_sys'] = $user[0]->uname;
                        $_SESSION['login_true'] = $user[0]->uname;						
					}
					elseif($user[0]->type_user_id == 'S')
					{
						$_SESSION['login_true_sysadmin'] = $user[0]->uname;
						$_SESSION['login_true_superadmin'] = $user[0]->uname;
						$_SESSION['login_true'] = $user[0]->uname;
					}

					$_SESSION['DuRaBlEsYsTeM'] = 1;
					// temporary message
					$welcome_string = "ยินดีต้อนรับ คุณ".$user[0]->uname;
					echo "<script>alert('".$welcome_string."');</script>";

					//redirect to index after login
					redirect("dashboard","refresh");

					
				}else{
					$this->session->set_flashdata(array('error' => 'กรุณา Activate บัญชีของคุณ'));
					redirect('login','refresh');			
				}


			}else{
				$this->session->set_flashdata(array('error' => 'ขออภัย ไม่มีบัญชีของท่านอยู่ในระบบ'));
				redirect('login','refresh');
			}
		}
		$sysname = $this->sysconfig->sysname();
		$data = array('sysname' => $sysname[0]->sysvalue);
		$this->load->view('backend/login', $data);

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("auth/login","refresh");
	}
}

