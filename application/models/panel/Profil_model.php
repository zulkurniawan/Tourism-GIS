<?php

class Profil_model extends CI_Model
{
	function get_data_row($id)
	{
		$this->db->where('user_id', $id);
		$get = $this->db->get('user');
		return $get->row();
	}

	function update($data, $id)
	{
		$this->db->where('user_id', $id);
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
}