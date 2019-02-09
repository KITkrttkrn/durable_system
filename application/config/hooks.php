<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller'] = array(
    'class'    => 'LoginHook', // ชื่อคลาส
    'function' => 'check_login', // ชื่อฟังก์ชั่นที่เรียกใช้งานหรือเมธอด
    'filename' => 'LoginHook.php', // ชื่อไฟล์
    'filepath' => 'hooks', // โฟลเด้อหรือตำแหน่งของไฟล์
    'params'   => '' // สำหรับส่งตัวแปรพารามิเตอร์ไปแบบอาเรย์
);

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
