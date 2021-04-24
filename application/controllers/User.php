<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->model('login_model');
		$this->load->model('durable_model');
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('sysconfig');
        $this->load->helper('authen');
        $this->load->helper('token');
	}
	
	public function manage_users()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		$query = $this->user_model->get_users();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/manage_users',
			'menu' => 'manage_users',
			'query' => $query
		);
		$this->load->view('main',$data);
	}
	public function user_detail($id)
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		$query = $this->user_model->get_user_detail($id);
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/user_detail',
			'menu' => 'manage_users',
			'query' => $query
		);
		$this->load->view('main',$data);
	}

	public function process_user_detail()
	{
		authen_sysadmin();
		$user_id = $this->input->post('user_id');
		$user_status_id = $this->input->post('user_status');
		$sysname = $this->sysconfig->sysname();
		$query = $this->user_model->update_user_detail($user_id,$user_status_id);
		if($query){
			echo "<script> alert('แก้ไขสถานะผู้ใช้งานเรียบร้อย'); </script>";
		}else{
			echo "<script> alert('ไม่สามารถแก้ไขสถานะผู้ใช้งานได้'); </script>";
		}
		redirect("backend/user_detail/".$user_id,"refresh");
	}

	public function form_user($id = NULL)
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if ($id != NULL)
		{
			if(isset($_SESSION['login_true_superadmin']) OR $id == $_SESSION['uid']){
				$prom_form = "แก้ไขข้อมูลผู้ใช้งาน";
				$o_id = $id;	
				
				$result = $this->user_model->get_user_update($o_id);
				$query_fac = $this->user_model->get_faculty();
				$query_major = $this->user_model->get_major_id($result[0]->major_id);
				$query_type = $this->user_model->get_type();
				foreach($result as $row) 
				{
					$data = array(
						'sysname' => $sysname[0]->sysvalue,
						'page' => 'backend/form_user',
						'menu' => 'edit_profile',
						'prom_form' => $prom_form,
						'mode' => 'U',
						'user_id' => $row->user_id,
						'user_name' => $row->user_name,
						'user_surname' => $row->user_surname,
						'user_email' => $row->user_email,
						'user_password' => $row->user_password,
						'type_user_id' => $row->type_user_id,
						'register_date' => $row->register_date,
						'major_id' => $row->major_id,
						'faculty_id' => $row->faculty_id,
						'query_faculty' => $query_fac,
						'query_major' => $query_major,
						'query_type' => $query_type,
					);
					
				}  
				$this->load->view('main',$data);
			}else{
				echo "<script> alert('ไม่สามารถเพิ่มผู้ใช้งานได้'); </script>";
				redirect("dashboard","refresh");
			}
		}else{
				$query = $this->user_model->get_faculty();
				$prom_form ="ลงทะเบียนทะเบียนผู้ใช้งาน";
				$data = array(
					'sysname' => $sysname[0]->sysvalue,
					'page' => 'backend/form_user',
					'menu' => 'form_users',
					'prom_form' => $prom_form,
					'mode' => 'I',
					'user_id' => "",
					'register_date' => "",
					'user_name' => "",
					'user_surname' => "",
					'user_email' => "",
					'user_password' => "",
					'type_user_id' => "U",
					'major_id' => "",
					'faculty_id' => "",
					'query_faculty' => $query,
				);  
				$this->load->view('main',$data);
		}
	}

	public function save_user()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if($_POST['mode'] == 'I'){
			$this->form_validation->set_rules('user_email','Email','required|is_unique[users.user_email]');
			if($this->form_validation->run() == TRUE){

				$token = getToken(40);
				$data = array(
					'user_name' => $_POST['user_name'],
					'user_surname' => $_POST['user_surname'],
					'user_email' => $_POST['user_email'],
					'type_user_id' => $_POST['type_user_id'],
					'major_id' => $_POST['major_id'],
					'user_status_id' => 'N',
					'user_token' => $token,
					'register_date' => date("Y-m-d H:i:s")
				);
				$query = $this->user_model->insert_user($data);
				if($query){
					echo "<script> alert('เพิ่มผู้ใช้งานเรียบร้อย'); </script>";
					$email_link = site_url()."activation?email=".$_POST['user_email']."&token=".$token;
					$user_mail = $this->sysconfig->user_mail();
					$user_pass = $this->sysconfig->user_pass();
					$mail_port = $this->sysconfig->mail_port();
					$mail_host = $this->sysconfig->smtp_host();
					$config = array(
						'protocol'  => 'smtp',
						'smtp_host' => $mail_host[0]->sysvalue,
						'smtp_port' => $mail_port[0]->sysvalue,
						'smtp_user' => $user_mail[0]->sysvalue,
						'smtp_pass' => $user_pass[0]->sysvalue,
						'mailtype'  => 'html',
						'charset'   => 'utf-8'
					);
					// print_r($config);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");
	
					//Email content
					$htmlContent = '<h1>Durable System</h1>';
					$htmlContent .= '<p>สวัสดี คุณ'.$_POST['user_name'].' '.$_POST['user_surname'].'</p>';
					$htmlContent .= '<p>ลิงค์สำหรับยืนยันการเปิดบัญชีของท่านคือ</p>';
					$htmlContent .= '<p>'.$email_link.'</p>';
	
					$this->email->to($_POST['user_email']);
					$this->email->from($user_mail[0]->sysvalue,'Durable System');
					$this->email->subject('ยืนยันการสมัครบัญชีการใช้งาน');
					$this->email->message($htmlContent);
					
					//Send email	
					$this->email->send();
											
				}else{
					echo "<script> alert('ไม่สามารถเพิ่มผู้ใช้งานได้'); </script>";
				}
	
			}else{
				echo "<script> alert('Email นี้ซ้ำอยู่บนระบบแล้ว'); </script>";
			}

			
		}else if($_POST['mode'] == 'U'){
            $id = $_POST['user_id'];
            if(strlen($_POST['user_password']) != 40)
            {
                $user_password = "sha1('".$_POST['user_password']."')";
                $data = array(
                    'user_name' => $_POST['user_name'],
                    'user_surname' => $_POST['user_surname'],
                    'user_email' => $_POST['user_email'],
                    'type_user_id' => $_POST['type_user_id'],
                    'major_id' => $_POST['major_id'],
                );
                $query = $this->user_model->update_user($id,$data);
                $query = $this->user_model->update_user_and_pass($id,$user_password);
            }else{
                $data = array(
                    'user_name' => $_POST['user_name'],
                    'user_surname' => $_POST['user_surname'],
                    'user_email' => $_POST['user_email'],
                    'type_user_id' => $_POST['type_user_id'],
                    'major_id' => $_POST['major_id'],
                );
                $query = $this->user_model->update_user($id,$data);
            }
			if($query){
				echo "<script> alert('แก้ไขสถานะผู้ใช้งานเรียบร้อย'); </script>";
			}else{
				echo "<script> alert('ไม่สามารถแก้ไขสถานะผู้ใช้งานได้'); </script>";
			}
		}
		redirect("insert_user","refresh");
    }
    
    public function update_profile()
    {
        if($_POST['mode'] == 'U'){
            $o_id = $_POST['o_id'];
            if(strlen($_POST['password']) != 40)
            {
                
                $data = array(
                    'user_name' => $_POST['user_name'],
                    'user_surname' => $_POST['user_surname'],
                    'user_email' => $_POST['user_email'],
                    'type_user_id' => $_POST['type_user_id'],
                    'major_id' => $_POST['major_id'],
                    'user_password' => $_POST['u_pass'],
                );
            }else{
                $data = array(
                    'user_name' => $_POST['user_name'],
                    'user_surname' => $_POST['user_surname'],
                    'user_email' => $_POST['user_email'],
                    'type_user_id' => $_POST['type_user_id'],
                    'major_id' => $_POST['major_id'],
                );
            }
			$query = $this->user_model->update_user($id,$data);
			if($query){
				echo "<script> alert('แก้ไขสถานะผู้ใช้งานเรียบร้อย'); </script>";
			}else{
				echo "<script> alert('ไม่สามารถแก้ไขสถานะผู้ใช้งานได้'); </script>";
			}
		}
    }

	public function activation()
	{
		$sysname = $this->sysconfig->sysname();
		if($_GET){
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'user_email' => $_GET['email'],
				'user_token' => $_GET['token'],
			);
			$this->load->view('backend/form_activation',$data);
		}
	}

	public function process_activation()
	{
		if($_POST){
			$user_mail = $_POST['email'];
			$user_token = $_POST['token'];
			$user_password = "sha1('".$_POST['password1']."')";
			$result = $this->user_model->update_password($user_mail,$user_password,$user_token);
			if($result){
				echo "<script> alert('ยืนยันเปิดบัญชีผู้ใช้งานเรียบร้อย'); </script>";
			}else{
				echo "<script> alert('ไม่สามารถยืนยันเปิดบัญชีผู้ใช้งานได้'); </script>";
			}
			redirect("backend","refresh");
		}
	}
}
