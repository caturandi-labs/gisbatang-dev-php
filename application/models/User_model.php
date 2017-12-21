<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    public function register($data)
    {   
        return $this->db->insert('users', $data);
    }

    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->row();
    }


	public function login($username, $password) {
        $this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            $result = $query->result();
            return $result[0]->id;
        }
        
        return false;
    }

    public function is_valid($username){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("username", $username);
        $query = $this->db->get();
        return $query->row();
    }

    public function is_valid_num($username){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("username", $username);
        $query = $this->db->get();
        return $query->num_rows();
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */