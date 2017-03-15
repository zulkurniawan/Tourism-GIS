<?php

class Kategori_model extends CI_Model
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
				$this->db->like('a.nama_kategori', $param['keyword']);
			}
		}

		$this->db->where('a.jenis', 'objek');
		$this->db->order_by('a.nama_kategori');
		$this->db->from('objek_master_kategori a');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('jenis', 'objek');
		$this->db->where('kategori_id', $id);
		$get = $this->db->get('objek_master_kategori');
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('objek_master_kategori', $data);
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
		$this->db->where('jenis', 'objek');
		$this->db->where('kategori_id', $id);
		$this->db->update('objek_master_kategori', $data);
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
		$this->db->where('jenis', 'objek');
		$this->db->where('kategori_id', $id);
		$this->db->delete('objek_master_kategori');
		return true;
	}
}