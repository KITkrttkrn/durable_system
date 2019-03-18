<?php
class durable_model extends CI_Model {

        function get_durable()
        {
            $this->db->select('*');
            $query = $this->db->get('durable_article');
          return $query->result();
		  }
		  
		  function get_durable_nojoin_by_id($id)
        {
				$this->db->select('*');
				$this->db->where('durable_id', $id);
            $query = $this->db->get('durable_article');
          return $query->result();
        }
    
        function get_depreciation_detail($id)
        {
            $sql = "SELECT da.durable_id,
						   da.durable_code,
						   da.durable_name,
						   da.use_date,
						   da.add_date,
						   c.cat_name,
						   da.picture_path,
						   u.user_name,
						   u.user_surname,
						   da.price,
						   ds.durable_status_name,
						   r.room_name,
						   da.description,
                           da.durable_age,
                           da.scrap_value
					FROM   durable_article da,
						   category c,
						   users u,
						   durable_status ds,
						   rooms r
					WHERE  da.durable_id = ".$id."
					AND    da.cat_id = c.cat_id
					AND    da.user_id = u.user_id
					AND    da.durable_status_id = ds.durable_status_id
                    AND    da.room_id = r.room_id;";
                    $query = $this->db->query($sql);
                    return $query->result();
        }

        function get_durable_id($id)
        {
            $sql = "SELECT da.durable_id,
						   da.durable_code,
						   da.durable_name,
						   da.use_date,
						   da.add_date,
						   c.cat_name,
						   da.picture_path,
						   u.user_name,
						   u.user_surname,
						   da.price,
						   ds.durable_status_name,
						   r.room_name,
						   da.description
					FROM   durable_article da,
						   category c,
						   users u,
						   durable_status ds,
						   rooms r
					WHERE  da.durable_id = ".$id."
					AND    da.cat_id = c.cat_id
					AND    da.user_id = u.user_id
					AND    da.durable_status_id = ds.durable_status_id
					AND    da.room_id = r.room_id;";
            $query = $this->db->query($sql);
          return $query->result();
		}
		
		public function get_cat($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = "where cat_id = ".$id;
			}
			$sql = "select 
			cat_id
			,cat_name
			,durable_age
		   from
			category
			".$where."
		   order by
			cat_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_faculties()
		{
			$q = $this->db->select('*');
			$q = $this->db->get('faculties');
			return $q->result();
		}

		public function get_user()
		{
			$sql = "select 
			user_id
		   ,concat(user_name,' ',user_surname) user_name
		   from
			users
		   order by
			user_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_room()
		{
			$sql = "		select 
			r.room_id
		   , b.building_id
			,c.campus_id
		   ,concat(b.building_name,' ',r.room_name,' ',c.campus_name) room_name
		   from
			rooms r
			,buildings b
			,campus c
		   where
			r.building_id = b.building_id
		   and b.campus_id = c.campus_id
		   order by
			c.campus_id, b.building_id, c.campus_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_durable_status()
		{
			$sql = "		select 
			durable_status_id
			,durable_status_name
	
		   from
			durable_status
		   order by
			durable_status_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function find_durable_age($cat_id)
		{
			$sql = "SELECT durable_age
					  FROM   category
					  WHERE  cat_id = ".$cat_id.";";
			$q = $this->db->query($sql);
			return $q->result();
		}

		public function insert_durable($data = array())
		{
			$q = $this->db->insert('durable_article', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function update_durable($id,$data = array())
		{
			$q = $this->db->where('durable_id', $id);
			$q = $this->db->update('durable_article', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertCat($data = array())
		{
			$q = $this->db->insert('category', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateCat($id,$data = array())
		{
			$q = $this->db->where('cat_id', $id);
			$q = $this->db->update('category', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function getCampus()
		{
			$q = $this->db->select('*');
			$q = $this->db->get('campus');
			return $q->result();
		}

		

}