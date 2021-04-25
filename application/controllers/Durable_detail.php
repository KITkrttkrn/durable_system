<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Durable_detail extends CI_Controller {

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
		$this->load->model('frontend_model');
		$this->load->model('sysconfig');
		$this->load->library('form_validation');
		$this->load->library('curl');
	}

	public function index($durable_id = 0)
	{
		if($durable_id != 0){
			$sysname = $this->sysconfig->sysname();
			$sysvalue = 'sysvalue';
			$query = $this->frontend_model->get_durable_detail($durable_id);
			$data = array('query' => $query,
				          'sysname' => $sysname[0]->$sysvalue
				          );
			$this->load->view('frontend/qrdurable_details.php',$data);
		}else{
			echo "<script> alert('กรุณาสแกน QR Code ก่อน ครับ/ค่ะ');</script>";
		}
		
	}
	public function sign($durable_id = 0)
	{
		if($durable_id != 0){
			if($this->frontend_model->insert_sign($durable_id)){ 
				redirect("success","refresh");
			}

		}else{
			echo "<script> alert('กรุณาสแกน QR Code ก่อนลงชื่อใช้งาน ครับ/ค่ะ'); </script>";
		}
	}

	public function report_view($durable_id = 0)
	{
		if($durable_id != 0){
			$sysname = $this->sysconfig->sysname();
			$query = $this->frontend_model->get_durable_detail($durable_id);
			$data = array('query' => $query,
				          'sysname' => $sysname[0]->sysvalue
				          );
			$this->load->view('frontend/qrdurable_report.php',$data);
		}else{
			echo "<script> alert('กรุณาสแกน QR Code ก่อน ครับ/ค่ะ');</script>";
		}
	}

	public function process_report()
	{
		if(isset($_POST['durable_id'])){

			$durable_id = $this->input->post('durable_id');
			$problem_topic = $this->input->post('report_topic');
			$problem_detail = $this->input->post('report_detail');
			$reporter_id = $this->input->post('reporter_id');
			$reporter_name = $this->input->post('reporter_name');
			$reporter_surname = $this->input->post('reporter_surname');
			$problem_status_id = 1;

			$recaptcha_secret = "6Lda_3kUAAAAAImTR39uKEUeLcop0VBrGc9h7RtW";
			$recaptcha_response = trim($this->input->post('g-recaptcha-response'));
			$recaptcha_remote_ip = $_SERVER['REMOTE_ADDR'];
			 
			$recaptcha_api = "https://www.google.com/recaptcha/api/siteverify?".
				http_build_query(array(
					'secret'=>$recaptcha_secret,
					'response'=>$recaptcha_response,
					'remoteip'=>$recaptcha_remote_ip
				)
			);
			$response=json_decode(file_get_contents($recaptcha_api), true);    

			$string_value = array( 'durable_id' => $durable_id,
				                   'problem_topic' => $problem_topic,
				                   'problem_detail' => $problem_detail,
				                   'reporter_id' => $reporter_id,
				                   'reporter_name' => $reporter_name,
				                   'reporter_surname' => $reporter_surname,
				                   'problem_status_id' => $problem_status_id,
								   'report_datetime' => date("Y-m-d H:i:s")
			);
			$query = $this->frontend_model->insert_report($string_value);
			if($query AND $response){
				$message = $this->sysconfig->getLineMessage();
				$token = $this->sysconfig->getLineToken();
				$this->curl->line_api($message[0]->sysvalue,$token[0]->sysvalue);
				redirect("success","refresh");
			}
		}else{
			echo "<script> alert('ไม่สามารถใช้งานหน้านี้ได้ค่ะ');</script>";
		}
	}

	public function success()
	{
		echo "<script> alert('ดำเนินการเรียบร้อยแล้ว ขอบคุณค่ะ');</script>";
		echo "<center> ดำเนินการเรียบร้อยแล้ว ขอบคุณค่ะ </center>";
	}
}

