<?php

class Galeri_model extends CI_Model
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

			if(!empty($param['objek_id']))
			{
				$this->db->where('a.objek_id', $param['objek_id']);
			}

			if(!empty($param['user_id']))
			{
				$this->db->where('a.user_id', $param['user_id']);
			}

			if(!empty($param['id']))
			{
				$this->db->where('a.foto_id', $param['id']);
			}
		}

		$this->db->where('a.status', 'Publish');
		$this->db->select('a.*, b.nama as nama_kontributor');
		$this->db->order_by('a.tgl_upload', 'DESC');
		$this->db->from('objek_detail_foto a');
		$this->db->join('user b', 'b.user_id = a.user_id');
		$get = $this->db->get();
		return $get;
	}	
}