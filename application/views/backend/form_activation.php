<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> <?php echo $sysname; ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="<?= CSS ?>/vendor.css">
        <!-- Theme initialization -->
        <link rel="stylesheet" id="theme-style" href="<?= CSS ?>/app-green.css">
        <link rel="stylesheet" id="theme-style" href="<?= CSS ?>/app.css">
        <script src="<?= JS ?>/jquery.js"></script>
    </head>
    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                    <h1 class="auth-title">
                            <!-- <div class="logo">
                                <span class="l l1"></span>
                                <span class="l l2"></span>
                                <span class="l l3"></span>
                                <span class="l l4"></span>
                                <span class="l l5"></span>
                            </div>--> <?php echo $sysname; ?> </h1> 
                    </header>
                    <div class="auth-content">
                        <p class="text-center">ยืนยันเปิดบัญชีของท่าน</p>
                        <p class="text-muted text-center">
                            <small>กรุณากรอกรหัสผ่านเพื่อเปิดบัญชี</small>
                        </p>
                        <form id="reset-form" action="<?= site_url('process_activation'); ?>" method="POST" novalidate="">
                        <input type="hidden" value="<?= $user_email; ?>" name="email" id="email">
                        <input type="hidden" value="<?= $user_token; ?>" name="token" id="token">
                            <div class="form-group">
                                <label for="password1">รหัสผ่าน</label>
                                <input type="password" class="form-control underlined" name="password1" id="u_pass" placeholder="โปรดกรอกรหัสผ่าน" required> 
                            </div>
                            <div class="form-group">
                                <label for="password1">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control underlined" name="password2" id="u_pass2" placeholder="โปรดกรอกรหัสผ่านอีกครั้ง" required> 
                            </div>
                            <font color="red">
                                        
										<div class="registrationFormAlert" id="divCheckPasswordMatch">
										
										</div>
							</font>
                            <div class="form-group">
                                <button id="btn-submit" type="submit" class="btn btn-block btn-primary">Activate</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="<?= JS ?>/vendor.js"></script>
        <script src="<?= JS ?>/app.js"></script>
        <script type="text/javascript">
 $(document).ready(function () {
   $("#u_pass, #u_pass2").keyup(checkPasswordMatch);
});
 function checkPasswordMatch() {
    var password = $("#u_pass").val();
    var confirmPassword = $("#u_pass2").val();
    var $result = $("#divCheckPasswordMatch");
		$result.text("");
    if (password != confirmPassword){
        //$("#divCheckPasswordMatch").html("<p>***รหัสผ่านทั้งสองไม่ตรงกัน</p>");
		$result.text("***รหัสผ่านทั้งสองไม่ตรงกัน");
        $result.css("color", "red");	
        $("#btn-submit").prop('disabled', true);
	}else{
        $("#divCheckPasswordMatch").html("***รหัสผ่านทั้งสองตรงกัน");
		$result.text("***รหัสผ่านทั้งสองตรงกัน");
        $result.css("color", "green");	
        $("#btn-submit").prop('disabled', false);
	}	
}
 </script>
    </body>
</html>