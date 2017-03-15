<?php

class Galeri_model extends CI_Model
{
	function get_kategori_objek_wisata($user_id = '')
	{
		if(!empty($user_id))
		{
			$this->db->select('a.*, 
							  (SELECT COUNT(*) FROM objek b WHERE b.kategori_id = a.kategori_id GROUP BY b.kategori_id) as jml_objek,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Publish\' AND b.user_id = \''. $user_id . '\' GROUP BY c.kategori_id) as jml_foto_publish,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Moderasi\' AND b.user_id = \'' . $user_id . '\' GROUP BY c.kategori_id) as jml_foto_moderasi,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Draft\' AND b.user_id = \'' . $user_id . '\' GROUP BY c.kategori_id) as jml_foto_draft', true);			
		}
		else
		{
			$this->db->select('a.*, 
							  (SELECT COUNT(*) FROM objek b WHERE b.kategori_id = a.kategori_id GROUP BY b.kategori_id) as jml_objek,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Publish\' GROUP BY c.kategori_id) as jml_foto_publish,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Moderasi\' GROUP BY c.kategori_id) as jml_foto_moderasi,
							  (SELECT COUNT(*) FROM objek_detail_foto b 
							  				   JOIN objek c ON b.objek_id = c.objek_id
							  				   WHERE c.kategori_id = a.kategori_id AND b.status = \'Draft\' GROUP BY c.kategori_id) as jml_foto_draft', true);			
		}
		$this->db->where('a.jenis', 'objek');
		$this->db->order_by('a.nama_kategori');
		$this->db->from('objek_master_kategori a');
		$query = $this->db->get();
		return $query;
	}

	function get_objek_wisata($kategori_id, $user_id = '')
	{
		if(!empty($user_id))
		{
			$this->db->select('a.*, 
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Publish\' AND b.user_id = \'' . $user_id . '\' GROUP BY b.objek_id) as jml_foto_publish,
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Moderasi\' AND b.user_id = \'' . $user_id . '\' GROUP BY b.objek_id) as jml_foto_moderasi,
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Draft\' AND b.user_id = \'' . $user_id . '\' GROUP BY b.objek_id) as jml_foto_draft,', true);			
		}
		else
		{
			$this->db->select('a.*, 
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Publish\' GROUP BY b.objek_id) as jml_foto_publish,
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Moderasi\' GROUP BY b.objek_id) as jml_foto_moderasi,
							  (SELECT COUNT(*) FROM objek_detail_foto b WHERE b.objek_id = a.objek_id AND b.status = \'Draft\' GROUP BY b.objek_id) as jml_foto_draft', true);			
		}

		$this->db->where('a.status', 'Publish');
		$this->db->where('a.kategori_id', $kategori_id);
		$this->db->order_by('a.nama');
		$this->db->from('objek a');
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

			if(!empty($param['objek_id']))
			{
				$this->db->where('a.objek_id', $param['objek_id']);
			}

			if(!empty($param['status']))
			{
				$this->db->where('a.status', $param['status']);
			}

			if(!empty($param['user_id']))
			{
				$this->db->where('a.user_id', $param['user_id']);
			}
		}

		$this->db->select('a.*, b.nama as nama_kontributor, c.nama as nama_moderator');
		$this->db->order_by('a.nama');
		$this->db->from('objek_detail_foto a');
		$this->db->join('user b', 'b.user_id = a.user_id');
		$this->db->join('user c', 'c.user_id = a.moderasi_user_id', 'left');
		$get = $this->db->get();
		return $get;
	}

	function get_data_row($id, $param = array())
	{
		if(!empty($param))
		{
			if(!empty($param['user_id']))
			{
				$this->db->where('a.user_id', $param['user_id']);
			}
		}

		$this->db->select('a.*, b.nama as nama_objek_wisata, c.nama as nama_kontributor, d.nama as nama_moderator');
		$this->db->where('a.foto_id', $id);
		$this->db->from('objek_detail_foto a');
		$this->db->join('objek b', 'b.objek_id = a.objek_id');
		$this->db->join('user c', 'c.user_id = a.user_id');
		$this->db->join('user d', 'd.user_id = a.moderasi_user_id', 'left');
		$get = $this->db->get();
		return $get->row();
	}

	function insert($data)
	{
		$this->db->insert('objek_detail_foto', $data);
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
		$this->db->where('foto_id', $id);
		$this->db->update('objek_detail_foto', $data);
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
		$this->db->where('foto_id', $id);
		$this->db->delete('objek_detail_foto');
		return true;
	}
}