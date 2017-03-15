<?php

class Donasi_rekening_model extends CI_Model
{
	function get_opt_bank()
	{
		$result = array();
		$this->db->from('donasi_master_bank');
		$query = $this->db->get();
		foreach($query->result() as $key => $c)
		{
			$result[$c->bank_id] = $c->nama;
		}
		return $result;
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
		}

		$this->db->select('a.*, b.nama as nama_bank');
		$this->db->order_by('a.atas_nama');
		$this->db->order_by('a.nomor_rekening');
		$this->db->from('donasi_rekening a');
		$this->db->join('donasi_master_bank b', 'a.bank_id = b.bank_id');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id)
	{
		$this->db->where('rekening_id', $id);
		$get = $this->db->get('donasi_rekening');
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('donasi_rekening', $data);
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
		$this->db->where('rekening_id', $id);
		$this->db->update('donasi_rekening', $data);
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
		$this->db->where('rekening_id', $id);
		$this->db->delete('donasi_rekening');
		return true;
	}
}