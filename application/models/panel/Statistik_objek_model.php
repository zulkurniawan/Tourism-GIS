<?php

class Statistik_objek_model extends CI_Model
{
	function get_data($param = array())
	{
		$query_str 	= "SELECT 
						(SELECT SUM(b.hits) FROM objek_visitor b WHERE b.objek_id = a.objek_id GROUP BY b.objek_id) AS jml_visitor, 
						a.nama, 
						a.foto, 
						a.objek_id
						FROM objek a
						JOIN objek_master_kategori b ON a.kategori_id = b.kategori_id
						WHERE b.jenis = 'objek'";

		if(!empty($param))
		{
			$where 		= '';
			if(!empty($param['keyword']))
			{
				$where .= " AND a.nama LIKE '%$param[keyword]%' ";
			}

			if(!empty($param['kategori']))
			{
				$where .= " AND a.kategori_id = '$param[kategori]' ";				
			}

			$query_str .= $where;
		}

		$query_str	.= " ORDER BY jml_visitor DESC, a.nama ASC";

		if(!empty($param['limit']))
		{
			if(!empty($param['offset']))
			{
				$query_str .= " LIMIT $param[offset], $param[limit]";
			}
			else
			{
				$query_str .= " LIMIT $param[limit]";				
			}
		}

		$get = $this->db->query($query_str);
		return $get;
	}



	function get_data_view_objek($objek_id, $param = array())
	{
		$tgl_mulai	 	= date('Y-m-d', strtotime($param['tgl_mulai']));
		$tgl_selesai 	= date('Y-m-d', strtotime($param['tgl_selesai']));
		$this->db->where("a.waktu >= '$tgl_mulai' AND a.waktu <= '$tgl_selesai'");
		$this->db->select('SUM(a.hits) as jml_view, a.waktu');
		$this->db->group_by('a.waktu');
		$this->db->where('a.objek_id', $objek_id);
		$this->db->from('objek_visitor a');
		$query = $this->db->get();

		$result = array();
		foreach ($query->result() as $key => $c) 
		{
			$result[$c->waktu] = $c->jml_view;
		}
		return $result;
	}

	function get_data_unik_visitor($objek_id, $param = array())
	{
		$tgl_mulai	 	= date('Y-m-d', strtotime($param['tgl_mulai']));
		$tgl_selesai 	= date('Y-m-d', strtotime($param['tgl_selesai']));
		$this->db->where("a.waktu >= '$tgl_mulai' AND a.waktu <= '$tgl_selesai'");
		$this->db->select('SUM(a.hits) as jml_view, a.waktu');
		$this->db->group_by('a.waktu');
		$this->db->where('a.unik', 'Y');
		$this->db->where('a.objek_id', $objek_id);
		$this->db->from('objek_visitor a');
		$query = $this->db->get();

		$result = array();
		foreach ($query->result() as $key => $c) 
		{
			$result[$c->waktu] = $c->jml_view;
		}
		return $result;
	}

	function get_data_row($id)
	{
		$this->db->select('a.*, b.nama_kategori, c.nama as nama_kontributor, d.nama as nama_moderator');
		$this->db->where('b.jenis', 'objek');
		$this->db->where('a.objek_id', $id);
		$this->db->from('objek a');
		$this->db->from('objek_master_kategori b', 'a.kategori_id = b.kategori_id');
		$this->db->join('user c', 'c.user_id = a.user_id');
		$this->db->join('user d', 'd.user_id = a.moderasi_user_id', 'left');
		$get = $this->db->get();
		return $get->row();
	}

}