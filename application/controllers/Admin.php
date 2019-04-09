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
			'prom_name' => "เพิ่มข้อมูลประเภทครุภัณฑ์",
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
			'prom_name' => "แก้ไขข้อมูลประเภทครุภัณฑ์",
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}
	
	public function delete_cat($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteCat($id)){
			echo "<script> alert('ลบข้อมูลประเภทของครุภัณฑ์เรียบร้อย') </script>";
			redirect('setting_cat','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลประเภทของครุภัณฑ์ได้') </script>";
			redirect('setting_cat','refresh');
		}	
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
	
	public function manage_faculty()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/manage_faculty',
            'menu' => 'manage_faculty',
			'query' => $this->durable_model->get_faculty(),
		);
		$this->load->view('main',$data);
	}

	public function add_faculty()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_faculty',
			'menu' => 'manage_faculty',
			'faculty_id' => "",
			'faculty_name' => "",
			'prom_name' => "เพิ่มข้อมูลคณะ",
			'mode' => "I",
		);
		$this->load->view('main',$data);
	}

	public function edit_faculty($id)
	{
		authen_sysadmin();
		$faculty = $this->durable_model->get_faculty($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_faculty',
            'menu' => 'manage_faculty',
			'faculty_id' => $faculty[0]->faculty_id,
			'faculty_name' => $faculty[0]->faculty_name,
			'prom_name' => "แก้ไขข้อมูลคณะ",
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}
	
	public function delete_faculty($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteFaculty($id)){
			echo "<script> alert('ลบข้อมูลคณะเรียบร้อย') </script>";
			redirect('manage_faculty','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลคณะได้') </script>";
			redirect('manage_faculty','refresh');
		}	
	}

	public function process_faculty()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'faculty_name' => $_POST['faculty_name'],
			);
			$r = $this->durable_model->insertFaculty($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_faculty','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'faculty_name' => $_POST['faculty_name'],
			);
			$r = $this->durable_model->updateFaculty($_POST['faculty_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_faculty','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function manage_major()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if(isset($_POST['btn_search']) AND isset($_POST['search']) AND $_POST['search'] != ""){
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_major',
				'menu' => 'manage_major',
				'query' => $this->durable_model->get_faculty(),
				'major' => $this->durable_model->get_major($_POST['search']),
				'btn_search' => $_POST['btn_search'],
				'search' => $_POST['search'],
			);
		}else{
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_major',
				'menu' => 'manage_major',
				'query' => $this->durable_model->get_faculty(),
			);
		}
		$this->load->view('main',$data);
	}

	public function add_major()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_major',
			'menu' => 'manage_major',
			'major_id' => "",
			'major_name' => "",
			'mode' => "I",
			'prom_name' => "เพิ่มข้อมูลสาขา",
			'query' => $this->durable_model->get_faculty(),
		);
		$this->load->view('main',$data);
	}

	public function edit_major($id)
	{
		authen_sysadmin();
		$major = $this->durable_model->get_major_by_id($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_major',
            'menu' => 'manage_major',
			'major_id' => $major[0]->major_id,
			'faculty_id' => $major[0]->faculty_id,
			'major_name' => $major[0]->major_name,
			'prom_name' => "แก้ไขข้อมูลสาขา",
			'query' => $this->durable_model->get_faculty(),
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}

	public function process_major()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'major_name' => $_POST['major_name'],
				'faculty_id' => $_POST['faculty_id'],
			);
			$r = $this->durable_model->insertMajor($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_major','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'major_name' => $_POST['major_name'],
				'faculty_id' => $_POST['faculty_id'],
			);
			$r = $this->durable_model->updateMajor($_POST['major_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_major','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function delete_major($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteMajor($id)){
			echo "<script> alert('ลบข้อมูลคณะเรียบร้อย') </script>";
			redirect('manage_major','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลคณะได้') </script>";
			redirect('manage_major','refresh');
		}	
	}

	public function manage_course()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if(isset($_POST['btn_search']) AND isset($_POST['search']) AND $_POST['search'] != ""){
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_course',
				'menu' => 'manage_course',
				'query' => $this->durable_model->get_faculty(),
				'major' => $this->durable_model->get_major($_POST['search']),
				'course' => $this->durable_model->get_course($_POST['search_major']),
				'btn_search' => $_POST['btn_search'],
				'search' => $_POST['search'],
				'search_major' => $_POST['search_major'],
			);
		}else{
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_course',
				'menu' => 'manage_course',
				'query' => $this->durable_model->get_faculty(),
			);
		}
		$this->load->view('main',$data);
	}

	public function add_course()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_course',
			'menu' => 'manage_course',
			'course_id' => "",
			'course_name' => "",
			'mode' => "I",
			'prom_name' => "เพิ่มข้อมูลหลักสูตร",
			'query' => $this->durable_model->get_faculty(),
		);
		$this->load->view('main',$data);
	}

	public function edit_course($id)
	{
		authen_sysadmin();
		$major = $this->durable_model->get_course_by_id($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_course',
            'menu' => 'manage_course',
			'major_id' => $major[0]->major_id,
			'faculty_id' => $major[0]->faculty_id,
			'course_name' => $major[0]->course_name,
			'course_id' => $major[0]->course_id,
			'prom_name' => "แก้ไขข้อมูลสาขา",
			'query' => $this->durable_model->get_faculty(),
			'major' => $this->durable_model->get_major($major[0]->faculty_id),
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}

	public function process_course()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'course_name' => $_POST['course_name'],
				'major_id' => $_POST['major_id'],
			);
			$r = $this->durable_model->insertCourse($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_course','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'course_name' => $_POST['course_name'],
				'major_id' => $_POST['major_id'],
			);
			$r = $this->durable_model->updateCourse($_POST['course_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_course','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function delete_course($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteCourse($id)){
			echo "<script> alert('ลบข้อมูลคณะเรียบร้อย') </script>";
			redirect('manage_course','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลคณะได้') </script>";
			redirect('manage_course','refresh');
		}	
	}

	public function manage_campus()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/manage_campus',
            'menu' => 'manage_campus',
			'query' => $this->durable_model->get_campus(),
		);
		$this->load->view('main',$data);
	}

	public function add_campus()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_campus',
			'menu' => 'manage_campus',
			'campus_id' => "",
			'campus_name' => "",
			'prom_name' => "เพิ่มข้อมูลศูนย์การเรียน",
			'mode' => "I",
		);
		$this->load->view('main',$data);
	}

	public function edit_campus($id)
	{
		authen_sysadmin();
		$campus = $this->durable_model->get_campus($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_campus',
            'menu' => 'manage_campus',
			'campus_id' => $campus[0]->campus_id,
			'campus_name' => $campus[0]->campus_name,
			'prom_name' => "แก้ไขข้อมูลศูนย์การเรียน",
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}
	
	public function delete_campus($id)
	{
		authen_sysadmin();
		if($this->durable_model->deletecampus($id)){
			echo "<script> alert('ลบข้อมูลเรียบร้อย') </script>";
			redirect('manage_campus','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลฃได้') </script>";
			redirect('manage_campus','refresh');
		}	
	}

	public function process_campus()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'campus_name' => $_POST['campus_name'],
			);
			$r = $this->durable_model->insertCampus($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_campus','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'campus_name' => $_POST['campus_name'],
			);
			$r = $this->durable_model->updateCampus($_POST['campus_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_campus','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function manage_building()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if(isset($_POST['btn_search']) AND isset($_POST['search']) AND $_POST['search'] != ""){
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_building',
				'menu' => 'manage_building',
				'query' => $this->durable_model->get_campus(),
				'building' => $this->durable_model->get_building($_POST['search']),
				'btn_search' => $_POST['btn_search'],
				'search' => $_POST['search'],
			);
		}else{
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_building',
				'menu' => 'manage_building',
				'query' => $this->durable_model->get_campus(),
			);
		}
		$this->load->view('main',$data);
	}

	public function add_building()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_building',
			'menu' => 'manage_building',
			'building_id' => "",
			'building_name' => "",
			'mode' => "I",
			'prom_name' => "เพิ่มข้อมูลอาคาร",
			'query' => $this->durable_model->get_campus(),
		);
		$this->load->view('main',$data);
	}

	public function edit_building($id)
	{
		authen_sysadmin();
		$building = $this->durable_model->get_building_by_id($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_building',
            'menu' => 'manage_building',
			'building_id' => $building[0]->building_id,
			'campus_id' => $building[0]->campus_id,
			'building_name' => $building[0]->building_name,
			'prom_name' => "แก้ไขข้อมูลอาคาร",
			'query' => $this->durable_model->get_campus(),
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}

	public function process_building()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'building_name' => $_POST['building_name'],
				'campus_id' => $_POST['campus_id'],
			);
			$r = $this->durable_model->insertBuilding($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_building','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'building_name' => $_POST['building_name'],
				'campus_id' => $_POST['campus_id'],
			);
			$r = $this->durable_model->updateBuilding($_POST['building_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_building','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function delete_building($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteBuilding($id)){
			echo "<script> alert('ลบข้อมูลเรียบร้อย') </script>";
			redirect('manage_building','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลได้') </script>";
			redirect('manage_building','refresh');
		}	
	}

	public function manage_room()
	{
		authen_sysadmin();
		$sysname = $this->sysconfig->sysname();
		if(isset($_POST['btn_search']) AND isset($_POST['search']) AND $_POST['search'] != ""){
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_room',
				'menu' => 'manage_room',
				'query' => $this->durable_model->get_campus(),
				'building' => $this->durable_model->get_building($_POST['search']),
				'room' => $this->durable_model->get_room_by_building_id($_POST['search_building']),
				'btn_search' => $_POST['btn_search'],
				'search' => $_POST['search'],
				'search_building' => $_POST['search_building'],
			);
		}else{
			$data = array(
				'sysname' => $sysname[0]->sysvalue,
				'page' => 'backend/manage_room',
				'menu' => 'manage_room',
				'query' => $this->durable_model->get_campus(),
			);
		}
		$this->load->view('main',$data);
	}

	public function add_room()
	{
		authen_sysadmin();
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_room',
			'menu' => 'manage_room',
			'room_id' => "",
			'room_name' => "",
			'mode' => "I",
			'prom_name' => "เพิ่มข้อมูลห้องเรียน",
			'query' => $this->durable_model->get_campus(),
		);
		$this->load->view('main',$data);
	}

	public function edit_room($id)
	{
		authen_sysadmin();
		$room = $this->durable_model->get_room_by_id($id);
        $sysname = $this->sysconfig->sysname();
		$data = array(
			'sysname' => $sysname[0]->sysvalue,
			'page' => 'backend/setting_room',
            'menu' => 'manage_room',
			'room_id' => $room[0]->room_id,
			'campus_id' => $room[0]->campus_id,
			'room_name' => $room[0]->room_name,
			'building_id' => $room[0]->building_id,
			'prom_name' => "แก้ไขข้อมูลห้องเรียน",
			'query' => $this->durable_model->get_campus(),
			'building' => $this->durable_model->get_building($room[0]->campus_id),
			'mode' => "U",
		);
		$this->load->view('main',$data);
	}

	public function process_room()
	{
		authen_sysadmin();
		if($_POST['mode'] == 'I')
		{
			$data = array(
				'room_name' => $_POST['room_name'],
				'building_id' => $_POST['building_id'],
			);
			$r = $this->durable_model->insertRoom($data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_room','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}
		}elseif($_POST['mode'] == 'U'){
			$data = array(
				'room_name' => $_POST['room_name'],
				'building_id' => $_POST['building_id'],
			);
			$r = $this->durable_model->updateRoom($_POST['room_id'],$data);
			if($r){
				echo "<script> alert('ทำรายการเรียบร้อย') </script>";
				redirect('manage_room','refresh');
			}else{
				echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
				echo "<script> window.history.go(-1); </script>";
			}

		}else{
			echo "<script> alert('ไม่สามารถทำรายการได้') </script>";
			echo "<script> window.history.go(-1); </script>";
		}
		
	}

	public function delete_room($id)
	{
		authen_sysadmin();
		if($this->durable_model->deleteRoom($id)){
			echo "<script> alert('ลบข้อมูลเรียบร้อย') </script>";
			redirect('manage_room','refresh');
		}else{
			echo "<script> alert('ไม่สามารถลบข้อมูลได้') </script>";
			redirect('manage_room','refresh');
		}	
	}

}