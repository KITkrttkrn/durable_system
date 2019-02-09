<?php
require_once 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
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
    <link rel=\"stylesheet\" href=\"".CSS3."/bootstrap.min.css\">
</head>
<body>
<h3 style=\"font-family: garuda\" align=\"center\">รายงานแจ้งปัญหาครุภัณฑ์</h3>
<div class=\"container\">
<br>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>วันที่แจ้งปัญหา: </b>".$query[0]->report_datetime."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>เลขครุภัณฑ์: </b>".$query[0]->durable_code."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>ชื่อครุภัณฑ์: </b>".$query[0]->durable_name."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>หัวข้อปัญหา: </b>".$query[0]->problem_topic."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>รายละเอียดปัญหา: </b>".$query[0]->problem_detail."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>สถานะของปัญหา: </b>".$query[0]->problem_status_name."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>รายงานโดย: </b>".$query[0]->reporter_name." ".$query[0]->reporter_surname."</p>
</div>
<div class=\"row\">
<p style=\"font-family: garuda\"><b>รหัสนักศึกษา: </b>".$query[0]->reporter_id."</p>
</div>
</div>


</body>
</html>
";


$mpdf->WriteHTML($content);
$mpdf->Output();