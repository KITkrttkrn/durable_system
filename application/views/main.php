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
        <script src="<?= JS ?>/vendor.js"></script>

        <link rel="stylesheet" id="theme-style" href="<?= CSS ?>/jquery.datatables.min.css">
        <script type="text/javascript" charset="utf8" src="<?= JS ?>/jquery.datatables.min.js"></script>
        <!-- <script type="text/javascript" charset="utf8" src="<?= JS ?>/dataTables.bootstrap.js"></script> -->
        <!-- <link rel="stylesheet" id="theme-style" href="<?= CSS ?>/dataTables.bootstrap.min.css"> -->
        
        <style type="text/css">
            div.img-resize img {
                height: 300px;
                width: auto;
            }

            div.img-resize {
                width: 300px;
                height: 300px;
                overflow: hidden;
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div class="main-wrapper">
            <div class="app" id="app">
            <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="name"> <?php echo $_SESSION['login_true']; ?> </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="<?php echo site_url('profile_detail/'.$_SESSION['uid']); ?>">
                                        <i class="fa fa-user icon"></i> โปรไฟล์ </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= site_url('logout'); ?>">
                                        <i class="fa fa-power-off icon"></i> ออกจากระบบ </a>
                                </div>
                            </li>
                        </ul>
                    </div>
    </header>
    <aside class="sidebar sidebar-fixed header-fixed">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div> <?php echo "D.A.M System"; ?> </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li <?php if($menu == 'dashboard'){ echo "class=\"active\""; } ?>>
                                    <a href="<?= site_url('dashboard'); ?>">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li <?php if($menu == 'insert_durable' OR $menu == 'manage_durable' OR $menu == 'manage_depreciation' OR $menu == 'form_qr_by_room'){ echo "class=\"active\""; } ?>>
                                    <a href="">
                                        <!-- <i class="fa fa-th-large"></i> --> ครุภัณฑ์
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'insert_durable'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('insert_durable');?>"> ลงทะเบียนข้อมูลครุภัณฑ์ </a>
                                        </li>
                                        <li <?php if($menu == 'manage_durable'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('manage_durable');?>"> รายการข้อมูลครุภัณฑ์ </a>
                                        </li>
                                        <li <?php if($menu == 'manage_depreciation'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('manage_depreciation');?>"> รายการคำนวณค่าเสื่อมราคา </a>
                                        </li>
                                        <li <?php if($menu == 'form_qr_by_room'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('form_qr_by_room');?>"> พิมพ์ QrCode ด้วยเลขห้อง </a>
                                        </li>
                                    </ul>
                                </li>
                                <li <?php if($menu == 'manage_report'){ echo "class=\"active\""; } ?>>
                                    <a href="">
                                        <!-- <i class="fa fa-area-chart"> --></i> รายงานปัญหาครุภัณฑ์
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'manage_report'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('manage_report'); ?>"> รายการการแจ้งปัญหา </a>
                                        </li>
                                    </ul>
                                </li>

                                <li <?php if($menu == 'borrow_durable'){ echo "class=\"active\""; } ?>>
                                    <a href="">
                                        <!-- <i class="fa fa-area-chart"> --></i> ระบบเช่ายืม
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'borrow_durable'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('borrow_durable'); ?>"> เช่ายืมครุภัณฑ์ </a>
                                        </li>
                                    </ul>
                                </li>

                                <?php if(isset($_SESSION['login_true_sysadmin'])){ ?>
                                <li <?php if($menu == 'form_users' OR $menu == 'manage_users'){ echo "class=\"active\""; } ?>>
                                    <a href="">
                                        <!-- <i class="fa fa-area-chart"> --></i> ผู้ใช้งาน
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'form_users'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('insert_user'); ?>"> เพิ่มผู้ใช้งาน </a>
                                        </li>
                                        <li <?php if($menu == 'manage_users'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('manage_users'); ?>"> จัดการผู้ใช้งาน </a>
                                        </li>
                                    </ul>
                                </li>

                                <li <?php if($menu == 'setting_name' OR $menu == 'setting_line' OR $menu == 'setting_mail' OR $menu == 'manage_cat'){ echo "class=\"active\""; } ?>>
                                    <a href="">
                                        <!-- <i class="fa fa-area-chart"> --></i> ตั้งค่า
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'setting_name'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('setting_name'); ?>"> ตั้งค่า ชื่อระบบ </a>
                                        </li>
                                    </ul>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'setting_line'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('setting_line'); ?>"> ตั้งค่า Line Notify </a>
                                        </li>
                                    </ul>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'setting_mail'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('setting_mail'); ?>"> ตั้งค่า Mail Server </a>
                                        </li>
                                    </ul>
                                    <ul class="sidebar-nav">
                                        <li <?php if($menu == 'manage_cat'){ echo "class=\"active\""; } ?>>
                                            <a href="<?= site_url('manage_cat'); ?>"> ตั้งค่า ประเภทของครุภัณฑ์</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                    </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>



            <?php 
            if(isset($page)){
                $this->load->view($page);
            }else{
                echo "Error 404";
            }
            ?>


    <!-- <footer class="footer">
                    <div class="footer-block buttons">

                    </div>
                    <div class="footer-block author">
                        <ul>
                            <li> created by
                                <a href="https://github.com/modularcode">ModularCode</a>
                            </li>
                            <li>
                                <a href="https://github.com/modularcode/modular-admin-html#get-in-touch">get in touch</a>
                            </li>
                        </ul>
                    </div>
    </footer> -->

        </div>
    </div>
    <script src="<?= JS ?>/app.js"></script>
    <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
    </body>
</html>