<?php

class User_model extends CI_Model
{	
	function get_data($param = array())
	{
		if(!empty($param))
		{
			if(!empty($param['limit']))
			{
				if(!empty($param['offset']))
				{
					$this->db->limit($param['limit'], $param['offset']);
				}
				else
				{
					$this->db->limit($param['limit']);
				}
			}

			if(!empty($param['keyword']))
			{
				$this->db->where("(a.email LIKE '%$param[keyword]%' OR a.nama LIKE '%$param[keyword]%')");
			}

			if(!empty($param['jenis']))
			{
				$this->db->where('level', ucwords($param['jenis']));
			}
		}
		$this->db->where("a.status != 'temp_moderasi'");
		$this->db->order_by('a.nama');
		$this->db->from('user a');
		$get = $this->db->get();

		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('user_id', $id);
		$get = $this->db->get('user');
		return $get->row();
	}

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

	function delete($id)
	{
		$uid = $this->session->userdata('login_uid');
		$this->db->where("user_id != '$uid'");
		$this->db->where('user_id', $id);
		$this->db->delete('user');
		return true;
	}
}