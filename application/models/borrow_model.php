<?php
class borrow_model extends CI_Model {

        function get_available_durable()
        {
            $sql = "SELECT b.durable_id
                    FROM   borrows b,
                           durable_article d
                    WHERE  d.can_borrow = 'Y'";
            $query = $this->db->query($sql);
            return $query->result();
        }

        function get_borrow_history($user_id)
        {
            $sql = "SELECT concat(da.durable_name,\" (\",da.durable_code,\")\") as durable_name,
                           b.durable_id,
                           b.borrow_date,
                           b.due_date,
                           b.return_date,
                           bs.borrow_status_name
                    FROM   borrows b,
                           borrow_status bs,
                           durable_article da,
                           users u
                    WHERE  b.durable_id = da.durable_id
                    AND    b.borrow_status_id = bs.borrow_status_id
                    AND    b.users_user_id = u.user_id
                    AND    b.users_user_id = ".$user_id."
                    ORDER BY b.borrow_date DESC;";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        function get_durable_borrowing($id = NULL)
        {   
            if($id == NULL OR $id == ""){
              $where = "";
            }else{
              $where = "AND b.borrow_id = ".$id;
              // print_r($where);
            }
            $sql = "SELECT concat(da.durable_name,\" (\",da.durable_code,\")\") as durable_name,
                           da.durable_id,
                           b.borrow_date,
                           b.due_date,
                           b.return_date,
                           bs.borrow_status_name,
                           concat(u.user_name,\" \",u.user_surname) as user_name
                    FROM   borrows b,
                           borrow_status bs,
                           durable_article da,
                           users u
                    WHERE  b.durable_id = da.durable_id
                    AND    b.borrow_status_id = bs.borrow_status_id
                    AND    b.users_user_id = u.user_id ".$where."
                    ORDER BY b.borrow_date DESC;";
            $query = $this->db->query($sql);
            return $query->result();
       }
       
       function get_durable_available()
       {
              $sql = "SELECT concat(durable_name,\" (\",durable_code,\")\") as durable_name,
                            durable_id
                     FROM   durable_article
                     WHERE  borrow_status = '2'
                     AND    can_borrow = 'Y';";
       $query = $this->db->query($sql);
       return $query->result();  
       }

       function insert_borrow($data = array())
       {
       $query = $this->db->insert('borrows', $data);
       if($query){
          return true; 
       }
          return false;   
       }

       function update_borrow($id,$data = array())
       {
       $query = $this->db->where('borrow_id', $id);    
       $query = $this->db->update('borrows', $data);
       if($query){
          return true; 
       }
          return false;   
       }

       function update_borrow_durable($id,$status)
       {
       $data = array(
              'borrow_status' => $status,
       );
       $query = $this->db->where('durable_id', $id);    
       $query = $this->db->update('durable_article', $data);
       if($query){
          return true; 
       }
          return false;   
       }

       function get_borrowing_history($user_id)
       {
           $sql = "SELECT concat(da.durable_name,\" (\",da.durable_code,\")\") as durable_name,
                          b.borrow_id,
                          b.durable_id,
                          b.borrow_date,
                          b.due_date,
                          b.return_date,
                          bs.borrow_status_name
                   FROM   borrows b,
                          borrow_status bs,
                          durable_article da,
                          users u
                   WHERE  b.durable_id = da.durable_id
                   AND    b.borrow_status_id = bs.borrow_status_id
                   AND    b.users_user_id = u.user_id
                   AND    b.users_user_id = ".$user_id."
                   AND    b.borrow_status_id = '1';";
           $query = $this->db->query($sql);
           return $query->result();
       }
		  
}