<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pdf extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('mpdf');
		$this->load->model('report_model');
        $this->load->model('user_model');
        $this->load->model('report_model');
		$this->load->model('sysconfig');
        $this->load->helper('authen');
		$this->load->library('ciqrcode');
		$this->load->helper('file');
    }

    function report($id) 
    {
        authen_sys();
        $page = 'pdf/report';
		$data['query'] = $this->report_model->get_problem_detail($id);
        $this->load->view($page,$data);
    }

    function qrcode($id) 
    {
        authen_sys();
		$qrtext = "hello\n";
		$data['img_url'] = "";
		$qr_image=rand().'.png';
		$params['data'] = site_url('qrdurable_detail/'.$id);
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
		if($this->ciqrcode->generate($params))
		{
			$data['img_url'] = $qr_image;	
			$data['query'] = $this->report_model->get_durable_detail($id);
		}
		$this->load->view('pdf/qrcode',$data);
		// delete_files('uploads/qr_image', TRUE);
	}
}