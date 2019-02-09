<!DOCTYPE html>
<html>
<head>
    <title> <?php echo $sysname; ?> </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=CSS3;?>/bootstrap.min.css">
  <script src="<?=JS3;?>/jquery.js"></script>
  <script src="<?=JS3;?>/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"> <?php echo $sysname; ?> </a>
    </div>
  </div>
</nav>
 <?php foreach ($query as $r) { ?>
<div class="container text-center" style="margin-top:50px">
	<div class="row">
		<div class="col-md-12">
			<h2><?php echo $r->durable_code." - ".$r->durable_name;?></h2>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
		  <div class="panel panel-default">
		    <div class="panel-heading">
		    		<img width="80%" src="<?php echo RES_DURABLE."/".$r->picture_path;?>">
		    </div>
		    <div class="panel-body text-left">
			    <div class="row">
			    	<div class="col-md-12">
			    		<p><b>ชื่อ :</b> <?php echo $r->durable_name; ?></p>
			    		<p><b>รหัสครุภัณฑ์ :</b> <?php echo $r->durable_code; ?></p>
			    		<p><b>ประเภทของครุภัณฑ์ :</b> <?php echo $r->cat_name; ?></p>
			    		<p><b>สถานะครุภัณฑ์ :</b> <?php echo $r->durable_status_name; ?></p>
			    		<p><b>ตำแหน่ง :</b> <?php echo $r->room_name; ?></p>
			    		<p><b>รายละเอียดเพิ่มเติม :</b> <?php echo $r->description; ?></p>
			    	</div>
			    </div>
			</div>
			<div class="panel-footer text-center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-3 col-xs-6">
						<a href="<?php echo site_url('sign/').$r->durable_id; ?>" class="btn btn-success">ลงชื่อใช้งาน</a>
					</div>
					<div class="col-md-3 col-xs-6">
						<a href="<?php echo site_url('report/').$r->durable_id; ?>" class="btn btn-danger">แจ้งปัญหา</a>
					</div>
					<div class="col-md-3"></div>
 <?php } ?>
			</div>
		  </div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

</body>
</html>
