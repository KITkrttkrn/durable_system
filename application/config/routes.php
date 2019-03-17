<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'backend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Durable_detail Controller
$route['success'] = "durable_detail/success";
$route['qrdurable_detail/(:num)'] = "durable_detail/index/$1";
$route['sign/(:num)'] = "durable_detail/sign/$1";
$route['problem/(:num)'] = "durable_detail/report_view/$1";

//Auth Controller
$route['logout'] = 'auth/logout';
$route['login'] = 'auth/login';

//Backend Controller
$route['dashboard'] = 'backend/index';
$route['manage_durable'] = 'backend/manage_durable';
$route['durable_detail/(:num)'] = 'backend/durable_detail/$1';

$route['manage_depreciation'] = 'backend/manage_depreciation';
$route['depreciation_detail/(:num)'] = 'backend/depreciation_detail/$1';

$route['process_problem_status'] = 'backend/process_problem_status';
$route['report_detail/(:num)'] = 'backend/report_detail/$1';
$route['problem_detail/(:num)'] = 'backend/problem_detail/$1';
$route['manage_report'] = 'backend/manage_report';

$route['profile_detail/(:num)'] = 'backend/profile_detail/$1';

$route['insert_durable'] = 'backend/form_durable';
$route['edit_durable/(:num)'] = 'backend/form_durable/$1';
$route['save_durable'] = 'backend/save_durable';
$route['form_qr_by_room'] = 'backend/form_qr_by_room';


//User Controller
$route['manage_users'] = 'user/manage_users';
$route['insert_user'] = 'user/form_user';
$route['edit_profile/(:num)'] = 'user/form_user/$1';
$route['save_user'] = 'user/save_user';
$route['activation'] = 'user/activation';
$route['process_activation'] = 'user/process_activation';
$route['user_detail/(:num)'] = 'user/user_detail/$1';
$route['process_user_detail'] = 'user/process_user_detail';

//Ajax Controller
$route['get_major_id'] = 'ajax/get_major_id';
$route['get_building_id'] = 'ajax/get_building_id';
$route['get_room_id'] = 'ajax/get_room_id';

//Borrow Controller
$route['borrow_durable'] = 'borrow/index';
$route['borrowing'] = 'borrow/borrowing';
$route['process_borrow'] = 'borrow/process_borrow';
$route['return'] = 'borrow/return';
$route['process_return'] = 'borrow/process_return';

//Pdf Controller
$route['report/(:num)'] = 'pdf/report/$1';
$route['qrcode/(:num)'] = 'pdf/qrcode/$1';
$route['qrcode_by_room'] = 'pdf/qrcode_by_room';

//Admin Controller
$route['setting_name'] = 'admin/setting_name';
$route['setting_line'] = 'admin/setting_line';
$route['setting_mail'] = 'admin/setting_mail';
$route['manage_cat'] = 'admin/manage_cat';

$route['process_setting'] = 'admin/process_setting';

$route['add_cat'] = 'admin/add_cat/';
$route['edit_cat/(:num)'] = 'admin/edit_cat/$1';
$route['process_cat'] = 'admin/process_cat';
$route['delete_cat/(:num)'] = 'admin/delete_cat/$1';