
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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

<div class="container text-center" style="margin-top:100px">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>	
	<div class="row">
		<div class="col-md-3"></div>
		<?php foreach($query as $r){ ?>
		<div class="col-md-6">
		  <div class="panel panel-default">
		    <div class="panel-heading text-left">
			    <div class="row">
			    	<div class="col-md-12">
			    		<p><b>ชื่อครุภัณฑ์ :</b> <?php echo $r->durable_name; ?></p>
			    		<p><b>รหัสครุภัณฑ์ :</b> <?php echo $r->durable_code; ?></p>
			    	</div>
			    </div>
			</div>
			<div class="panel-body text-left">
				<form action="<?php echo site_url('durable_detail/process_report/'); ?>" method="post">
					<div class="row">
				    	<div class="col-md-12">
				    		  <div class="form-group">
    								<label for="reporter_id">หัวข้อปัญหา</label>
    								<input required type="text" class="form-control" name="report_topic" id="report_topic" placeholder="โปรดกรอกรหัสนักศึกษา">
  							  </div>
				    	</div>
				    </div>
					<div class="row">
				    	<div class="col-md-12">
				    		  <div class="form-group">
				    		  		<input type="hidden" class="form-control" name="durable_id" value="<?php echo $r->durable_id; ?>">
    								<label for="report_detail">รายละเอียดปัญหา</label>
    								<textarea type="text" class="form-control" name="report_detail" id="report_detail" placeholder="โปรดกรอกรายละเอียด"></textarea>
  							  </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
				    		  <div class="form-group">
    								<label for="reporter_id">รหัสนักศึกษา</label>
    								<input type="text" class="form-control" name="reporter_id" id="reporter_id" placeholder="โปรดกรอกรหัสนักศึกษา">
  							  </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
				    		  <div class="form-group">
    								<label for="reporter_name">ชื่อ </label>
    								<input required type="text" class="form-control" name="reporter_name" id="reporter_name" placeholder="โปรดกรอกชื่อ">
  							  </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
				    		  <div class="form-group">
    								<label for="reporter_surname">นามสกุล</label>
    								<input required type="text" class="form-control" name="reporter_surname" id="reporter_surname" placeholder="โปรดกรอกนามสกุล">
  							  </div>
				    	</div>
				    </div>
				
			</div>
			<div class="panel-footer text-center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 col-xs-12">
						<div class="g-recaptcha" data-callback="makeaction" data-sitekey="6Lda_3kUAAAAAKahhF8FYVByhPDcBLxpVinajVTR"></div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 col-xs-12">
						<button disabled id="btn_submit" type="submit" class="btn btn-success">ยืนยันการแจ้งปัญหา</button>
					</div>
					<div class="col-md-3"></div>
				</div>
				</form>
		  </div>
		</div>
	<?php } ?>
		<div class="col-md-3"></div>
	</div>
</div>
<script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
<script>
function makeaction(){
      document.getElementById('btn_submit').disabled = false;  
}
</script>
</body>
</html>
