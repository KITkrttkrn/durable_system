<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('login_model');
		$this->load->model('durable_model');
		$this->load->model('report_model');
		$this->load->model('user_model');
		$this->load->model('sysconfig');
		$this->load->helper('authen');
	}

	public function get_major_id()
	{
        if(isset($_GET["pro_id"]) && !empty($_GET["pro_id"])){
            //Get all state data
            $major_id = $this->input->get('pro_id');
            $query = $this->user_model->get_major_id($major_id);
            
            //Count total number of rows
            $rowCount = count($query);
            
            //Display district list
            if($rowCount > 0){
                echo '<option value="">----สาขา---</option>';
                foreach($query as $r){ 
                    echo '<option value="'.$r->major_id.'">'.$r->major_name.'</option>';
                }
            }else{
                echo '<option value="">State not available</option>';
            }
        }
        
	}
}

