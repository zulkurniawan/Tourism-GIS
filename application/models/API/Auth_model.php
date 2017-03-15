<?php

class Auth_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$query = "DELETE 
					FROM user 
					WHERE tgl_daftar < (NOW() - INTERVAL 2 HOUR) AND 
						  status = 'temp_moderasi'";
		$this->db->query($query);
	}

	function get_login($email, $field = 'email')
	{
		$this->db->where($field, $email);
		$this->db->from('user');
		$query = $this->db->get();
		if(empty($query->row()))
		{
			if($field == 'email')
			{
				return $this->get_login($email, 'no_hp');
			}
		}
		return $query;
	}

	function update_last_login($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user', array('terakhir_login' => date('Y-m-d H:i:s')));
	}

	function get_data_verifikasi($no_hp)
	{
		$this->db->where('no_hp', $no_hp);
		$this->db->from('user');
		$query = $this->db->get();
		return $query;
	}

	function update_status_verifikasi($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user', array('status' => 'moderasi'));		
	}

	function update_data_verifikasi($user_id, $data)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
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

	function register($data)
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
}