<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login_model extends CI_Model {
    
    function checkLogin($username,$password)
    {
        $sql = "select 
        user_id
    ,	concat(user_name,' ',user_surname)   uname 
    ,   user_status_id
    ,   type_user_id
    ,   major_id
    from 	
        users 
    where 
        user_email	= '$username' 
    and user_password = sha1('$password');";
    $query = $this->db->query($sql);
    return $query->result();
    }

}