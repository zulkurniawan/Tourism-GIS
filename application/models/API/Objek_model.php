<?php

class Objek_model Extends CI_Model
{
	function get_data($filter = array())
	{	
		if(!empty($filter))
		{
			if(!empty($filter['keyword']))
			{
				$this->db->like('a.nama', $filter['keyword']);
			}

			if(!empty($filter['objek_id']))
			{
				$this->db->where('a.objek_id', $filter['objek_id']);				
			}
		}

		$this->db->select('a.*, b.nama_kategori, b.marker_path, b.jenis, c.nama as nama_kontributor');	
		$this->db->order_by('b.jenis');
		$this->db->order_by('a.nama');
		$this->db->where('a.status', 'Publish');
		$this->db->from('objek a');
		$this->db->join('objek_master_kategori b', 'a.kategori_id = b.kategori_id');
		$this->db->join('user c', 'a.user_id = c.user_id');
		$query = $this->db->get();
		return $query;
	}

	function get_objek_terdekat($id)
	{
		//Perbaharui Lat Lng Semua Objek
		$result = $this->db->get('objek')->result();
		foreach ($result as $key => $c) 
		{
			$param_update = array('lat' => scrape_get_between($c->lokasi_koordinat, "{lat:", ","), 
								  'lng'	=> scrape_get_between($c->lokasi_koordinat, "lng:", "}"));
			$this->db->where('objek_id', $c->objek_id);
			$this->db->update('objek', $param_update);
		}

		$this->db->where('objek_id', $id);
		$result = $this->db->get('objek')->row();
		if(!empty($result))
		{
			$lat = $result->lat;
			$lng = $result->lng;

			$query_str = "SELECT a.objek_id, a.nama, a.foto, a.url_seo, b.nama as nama_kontributor,
						       (6371 * Acos(Cos(Radians($lat)) * Cos(Radians(a.lat)) * 
						       		   		Cos(Radians(a.lng) - Radians($lng)) + 
						                    Sin(Radians($lat)) * Sin(Radians(a.lat))
						                   )) AS jarak 
							FROM objek a 
							JOIN user b ON a.user_id = b.user_id
							WHERE a.objek_id != '$id'
							ORDER  BY jarak 
							LIMIT  0, 5";
			$query = $this->db->query($query_str);
			$result = array();
			foreach ($query->result() as $key => $c) 
			{
				if(!empty($c->foto))
				{
					$c->foto = base_url('uploads/' . $c->foto);
				}
				else
				{
					$c->foto = base_url('assets/default.png');
				}
				$c->link = site_url('objek/index/' . $c->objek_id . '-' . $c->url_seo);
				$c->jarak = number_format($c->jarak, 2);
				$result[] = $c;
			}
			return $result;
		}
		else
		{
			return '';
		}
	}

	function get_data_artikel($filter = array())
	{
		if(!empty($filter))
		{
			if(!empty($filter['limit']))
			{
				$this->db->limit($filter['limit']);
			}

			if(!empty($filter['objek_id']))
			{
				$this->db->where('a.objek_id', $filter['objek_id']);				
			}
		}

		$this->db->where('a.status', 'Publish');
		$this->db->order_by('a.tgl_posting', 'DESC');
		$this->db->select('a.*, c.nama as nama_kontributor');	
		$this->db->from('objek_detail_artikel a');
		$this->db->join('user c', 'a.user_id = c.user_id');
		$query = $this->db->get();
		return $query;		
	}

	function get_data_foto($filter = array())
	{
		if(!empty($filter))
		{
			if(!empty($filter['limit']))
			{
				$this->db->limit($filter['limit']);
			}

			if(!empty($filter['objek_id']))
			{
				$this->db->where('a.objek_id', $filter['objek_id']);				
			}
		}

		$this->db->where('a.status', 'Publish');
		$this->db->order_by('a.tgl_upload', 'DESC');
		$this->db->select('a.*, c.nama as nama_kontributor');	
		$this->db->from('objek_detail_foto a');
		$this->db->join('user c', 'a.user_id = c.user_id');
		$query = $this->db->get();
		return $query;		
	}

	function tracking_visitor($param)
	{
		$login_status 	 = $this->session->userdata('login_status');
		if(!empty($login_status))
		{
			return true;
		}

		$tracking_status = $this->session->userdata('tracking_status_objek_' . $param['objek_id']);
		if(empty($tracking_status))
		{
			$cek_waktu = $this->_cek_visitor_waktu($param['ip'], $param['waktu'], $param['objek_id'])->row();
			if(empty($cek_waktu))
			{
				$cek_unik = $this->_cek_visitor_unik($param['ip'], $param['objek_id'])->row();
				if(empty($cek_unik))
				{
					$param['unik'] = 'Y';
				}
				else
				{
					$param['unik'] = 'N';					
				}
				$param['hits']	= 1;
				$this->_insert_visitor($param);
				$this->session->set_userdata('tracking_status_objek_' . $param['objek_id'], $this->db->insert_id());
			}	
			else
			{
				$this->_update_visitor_hits($cek_waktu->visitor_id);
			}		
		}
		else
		{
			$this->_update_visitor_hits($tracking_status);
		}
	}

	function _update_visitor_hits($id)
	{
		$query_str = "UPDATE objek_visitor SET hits = hits + 1 WHERE visitor_id = '$id'";
		$this->db->query($query_str);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function _insert_visitor($param)
	{
		$this->db->insert('objek_visitor', $param);
	}

	function _cek_visitor_unik($ip, $objek_id)
	{
		$this->db->limit(1);
		$this->db->where('unik', 'Y');
		$this->db->where('ip', $ip);
		$this->db->where('objek_id', $objek_id);
		$query = $this->db->get('objek_visitor');
		return $query;
	}

	function _cek_visitor_waktu($ip, $waktu, $objek_id)
	{
		$this->db->limit(1);
		$this->db->where('waktu', $waktu);
		$this->db->where('ip', $ip);
		$this->db->where('objek_id', $objek_id);
		$query = $this->db->get('objek_visitor');
		return $query;		
	}

}