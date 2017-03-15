<?php

class Donasi_bank_model extends CI_Model
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
				$this->db->like('a.nama', $param['keyword']);
			}
		}

		$this->db->order_by('a.nama');
		$this->db->from('donasi_master_bank a');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('bank_id', $id);
		$get = $this->db->get('donasi_master_bank');
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('donasi_master_bank', $data);
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
		$this->db->where('bank_id', $id);
		$this->db->update('donasi_master_bank', $data);
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
		$this->db->where('bank_id', $id);
		$this->db->delete('donasi_master_bank');
		return true;
	}
}