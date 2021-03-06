<?php
class sysconfig extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function sysname()
    {
        $query = $this->db->select('syscode,sysvalue');
        $query = $this->db->where('syscode', 'SYS');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function user_mail()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'MAL');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function user_pass()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'PAS');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function mail_port()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'PRT');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function smtp_host()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'SER');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function getLineToken()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'LTK');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function getLineMessage()
    {
        $query = $this->db->select('syscode, sysvalue');
        $query = $this->db->where('syscode', 'LMS');
        $query = $this->db->get('sysconfig');
        return $query->result();
    }

    public function getall()
    {
        $q = $this->db->select('*');
        $q = $this->db->from('sysconfig');
        $q = $this->db->get();
        return $q->result();
    }

    public function updatesysconfig($syscode, $data = array())
    {
        $q = $this->db->where('syscode', $syscode);
        $q = $this->db->update('sysconfig', $data);
        if ($q) {
            return true;
        } else {
            return false;
        }

    }

}
