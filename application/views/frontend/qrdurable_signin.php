<?php 
include_once('core/conn.php');
include_once('core/utility.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo sysname(); ?> </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="jquery/jquery.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php

if(isset($_GET['sign_id'])){
		$sign_id = $_GET['sign_id'];
		$conn = connect();
	$sql = "INSERT INTO usage_log (durable_id)
			VALUES ('".mysqli_real_escape_string($conn,$sign_id)."');";
	
	if ($result = mysqli_query($conn,$sql)){ 
		msgbox('ลงชื่อใช้งานแล้ว ขอบคุณค่ะ');
		echo "<center> ลงชื่อใช้งานแล้ว ขอบคุณค่ะ </center>";
	}

}else{
	msgbox("กรุณาสแกน QR Code ก่อนลงชื่อใช้งาน ครับ/ค่ะ");
}
?>
</body>
</html>