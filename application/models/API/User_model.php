<?php

class User_model extends CI_Model
{
	function get_user_profil($uid)
	{
		$this->db->where('user_id', $uid);
		$this->db->from('user');
		$query = $this->db->get();
		return $query->row();
	}


	function get_kontributor()
	{
		$this->db->order_by('terakhir_login', 'DESC');
		$this->db->where('level', 'Kontributor');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->result();		
	}
}