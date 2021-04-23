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
        if(isset($_GET["fac_id"]) && !empty($_GET["fac_id"])){
            //Get all state data
            $fac_id = $this->input->get('fac_id');
            $query = $this->user_model->get_major_id($fac_id);
            
            //Count total number of rows
            $rowCount = count($query);
            
            //Display district list
            if($rowCount > 0){
                echo '<option value="">---สาขา---</option>';
                foreach($query as $r){ 
                    echo '<option value="'.$r->major_id.'">'.$r->major_name.'</option>';
                }
            }else{
                echo '<option value="">สาขา</option>';
            }
        }
        
    }

    public function get_course_id()
	{
        if(isset($_GET["major_id"]) && !empty($_GET["major_id"])){
            //Get all state data
            $major_id = $this->input->get('major_id');
            $query = $this->user_model->get_course_id($major_id);
            
            //Count total number of rows
            $rowCount = count($query);
            
            //Display district list
            if($rowCount > 0){
                echo '<option value="">---หลักสูตร---</option>';
                echo '<option value="0">ไม่มีหลักสูตร</option>';
                foreach($query as $r){ 
                    echo '<option value="'.$r->course_id.'">'.$r->course_name.'</option>';
                }
            }else{
                echo '<option value="">ไม่มีหลักสูตร</option>';
            }
        }
        
    }
    
    public function get_building_id()
	{
        if(isset($_GET["campus_id"]) && !empty($_GET["campus_id"])){
            //Get all state data
            $campus_id = $this->input->get('campus_id');
            $query = $this->user_model->get_building_id($campus_id);
            
            //Count total number of rows
            $rowCount = count($query);
            
            //Display district list
            if($rowCount > 0){
                echo '<option value="0">---อาคาร---</option>';
                foreach($query as $r){ 
                    echo '<option value="'.$r->building_id.'">'.$r->building_name.'</option>';
                }
            }else{
                echo '<option value="">ไม่มีอาคาร</option>';
            }
        }
        
    }
    
    public function get_room_id()
	{
        if(isset($_GET["building_id"]) && !empty($_GET["building_id"])){
            //Get all state data
            $building_id = $this->input->get('building_id');
            $query = $this->user_model->get_room_id($building_id);
            
            //Count total number of rows
            $rowCount = count($query);
            
            //Display district list
            if($rowCount > 0){
                echo '<option value="0">---ห้อง---</option>';
                foreach($query as $r){ 
                    echo '<option value="'.$r->room_id.'">'.$r->room_name.'</option>';
                }
            }else{
                echo '<option value="">ไม่มีห้อง</option>';
            }
        }
        
	}
}

