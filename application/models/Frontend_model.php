<?php
class Frontend_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
	}
	
        function get_durable_detail($durable_id)
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
		WHERE  da.durable_id = $durable_id
		AND    da.cat_id = c.cat_id
		AND    da.user_id = u.user_id
		AND    da.durable_status_id = ds.durable_status_id
		AND    da.room_id = r.room_id;";
          $query = $this->db->query($sql);
          return $query->result();
        }

        function insert_sign($durable_id)
        {
        		$data = array( 'durable_id' => $durable_id,
			                   'usage_datetime' => date("Y-m-d h:m:s"));
				$query = $this->db->insert('usage_log', $data);
				if($query){
					return true;
				}else{
					return false;
				}	
        }

        function insert_report($data = array())
        {
				$query = $this->db->insert('problem_report', $data);
				if($query){
					return true;
				}else{
					return false;
				}	
        }

}
