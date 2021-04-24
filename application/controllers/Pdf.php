<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class pdf extends CI_Controller
{
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

		// require_once 'vendor/autoload.php';
	}

	function report($id)
	{
		authen_sys();
		$page = 'pdf/report';
		$data['query'] = $this->report_model->get_problem_detail($id);
		$this->load->view($page, $data);
	}

	function qrcode($id)
	{
		authen_sys();
		if ($id != NULL) {

			$qr_image = rand() . '.png';
			$params['data'] = site_url('durableqr/' . $id);
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH . "uploads/qr_image/" . $qr_image;
			if ($this->ciqrcode->generate($params)) {
				$img_url = $qr_image;
				$query = $this->report_model->get_durable_detail($id);
			}

			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];

			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];
			$mpdf = new \Mpdf\Mpdf([
				'fontDir' => array_merge($fontDirs, [
					__DIR__ . '/../../fonts',
					'mode' => 'utf-8',
					'format' => 'A4'
				]),
				'fontdata' => $fontData + [
					'thsarabun' => [
						'R' => 'THSarabunNew.ttf',
						//'I' => 'THSarabunNew Italic.ttf',
						//'B' => 'THSarabunNew Bold.ttf',
					]
				],
				'default_font' => 'thsarabun'
			]);



			$content = "
			<!DOCTYPE html>
			<html>
			<head>
				<title>รายงานครุภัณฑ์หมายเลข </title>
				<meta charset=\"utf-8\">
				<link rel=\"stylesheet\" href=\"" . CSS3 . "/bootstrap.min.css\">
			</head>
			<body>
			<div class=\"container\">
				<br>
				<div class=\"row\">
				<table border=\"1\">
				<tr>";
			$content .= "<td align=\"center\">
					<br>
					<p><font style=\"font-family: garuda; font-size: 25px\"> " . $query[0]->durable_name . " </font></p>
					<p style=\"font-family: garuda\">" . $query[0]->durable_code . "</p>
					<br><img width=\"30%\" src=" . base_url('uploads/qr_image/' . $qr_image) . " alt=\"QRCode Image\">
					</td>";
			$content .= "</tr> 
			</table>
				</div>
			</div>


			</body>
			</html>
			";


			$mpdf->WriteHTML($content);
			$mpdf->Output();

			delete_files('uploads/qr_image', TRUE);
		}
	}

	function qrcode_by_room()
	{
		authen_sys();
		if (isset($_GET['room']) and $_GET['room'] != "") {
			$id = $_GET['room'];
			$query = $this->report_model->get_durable_detail_by_room($id);

			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];
			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];

			$mpdf = new \Mpdf\Mpdf([
				'fontDir' => array_merge($fontDirs, [
					__DIR__ . '/../../fonts',
					'mode' => 'utf-8',
					'format' => 'A4'
				]),
				'fontdata' => $fontData + [
					'thsarabun' => [
						'R' => 'THSarabunNew.ttf',
						//'I' => 'THSarabunNew Italic.ttf',
						//'B' => 'THSarabunNew Bold.ttf',
					]
				],
				'default_font' => 'thsarabun'
			]);

			$content = "
		<!DOCTYPE html>
		<html>
		<head>
			<title>Qrcode ครุภัณฑ์ห้อง " . $id . " </title>
			<meta charset=\"utf-8\">
			<link rel=\"stylesheet\" href=\"" . CSS3 . "/bootstrap.min.css\">
			<style type=\"text/css\">
            table tr {

				white-space:nowrap;
				
			}

			table{
				display:inline-block

			.solid {border-style: solid;}
			}
        </style>
		</head>
		<body>
		<div class=\"container\">
			<br>
			<div class=\"row\"><table border=\"1\"><tr>";
			$i = 0;
			foreach ($query as $r) {
				if ($i % 3 == 0) {
					$content .= "<tr>";
				}
				$qr_image = $r->durable_id . '.png';
				$params['data'] = site_url('durableqr/' . $r->durable_id);
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = FCPATH . "uploads/qr_image/" . $qr_image;
				if ($this->ciqrcode->generate($params)) {

					$content .= "<td align=\"center\">
					<br>
					<p><font style=\"font-family: garuda; font-size: 25px\"> " . $r->durable_name . " </font></p>
					<p style=\"font-family: garuda\">" . $r->durable_code . "</p>
					<br><img width=\"30%\" src=" . base_url('uploads/qr_image/' . $qr_image) . " alt=\"QRCode Image\">
					</td>";
				}
				if ($i % 3 == 0) {
					$content .= "</tr><br>";
				}
				$i++;
			}
			$content .= "</table><br><br></div>
		</div>
		</body>
		</html>
		";


			$mpdf->WriteHTML($content);
			$mpdf->Output();

			delete_files('uploads/qr_image', TRUE);
		} else {
			echo "<script> alert('ไม่สามารถใช้งานหน้านี้ได้'); window.history.go(-1);</script>";
		}
	}
}
