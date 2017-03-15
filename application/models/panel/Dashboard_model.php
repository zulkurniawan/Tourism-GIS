<?php

class Dashboard_model extends CI_Model
{
	function get_total_kontribusi_objek($user_id = '')
	{
		$this->db->select("COUNT(*) AS jml");
		if(empty($user_id))
		{
			$this->db->where('status', 'Publish');
		}
		else
		{
			$this->db->where('user_id', $user_id);
		}
		$query = $this->db->get('objek')->row();

		return $query->jml;
	}

	function get_total_kontribusi_foto($user_id)
	{
		$this->db->select("COUNT(*) AS jml");
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('objek_detail_foto')->row();

		return $query->jml;
	}

	function get_total_kontribusi_artikel($user_id)
	{
		$this->db->select("COUNT(*) AS jml");
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('objek_detail_artikel')->row();

		return $query->jml;
	}

	function get_total_pending_objek($jenis = 'objek')
	{
		$this->db->where('b.jenis', $jenis);
		$this->db->where('a.status', 'Moderasi');
		$this->db->select("COUNT(*) AS jml");
		$this->db->from('objek a');
		$this->db->join('objek_master_kategori b', 'a.kategori_id = b.kategori_id');
		$query = $this->db->get()->row();
		return $query->jml;
	}

	function get_total_pending_foto($jenis = 'objek')
	{
		$this->db->where('c.jenis', $jenis);
		$this->db->where('a.status', 'Moderasi');
		$this->db->select("COUNT(*) AS jml");
		$this->db->from('objek_detail_foto a');
		$this->db->join('objek b', 'a.objek_id = b.objek_id');
		$this->db->join('objek_master_kategori c', 'c.kategori_id = b.kategori_id');
		$query = $this->db->get()->row();
		return $query->jml;		
	}

	function get_total_pending_artikel($jenis = 'objek')
	{
		$this->db->where('c.jenis', $jenis);
		$this->db->where('a.status', 'Moderasi');
		$this->db->select("COUNT(*) AS jml");
		$this->db->from('objek_detail_artikel a');
		$this->db->join('objek b', 'a.objek_id = b.objek_id');
		$this->db->join('objek_master_kategori c', 'c.kategori_id = b.kategori_id');
		$query = $this->db->get()->row();
		return $query->jml;		
	}

	function get_total_pending_user($status, $level = '')
	{
		if(!empty($level))
		{
			$this->db->where('level', $level);
		}
		$this->db->select("COUNT(*) AS jml");
		$this->db->where('status', $status);
		$query = $this->db->get('user')->row();

		return $query->jml;				
	}

}