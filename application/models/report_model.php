<?php
class report_model extends CI_Model {

        function get_report()
        {
            $this->db->select('*');
            $query = $this->db->get('problem_report');
          return $query->result();
        }

        function get_report_join()
        {
            $sql = "select pb.problem_id,
            da.durable_code,
            pb.problem_topic,
            pb.problem_status_id,
            ps.problem_status_name,
            da.durable_name
     from   problem_report pb,
            problem_status ps,
            durable_article da
     where  pb.problem_status_id = ps.problem_status_id
     and    pb.durable_id = da.durable_id;";
            $query = $this->db->query($sql);
          return $query->result();
        }



        function get_report_by_durable_id($id)
        {
            $sql = "select p.problem_id,
                                p.problem_topic,
                                ps.problem_status_name
                        from   problem_report p,
                                problem_status ps
                        where  p.durable_id = ".$id."
                        and    p.problem_status_id = ps.problem_status_id;";
            $query = $this->db->query($sql);
          return $query->result();
        }

        function get_problem_detail($id)
        {
            $sql = "select pb.problem_id,
               pb.problem_topic,
               pb.problem_detail,
               pb.problem_status_id,
               ps.problem_status_name,
               pb.reporter_name,
               pb.reporter_surname,
               pb.reporter_id,
               pb.report_datetime,
               da.durable_code,
               
               da.durable_name
        from   problem_report pb,
               problem_status ps,
               durable_article da
        where  pb.problem_status_id = ps.problem_status_id
        and pb.durable_id = da.durable_id
        and pb.problem_id = ".$id.";";
            $query = $this->db->query($sql);
          return $query->result();
        }

        function get_problem_status_detail($id)
        {
            $sql = "select problem_status_id,
            problem_status_name
     from   problem_status;";
            $query = $this->db->query($sql);
          return $query->result();
        }

        function update_problem_status_detail($id,$data = array())
        {
          $this->db->where('problem_id', $id);
          $query = $this->db->update('problem_report',$data);
          if($query){
              return true;
          }else{
              return false;
          }

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

        

}