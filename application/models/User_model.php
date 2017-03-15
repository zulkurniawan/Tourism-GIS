<?php

class User_model extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('user', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_user_profil($uid)
	{
		$this->db->where('user_id', $uid);
		$this->db->from('user');
		$query = $this->db->get();
		return $query->row();
	}

	function cek_data($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		return $query;
	}	

	function generate_reg_code()
	{
		$query_str = "SELECT uuid() AS unik";
		$query = $this->db->query($query_str);

		$result = $query->row()->unik;

		$s = rand(000000, 999999);
		$result = substr(crypt($result, $s), 0, 4);
		return $result;
	}
}