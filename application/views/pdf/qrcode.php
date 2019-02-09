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
<div class=\"container\">
	<br>
	<div class=\"row\">
	<table border=\"1\">
	<tr>
		<td align=\"center\">
		<br>
		<font style=\"font-family: garuda; font-size: 30px\">".$query[0]->durable_name."</font>
		</td>
	</tr>
	<tr>
		<td align=\"center\">
		<p style=\"font-family: garuda\">".$query[0]->durable_code."</p>
		</td>
	</tr>
	<tr>
	<td align=\"center\">
	<img width=\"35%\" src=".base_url('uploads/qr_image/'.$img_url)." alt=\"QRCode Image\">
	</td>
</tr>
</table>
	</div>
</div>


</body>
</html>
";


$mpdf->WriteHTML($content);
$mpdf->Output();

delete_files('uploads/qr_image', TRUE);
?>