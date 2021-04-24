<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->model('Login_model');
        $this->load->model('durable_model');
        $this->load->model('report_model');
        $this->load->model('user_model');
        $this->load->model('sysconfig');
        $this->load->helper('authen');
        
    }

    public function index()
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/dashboard',
            'menu' => 'dashboard',
        );
        $this->load->view('main', $data);
    }

    public function manage_durable()
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->durable_model->get_durable();
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/manage_durable',
            'menu' => 'manage_durable',
            'durable' => $query,
        );
        $this->load->view('main', $data);
    }

    public function manage_depreciation()
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->durable_model->get_durable();
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/manage_depreciation',
            'menu' => 'manage_depreciation',
            'query' => $query,
        );
        $this->load->view('main', $data);
    }

    public function durable_detail($id)
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->durable_model->get_durable_id($id);
        $query2 = $this->report_model->get_report_by_durable_id($id);
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/durable_detail',
            'menu' => 'manage_durable',
            'durable' => $query,
            'report' => $query2,
        );
        print_r($query);
        // $this->load->view('main',$data);
    }

    public function report_detail($id)
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->report_model->get_problem_detail($id);
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/report_detail',
            'menu' => 'report_detail',
            'query' => $query,
        );
        $this->load->view('main', $data);
    }

    public function problem_detail($id)
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->report_model->get_problem_detail($id);
        $query2 = $this->report_model->get_problem_status_detail($id);
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/problem_detail',
            'menu' => 'manage_report',
            'query' => $query,
            'query2' => $query2,
        );
        $this->load->view('main', $data);
    }

    public function process_problem_status()
    {
        authen_sys();
        $problem_id = $this->input->post('problem_id');
        $status_id = $this->input->post('problem_status_id');
        $data = array(
            'problem_status_id' => $status_id,
        );
        $query = $this->report_model->update_problem_status_detail($problem_id, $data);
        if ($query) {
            echo "<script> alert('แก้ไข้ข้อมูลเรียบร้อยแล้ว'); </script>";

        }
        redirect("problem_detail/" . $problem_id, "refresh");

    }

    public function depreciation_detail($id)
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->durable_model->get_depreciation_detail($id);
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/depreciation_detail',
            'menu' => 'depreciation_detail',
            'query' => $query,
        );
        $this->load->view('main', $data);
    }

    public function manage_report()
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->report_model->get_report_join();
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/manage_report',
            'menu' => 'manage_report',
            'query' => $query,
        );
        $this->load->view('main', $data);
    }

    public function profile_detail($id)
    {
        authen_sys();
        if ($id == $_SESSION['uid'] or isset($_SESSION['login_true_superadmin'])) {
            $sysname = $this->sysconfig->sysname();
            $query = $this->user_model->get_user_detail($id);
            $changedate = explode("-", substr($query[0]->register_date, 0, 10));
            $data = array(
                'sysname' => $sysname[0]->sysvalue,
                'page' => 'backend/profile_detail',
                'menu' => 'profile_detail',
                'query' => $query,
                'changedate' => $changedate,
            );
            $this->load->view('main', $data);
        } else {
            echo "<script> alert('ไม่สามารถใช้งานหน้านี้ได้'); </script>";
            redirect("", "refresh");
        }

    }

    public function form_durable($id = null)
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        if ($id != null) {
            $prom_form = "แก้ไขข้อมูลครุภัณฑ์";
            $o_id = $id;

            $result = $this->durable_model->get_durable_join_by_id($o_id);
            // print_r($result);
            $query_cat = $this->durable_model->get_cat();
            $query_room = $this->durable_model->get_room();
            $query_durable_status = $this->durable_model->get_durable_status();
            $query_faculties = $this->durable_model->get_faculties();
            $query_majors = $this->durable_model->get_majors($result[0]->faculty_id);
            $query_course = $this->durable_model->get_course($result[0]->major_id);

            $data = array(
                'sysname' => $sysname[0]->sysvalue,
                'page' => 'backend/form_durable',
                'menu' => 'edit_durable',
                'prom_form' => $prom_form,
                'mode' => 'U',
                'durable_id' => $result[0]->durable_id,
                'durable_code' => $result[0]->durable_code,
                'durable_name' => $result[0]->durable_name,
                'use_date' => $result[0]->use_date,
                'cat_id' => $result[0]->cat_id,
                'picture_path' => $result[0]->picture_path,
                'img_path_img' => base_url('resources/durable/'),
                'user_id' => $result[0]->user_id,
                'price' => $result[0]->price,
                'scrap_value' => $result[0]->scrap_value,
                'durable_age' => $result[0]->durable_age,
                'room_id' => $result[0]->room_id,
                'durable_status_id' => $result[0]->durable_status_id,
                'description' => $result[0]->description,
                'can_borrow' => $result[0]->can_borrow,
                'major_id' => $result[0]->major_id,
                'course_id' => $result[0]->course_id,
                'query_faculties' => $query_faculties,
                'query_majors' => $query_majors,
                'query_course' => $query_course,
                'query_cat' => $query_cat,
                'query_user' => $_SESSION['uid'],
                'query_room' => $query_room,
                'query_durable_status' => $query_durable_status,
                'result' => $result,
            );
            $this->load->view('main', $data);
        } else {
            $query_cat = $this->durable_model->get_cat();
            $query_room = $this->durable_model->get_room();
            $query_faculties = $this->durable_model->get_faculties();
            $query_durable_status = $this->durable_model->get_durable_status();

            $prom_form = "ลงทะเบียนครุภัณฑ์";
            $data = array(
                'sysname' => $sysname[0]->sysvalue,
                'page' => 'backend/form_durable',
                'menu' => 'insert_durable',
                'prom_form' => $prom_form,
                'mode' => 'I',
                'durable_code' => "",
                'durable_name' => "",
                'use_date' => "",
                'cat_id' => "",
                'picture_path' => "noimg.jpg",
                'img_path_img' => base_url('resources/durable/'),
                'user_id' => "",
                'price' => "",
                'scrap_value' => "",
                'durable_age' => "",
                'room_id' => "",
                'durable_status_id' => "",
                'description' => "",
                'durable_id' => "",
                'can_borrow' => "",
                'query_cat' => $query_cat,
                'query_user' => $_SESSION['uid'],
                'query_room' => $query_room,
                'query_faculties' => $query_faculties,
                'query_durable_status' => $query_durable_status,

            );
            $this->load->view('main', $data);
        }
    }

    public function save_durable()
    {
        $file_name = 'durable_';
        $file_name .= date("Ymd_His");
        $file_name .= '.jpg';

        if ($_FILES['com_img']) {
            $config['file_name'] = $file_name;
            $config['upload_path'] = '.\resources\durable';
            $config['allowed_types'] = 'jpg|jpeg|png|PNG|JPG|JPEG';
            $config['max_size'] = 6000;
            $config['encrypt_name'] = false;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('com_img')) {
                $error = array('error' => $this->upload->display_errors());
                $picture_path = $_POST['picture_path'];
                // echo "<script> alert('".$error['error']."'); </script>";
                // echo '<script> window.history.go(-1); </script>';
            } else {
                $data_pic = array('upload_data' => $this->upload->data());
                $picture_path = $data_pic['upload_data']['file_name'];
            }
        } else {
            $picture_path = $_POST['picture_path'];
        }

        if ($_POST['course_id'] == '0') {
            $course_id = null;
        } else {
            $course_id = $_POST['course_id'];
        }

        if ($_POST['durable_age'] != "") {
            $durable_age[0]->durable_age = $_POST['durable_age'];
        } else {
            $durable_age = $this->durable_model->find_durable_age($_POST['cat_id']);
        }

        // print_r($durable_age);

        if ($_POST['mode'] == 'I') {
            $this->form_validation->set_rules('durable_code', 'Durable Code', 'required|is_unique[durable_article.durable_code]');
            if ($this->form_validation->run() == true) {

                $data = array(
                    'durable_code' => $_POST['durable_code'],
                    'durable_name' => $_POST['durable_name'],
                    'use_date' => $_POST['use_date'],
                    'cat_id' => $_POST['cat_id'],
                    'picture_path' => $picture_path,
                    'user_id' => $_POST['user_id'],
                    'price' => $_POST['price'],
                    'durable_status_id' => $_POST['durable_status_id'],
                    'room_id' => $_POST['room_id'],
                    'description' => $_POST['description'],
                    'durable_age' => $durable_age[0]->durable_age,
                    'scrap_value' => $_POST['scrap_value'],
                    'can_borrow' => $_POST['can_borrow'],
                    'course_id' => $course_id,
                    'major_id' => $_POST['major_id'],
                    'borrow_status' => '2',
                    'add_date' => date("Y-m-d")
                );
                $result = $this->durable_model->insert_durable($data);
                if ($result) {
                    echo '<script> alert(\'เพิ่มข้อมูลครุภัณฑ์เรียบร้อย\'); </script>';
                    redirect('manage_durable', 'refresh');
                } else {
                    echo '<script> alert(\'ไม่สามารถเพิ่มข้อมูลครุภัณฑ์ได้\'); </script>';
                    echo '<script> window.history.go(-1); </script>';
                }

            } else {
                echo '<script> alert(\'เลขครุภัณฑ์มีซ้ำอยู่บนระบบแล้ว\'); </script>';
                echo '<script> window.history.go(-1); </script>';
            }

        } else if ($_POST['mode'] == 'U') {
            $data = array(
                'durable_code' => $_POST['durable_code'],
                'durable_name' => $_POST['durable_name'],
                'use_date' => $_POST['use_date'],
                'cat_id' => $_POST['cat_id'],
                'picture_path' => $picture_path,
                'user_id' => $_POST['user_id'],
                'price' => $_POST['price'],
                'durable_status_id' => $_POST['durable_status_id'],
                'room_id' => $_POST['room_id'],
                'description' => $_POST['description'],
                'durable_age' => $durable_age[0]->durable_age,
                'scrap_value' => $_POST['scrap_value'],
                'can_borrow' => $_POST['can_borrow'],
                'course_id' => $course_id,
                'major_id' => $_POST['major_id'],
            );
            $result = $this->durable_model->update_durable($_POST['durable_id'], $data);
            if ($result) {
                echo '<script> alert(\'แก้ไขข้อมูลครุภัณฑ์เรียบร้อย\'); </script>';
                redirect('durable_detail/' . $_POST['durable_id'], 'refresh');
            } else {
                echo '<script> alert(\'ไม่สามารถแก้ไขข้อมูลครุภัณฑ์ได้\'); </script>';
                echo '<script> window.history.go(-1); </script>';
            }
        }
    }

    public function delete_durable($id)
    {
        if ($this->durable_model->delete_durable($id)) {
            echo '<script> alert(\'ลบข้อมูลครุภัณฑ์เรียบร้อย\'); </script>';
        } else {
            echo '<script> alert(\'ไม่สามารถลบข้อมูลครุภัณฑ์ได้\'); </script>';

        }
        redirect('manage_durable', 'refresh');
    }

    public function form_qr_by_room()
    {
        authen_sys();
        $sysname = $this->sysconfig->sysname();
        $query = $this->durable_model->getCampus();
        $data = array(
            'sysname' => $sysname[0]->sysvalue,
            'page' => 'backend/form_qr_by_room',
            'menu' => 'form_qr_by_room',
            'campus' => $query,
        );
        $this->load->view('main', $data);
    }

}
