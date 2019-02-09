<?php

//Check Authen sys
function authen_sys()
{
    #### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
    if (!isset($_SESSION['login_true_sys']) && !isset($_SESSION['login_true_sysadmin'])) {
        echo "<script> alert('กรุณาลงชื่อเข้าใช้งานระบบก่อน ครับ/ค่ะ'); </script>";
        redirect('/login','refresh');
        //redirect("javascript: window.history.go(-1)" );
    }
    ### จบการเช็ค ###
}

function authen_sysadmin()
{
    #### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
    if (!isset($_SESSION['login_true_sysadmin'])) {
        echo "<script> alert('กรุณาลงชื่อเข้าใช้งานระบบก่อน ครับ/ค่ะ'); </script>";
        redirect('/login','refresh');
        //redirect("javascript: window.history.go(-1)" );
    }
    ### จบการเช็ค ###
}