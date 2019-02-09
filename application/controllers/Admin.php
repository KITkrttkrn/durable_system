<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('upload');
		$this->load->model('login_model');
		$this->load->model('durable_model');
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('sysconfig');
		$this->load->helper('authen');
	}

	public function setting_name()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_name',
            'menu' => 'setting_name',
            'query' => $this->sysconfig->sysname(),
		);
		$this->load->view('main',$data);
	}
	
	public function setting_line()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_line',
            'menu' => 'setting_line',
			'query' => $this->sysconfig->getLineToken(),
			'query2' => $this->sysconfig->getLineMessage(),
		);
		$this->load->view('main',$data);
	}
	
	public function setting_mail()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_mail',
            'menu' => 'setting_mail',
			'query_mail' => $this->sysconfig->user_mail(),
			'query_pass' => $this->sysconfig->user_pass(),
			'query_smtp' => $this->sysconfig->smtp_host(),
			'query_port' => $this->sysconfig->mail_port(),
		);
		$this->load->view('main',$data);
    }
    
    public function process_setting()
	{
		authen_sysadmin();
		$syscode = $_POST['syscode'];
		$data = array(
			'sysvalue' => $_POST['sysvalue'],
		);
		$result = $this->sysconfig->updatesysconfig($syscode,$data);
		if($result){
			echo "<script> alert('ทำรายการเรียบร้อย') </script>";
			redirect($_POST['viewname'],'refresh');
		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
	}

	public function manage_cat()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/manage_cat',
            'menu' => 'manage_cat',
			'query' => $this->durable_model->get_cat(),
		);
		$this->load->view('main',$data);
	}
	public function add_cat()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_cat',
			'menu' => 'manage_cat',
			'cat_id' => "",
			'cat_name' => "",
			'durable_age' => "",
			'mode' => "I",
		);
		$this->load->view('main',$data);
	}
	
	public function edit_cat($id)
	{
		authen_sysadmin();
		$cat = $this->durable_model->get_cat($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_cat',
            'menu' => 'manage_cat',
			'cat_id' => $cat[0]->cat_id,
			'cat_name' => $cat[0]->cat_name,
			'durable_age' => $cat[0]->durable_age,
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}
	
	public function delete_cat($id)
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		redirect('setting_cat','refresh');
	}
	
	public function process_cat()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'cat_name' => $_POST['cat_name'],
				'durable_age' => $_POST['durable_age'],
			);
			$r = $this->durable_model->insertCat($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_cat','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'cat_name' => $_POST['cat_name'],
				'durable_age' => $_POST['durable_age'],
			);
			$r = $this->durable_model->updateCat($_POST['cat_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_cat','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
    }

}