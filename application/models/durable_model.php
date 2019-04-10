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
				
			function get_durable_join_by_id($id)
        {
					$sql = "select *
									from durable_article d,
											 faculties f,
											 majors m
									where m.major_id = d.major_id
									and f.faculty_id = m.faculty_id
									and d.durable_id = ".$id.";";
        	$query = $this->db->query($sql);
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
						da.description,
						CASE WHEN co.course_name IS NULL THEN concat('สาขา ',m.major_name,' คณะ ',f.faculty_name)
									ELSE concat('หลักสูตร ',co.course_name,' สาขา ',m.major_name,' คณะ ',f.faculty_name)
								 END AS custom_owner_name
			 FROM   durable_article da
			 LEFT JOIN category c ON da.cat_id = c.cat_id
			 LEFT JOIN users u ON da.user_id = u.user_id
			 LEFT JOIN course co ON da.course_id = co.course_id
			 LEFT JOIN majors m ON da.major_id = m.major_id
			 LEFT JOIN faculties f ON m.faculty_id = f.faculty_id
			 LEFT JOIN durable_status ds ON da.durable_status_id = ds.durable_status_id
			 LEFT JOIN rooms r ON da.room_id = r.room_id
			 WHERE  da.durable_id = ".$id.";";
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

		public function get_faculty($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = "where faculty_id = ".$id;
			}
			$sql = "select *
		   from
			faculties
			".$where."
		   order by
			faculty_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_campus($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = "where campus_id = ".$id;
			}
			$sql = "select *
		   from
			campus
			".$where."
		   order by
			campus_name;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_building($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and b.campus_id = ".$id;
			}

			$sql = "select *
			 from
			buildings b,
			campus c
			where b.campus_id = c.campus_id
			".$where." 
		   order by
			building_id;";
			// echo $sql;
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_building_by_id($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and b.building_id = ".$id;
			}

			$sql = "select *
			 from
			buildings b,
			campus c
			where b.campus_id = c.campus_id
			".$where." 
		   order by
			building_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_major($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and m.faculty_id = ".$id;
			}

			$sql = "select *
			 from
			majors m,
			faculties f
			where m.faculty_id = f.faculty_id
			".$where." 
		   order by
			major_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}
		
		public function get_major_by_id($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and m.major_id = ".$id;
			}

			$sql = "select *
			 from
			majors m,
			faculties f
			where m.faculty_id = f.faculty_id
			".$where." 
		   order by
			major_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_course($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and c.major_id = ".$id;
			}

			$sql = "select *
			 from
			course c,
			majors m,
			faculties f
			where m.faculty_id = f.faculty_id
			and c.major_id = m.major_id
			".$where." 
		   order by
			c.course_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_room_by_building_id($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and r.building_id = ".$id;
			}

			$sql = "select *
			 from
			rooms r,
			buildings b,
			campus c
			where r.building_id = b.building_id
			and b.campus_id = c.campus_id
			".$where." 
		   order by
			r.room_id;";
			// echo $sql;
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_course_by_id($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and c.course_id = ".$id;
			}

			$sql = "select *
			 from
			course c,
			majors m,
			faculties f
			where m.faculty_id = f.faculty_id
			and c.major_id = m.major_id
			".$where." 
		   order by
			c.course_id;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_room_by_id($id = NULL)
		{
			if($id == NULL OR $id == ""){
				$where = "";
			}else{
				$where = " and r.room_id = ".$id;
			}

			$sql = "select *
			 from
			rooms r,
			buildings b,
		  campus c
			where r.building_id = b.building_id
			and b.campus_id = c.campus_id
			".$where." 
		   order by
			r.room_id;";
			// echo $sql;
			$result = $this->db->query($sql);
			return $result->result();
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

		public function get_faculties()
		{
			$sql = "select *
						 from faculties;";
			$result = $this->db->query($sql);
			return $result->result();
		}

		public function get_fac_by_major_id()
		{
			$sql = "select *
						 from faculties;";
			$result = $this->db->query($sql);
			if($result){
				$sql = "select *
				from faculties;";
				$result = $this->db->query($sql);
				return $result->result();
			}
			
		}

		public function get_majors($id)
		{
			$sql = "select *
						 from majors
						 where faculty_id = ".$id.";";
			$result = $this->db->query($sql);
			return $result->result();
		}

		// public function get_course($id)
		// {
		// 	$sql = "select *
		// 				 from course
		// 				 where major_id = ".$id.";";
		// 	$result = $this->db->query($sql);
		// 	return $result->result();
		// }

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

		public function delete_durable($id)
		{
			$q = $this->db->delete('durable_article', array('durable_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteCat($id)
		{
			$q = $this->db->delete('category', array('cat_id' => $id));
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

		public function deleteFaculty($id)
		{
			$q = $this->db->delete('faculties', array('faculty_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertFaculty($data = array())
		{
			$q = $this->db->insert('faculties', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateFaculty($id,$data = array())
		{
			$q = $this->db->where('faculty_id', $id);
			$q = $this->db->update('faculties', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteMajor($id)
		{
			$q = $this->db->delete('majors', array('major_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertMajor($data = array())
		{
			$q = $this->db->insert('majors', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateMajor($id,$data = array())
		{
			$q = $this->db->where('major_id', $id);
			$q = $this->db->update('majors', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteCourse($id)
		{
			$q = $this->db->delete('course', array('course_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertCourse($data = array())
		{
			$q = $this->db->insert('course', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateCourse($id,$data = array())
		{
			$q = $this->db->where('course_id', $id);
			$q = $this->db->update('course', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteCampus($id)
		{
			$q = $this->db->delete('campus', array('campus_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertCampus($data = array())
		{
			$q = $this->db->insert('campus', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateCampus($id,$data = array())
		{
			$q = $this->db->where('campus_id', $id);
			$q = $this->db->update('campus', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteBuilding($id)
		{
			$q = $this->db->delete('buildings', array('building_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertBuilding($data = array())
		{
			$q = $this->db->insert('buildings', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateBuilding($id,$data = array())
		{
			$q = $this->db->where('building_id', $id);
			$q = $this->db->update('buildings', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function deleteRoom($id)
		{
			$q = $this->db->delete('rooms', array('room_id' => $id));
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function insertRoom($data = array())
		{
			$q = $this->db->insert('rooms', $data);
			if($q){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function updateRoom($id,$data = array())
		{
			$q = $this->db->where('room_id', $id);
			$q = $this->db->update('rooms', $data);
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