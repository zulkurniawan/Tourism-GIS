<?php

class Konfigurasi_p_model extends CI_Model
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
				$this->db->like('a.judul', $param['keyword']);
			}
		}

		$this->db->order_by('a.konfigurasi_id');
		$this->db->from('konfigurasi a');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('konfigurasi_id', $id);
		$get = $this->db->get('konfigurasi');
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('konfigurasi', $data);
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
		$this->db->where('konfigurasi_id', $id);
		$this->db->update('konfigurasi', $data);
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
		$this->db->where('konfigurasi_id', $id);
		$this->db->delete('konfigurasi');
		return true;
	}
}