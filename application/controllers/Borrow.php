<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrow extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->library('upload');
		$this->load->model('login_model');
		$this->load->model('durable_model');
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('sysconfig');
		$this->load->model('borrow_model');
		$this->load->helper('authen');
	}

	public function index()
	{
		authen_sys();
		$available_durable = $this->borrow_model->get_durable_available();
		$borrowing_durable = $this->borrow_model->get_durable_borrowing();
		$borrow_his = $this->borrow_model->get_borrow_history($_SESSION['uid']);
		$sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/borrow_durable',
			'menu' => 'borrow_durable',
			'borrow_his' => $borrow_his,
			'borrowing' => $borrowing_durable,
			'available_durable' => $available_durable,
		);
		$this->load->view('main',$data);
	}

	public function borrowing()
	{
		authen_sys();
		$available_durable = $this->borrow_model->get_durable_available();
		$sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/borrowing',
			'menu' => 'borrow_durable',
			'available_durable' => $available_durable,
		);
		$this->load->view('main',$data);
	}

	public function process_borrow()
	{
		authen_sys();
		if($_POST['durable_id'] == "" OR $_POST['return_date'] == ""){
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}else{
			$borrow_status_id = '1';
			$data = array(
				'durable_id' => $_POST['durable_id'],
				'users_user_id' => $_SESSION['uid'],
				'due_date' => $_POST['return_date'],
				'borrow_status_id' => $borrow_status_id,
			);
			$available_durable = $this->borrow_model->insert_borrow($data);
			$update_durable = $this->borrow_model->update_borrow_durable($_POST['durable_id'],$borrow_status_id);
			if($available_durable AND $update_durable){
				echo "<script> alert('ทำการยืมเรียบร้อย') </script>";
				redirect('borrow_durable','refresh');
				
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}
	}

	public function return()
	{
		authen_sys();
		$borrow_his = $this->borrow_model->get_borrowing_history($_SESSION['uid']);
		$sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/return',
			'menu' => 'borrow_durable',
			'borrow_his' => $borrow_his,
		);
		$this->load->view('main',$data);
	}

	public function process_return()
	{
		authen_sys();
		if($_POST['borrow_id'] == ""){
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}else{
			
			$borrow_status_id = '2';
			$borrow_id = $_POST['borrow_id'];
			$borrow_data = $this->borrow_model->get_durable_borrowing($borrow_id);
			$data = array(
				'borrow_status_id' => $borrow_status_id,
			);
			// print_r($borrow_data);
			$available_durable = $this->borrow_model->update_borrow($borrow_id,$data);
			$update_durable = $this->borrow_model->update_borrow_durable($borrow_data[0]->durable_id,$borrow_status_id);
			if($available_durable AND $update_durable){
				echo "<script> alert('ทำการคืนเรียบร้อย') </script>";
				redirect('borrow_durable','refresh');
				
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}
	}

}

