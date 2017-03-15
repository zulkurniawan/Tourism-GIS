<?php

class Poin_model extends CI_Model
{
	function get_kontributor_terbaik($param = array())
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
		}		
		$this->db->order_by('jml_poin', 'DESC');
		$this->db->select("(SELECT SUM(b.jumlah) FROM poin b WHERE b.user_id = a.user_id) AS jml_poin, a.*", true);
		$this->db->where('a.level', 'Kontributor');
		$this->db->from('user a');
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
				$this->db->like('a.nama_kategori', $param['keyword']);
			}

			if(!empty($param['user_id']))
			{
				$this->db->where('user_id', $param['user_id']);
			}
		}

		$this->db->order_by('a.poin_id', 'DESC');
		$this->db->from('poin a');
		$get = $this->db->get();
		return $get;
	}

	function insert($data)
	{
		$this->db->insert('poin', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function hitung_poin($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->select_sum('jumlah');
		$this->db->from('poin');
		$query = $this->db->get();

		$result = $query->row();
		if(empty($result->jumlah))
		{
			return "0";
		}
		return $result->jumlah;
	}
}