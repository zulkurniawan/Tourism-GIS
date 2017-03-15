<?php

class Akomodasi_objek_model extends CI_Model
{
	function get_opt_kategori($filter = false)
	{
		$this->db->where('jenis', 'akomodasi');
		$this->db->order_by('nama_kategori');
		$this->db->from('objek_master_kategori');
		$query = $this->db->get();

		$result = array();
		if($filter == true)
		{
			$result[] = 'Semua Kategori';
		}
		foreach ($query->result() as $key => $c) 
		{
			$result[$c->kategori_id]	= $c->nama_kategori;
		}
		return $result;
	}

	function get_data_kategori_list()
	{
		$this->db->where('jenis', 'akomodasi');
		$this->db->order_by('nama_kategori');
		$this->db->from('objek_master_kategori');
		$query = $this->db->get();
		return $query;
	}

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

			if(!empty($param['user_id']))
			{
				$this->db->where('a.user_id', $param['user_id']);
			}

			if(!empty($param['status']))
			{
				$this->db->where('a.status', $param['status']);				
			}

			if(!empty($param['kategori']))
			{
				$this->db->where('a.kategori_id', $param['kategori']);				
			}
		}

		$this->db->where('b.jenis', 'akomodasi');
		$this->db->select('a.*, b.nama_kategori, c.nama as nama_kontributor, d.nama as nama_moderator, b.marker_path');
		$this->db->order_by('a.nama');
		$this->db->from('objek a');
		$this->db->join('objek_master_kategori b', 'a.kategori_id = b.kategori_id');
		$this->db->join('user c', 'c.user_id = a.user_id');
		$this->db->join('user d', 'd.user_id = a.moderasi_user_id', 'left');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id, $filter = array())
	{
		if(!empty($filter))
		{
			if(!empty($filter['user_id']))
			{
				$this->db->where('a.user_id', $filter['user_id']);
			}
		}		
		$this->db->select('a.*, b.nama_kategori, c.nama as nama_kontributor, d.nama as nama_moderator');
		$this->db->where('b.jenis', 'akomodasi');
		$this->db->where('a.objek_id', $id);
		$this->db->from('objek a');
		$this->db->join('objek_master_kategori b', 'a.kategori_id = b.kategori_id');
		$this->db->join('user c', 'c.user_id = a.user_id');
		$this->db->join('user d', 'd.user_id = a.moderasi_user_id', 'left');
		$get = $this->db->get();
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('objek', $data);
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
		$this->db->where('objek_id', $id);
		$this->db->update('objek', $data);
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
		$this->db->where('objek_id', $id);
		$this->db->delete('objek');
		return true;
	}

	function get_data_row_by_nama($nama)
	{
		$this->db->where('nama', $nama);
		$query = $this->db->get('objek');
		return $query->row();		
	}

	function get_data_kategori($nama)
	{
		$this->db->where('jenis', 'akomodasi');
		$this->db->where('nama_kategori', $nama);
		$query = $this->db->get('objek_master_kategori');
		return $query->row();
	}

	function insert_data_kategori($nama)
	{
		$this->db->insert('objek_master_kategori', array('nama_kategori' => $nama, 'jenis' => 'akomodasi'));
		return $this->db->insert_id();		
	}
}