<?php
class user_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    function get_users()
	{	$sql = "select 
                u.user_id
                ,u.user_name
                ,u.user_surname
                ,u.user_status_id
            ,tu.type_user_name
            from users u,
                type_user tu
        where u.type_user_id = tu.type_user_id
        and   u.type_user_id IN ('A','U');";
		$query = $this->db->query($sql);
		return $query->result();
    }
    
    function get_user_detail($id)
    {
        $sql = "select u.user_id, 
                       u.user_name, 
                       u.user_surname, 
                       u.user_email, 
                       u.user_status_id,
                       u.register_date, 
                       m.major_name,
                       f.faculty_name
                from   users u, 
                       majors m,
                       faculties f 
                where  user_id = ".$id." 
                and    u.major_id = m.major_id
                and    m.faculty_id = f.faculty_id;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function update_user_detail($user_id,$status_id)
    {
        $data = array('user_status_id' => $status_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('users',$data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_faculty()
    {
        $this->db->select('*');
        $query = $this->db->get('faculties');
        return $query->result();
    }

    function get_user_update($o_id)
    {
        $sql = "select u.user_id,
						 u.user_name,
						 u.user_surname,
						 u.user_email,
						 u.user_password,
						 u.user_status_id,
						 u.type_user_id,
						 u.register_date,
                         u.major_id,
                         m.major_name,
						 f.faculty_id
				  from
						 users u,
						 majors m,
						 faculties f
				  where  
							 m.major_id = u.major_id
				  and    u.major_id = f.faculty_id
                  and    u.user_id = ".$o_id.";";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_major_id($id)
    {
        $sql = "SELECT * FROM majors WHERE faculty_id = ".$id.";";
        // print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_course_id($id)
    {
        $sql = "SELECT * FROM course WHERE major_id = ".$id.";";
        // print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_building_id($id)
    {
        $sql = "SELECT * FROM buildings WHERE campus_id = ".$id.";";
        // print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_room_id($id)
    {
        $sql = "SELECT * FROM rooms WHERE building_id = ".$id.";";
        // print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_type()
    {
        $sql = "SELECT * FROM type_user WHERE type_user_id != 'S';";
        // print_r($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insert_user($data = array())
    {
        try {
            $this->db->insert('users', $data);
    
            // documentation at
            // https://www.codeigniter.com/userguide3/database/queries.html#handling-errors
            // says; "the error() method will return an array containing its code and message"
            $db_error = $this->db->error();
            if (!empty($db_error)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false; // unreachable retrun statement !!!
            }
            return TRUE;
        } catch (Exception $e) {
            // this will not catch DB related errors. But it will include them, because this is more general. 
            // log_message('error: ',$e->getMessage());
            return $e->getMessage();
        }
        
    }

    function update_user($id,$data = array())
    {
            $this->db->where('user_id', $id);
            $result = $this->db->update('users', $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function update_user_and_pass($id,$password)
    {
        $sql = "UPDATE users
        SET user_password = ".$password."
        WHERE user_id = '".$id."'";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function update_password($user_mail,$user_password,$user_token)
    {
        $sql = "UPDATE users
        SET user_password = ".$user_password." , user_status_id = 'Y'
        WHERE user_email = '".$user_mail."'
        AND   user_token = '".$user_token."';";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

}