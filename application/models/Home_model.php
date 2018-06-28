<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function uname_email_check($email,$user_name) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->or_where('uname', $user_name);
		$query = $this->db->get();
		if($query->num_rows() == 0) {
			return true;
		}else {
			return false;
		}
  }

	public function laptop() {
		$this->db->select('*');
		$this->db->from('laptop');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function mobile() {
		$this->db->select('*');
		$this->db->from('mobile');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function pcgames() {
		$this->db->select('*');
		$this->db->from('pcgames');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($user){
		$this->db->insert('user', $user);
  }

	public function e_check($email) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->result();
	}
}
