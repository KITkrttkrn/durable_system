<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model('report_model');
		$this->load->model('sysconfig');
		$this->load->library('form_validation');
		$this->load->library('curl');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function index2()
	{
		print_r($_SESSION);
	}

	public function testcurl()
	{
		
		$message = 'Krittikarn';
		$token = 'tkeqpOee6cn11o537QrwCpbJolKAYwBpzNNTNzbTHrO'; // ใส่ token key ที่ได้มา

		$this->curl->line_api($message,$token);
	}

	public function test_pdf()
	{
		$page = 'pdf/report';
		$data['query'] = $this->report_model->get_problem_detail(13);
        $this->load->view($page,$data);
	}
	public function test_ser()
	{
		echo $_SERVER['REQUEST_URI'];
	}
	
}
