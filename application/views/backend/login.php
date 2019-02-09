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
            <?php
if($this->session->flashdata('error') != ''){
    $message = $this->session->flashdata('error');
    echo "<script> alert('".$message."'); </script>";
}
?>
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
                        <p class="text-center">ลงชื่อเข้าใช้งานระบบ</p>
                        <form id="login-form" action="<?= site_url('auth/login'); ?>" method="POST">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control underlined" name="username" id="email" placeholder="โปรดกรอกที่อยู่ E-mail ของคุณ" required> </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="โปรดกรอก Password ของคุณ" required> </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="<?= JS ?>/vendor.js"></script>
        <script src="<?= JS ?>/app.js"></script>
    </body>
</html>