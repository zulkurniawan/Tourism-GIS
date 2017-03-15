<?php

class Objek Extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/objek_model');
	}

	function get_data()
	{
		$filter	= array('keyword' => $this->input->post('keyword'));
		$data 	= $this->objek_model->get_data($filter)->result();
		if(!empty($data))
		{
			$result = array();
			foreach($data as $key => $c)
			{
				if($c->jenis == 'akomodasi')
				{
					if(!empty($c->akomodasi_maks_waktu_tayang))
					{
						if(strtotime($c->akomodasi_maks_waktu_tayang) < strtotime(date('Y-m-d H:i:s')))
						{
							continue;
						}
					}
				}

				unset($c->user_id);
				unset($c->moderasi_keterangan);
				unset($c->moderasi_user_id);
				unset($c->moderasi_waktu);

				$c->lat = scrape_get_between($c->lokasi_koordinat, "{lat:", ",");
				$c->lng = scrape_get_between($c->lokasi_koordinat, "lng:", "}");

				if(!empty($c->foto))
				{
					$c->foto = base_url('uploads/' . $c->foto);
				}
				else
				{
					$c->foto = base_url('assets/default.png');					
				}

				$result[$c->kategori_id]['marker_path']	= 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png';					
				if(!empty($c->marker_path))
				{
					$result[$c->kategori_id]['marker_path']	= base_url('uploads/' . $c->marker_path);
				}

				$result[$c->kategori_id]['data'][] 			= $c;
				$result[$c->kategori_id]['jml_data']		= count($result[$c->kategori_id]['data']);
				$result[$c->kategori_id]['nama_kategori']	= strlen($c->nama_kategori) > 20 ? substr($c->nama_kategori, 0, 20) . '...' : $c->nama_kategori;
				$result[$c->kategori_id]['jenis']			= $c->jenis;
			}
			$respon = array('status' => '200', 'msg' => 'Data ditemukan', 'data' => $result, 'jumlah' => count($result));
		}
		else
		{
			$respon = array('status' => '201', 'msg' => 'Data Objek tidak ditemukan', 'data' => '', 'jumlah' => 0);
		}
		echo json_encode($respon);
	}

	function detail($id = '')
	{
		if(empty($id))
		{
			return '';
		}

		$filter	= array('objek_id' => $id);
		$data 	= $this->objek_model->get_data($filter)->row();

		if(empty($data))
		{
			return '';
		}

		unset($data->user_id);
		unset($data->moderasi_keterangan);
		unset($data->moderasi_user_id);
		unset($data->moderasi_waktu);

		if(!empty($data->foto))
		{
			$data->foto = base_url('uploads/' . $data->foto);			
		}
		else
		{
			$data->foto = base_url('assets/default.png');
		}

		$data->lat = scrape_get_between($data->lokasi_koordinat, "{lat:", ",");
		$data->lng = scrape_get_between($data->lokasi_koordinat, "lng:", "}");
		$data->terakhir_update = date('H:i:s d-m-Y', strtotime($data->terakhir_update));

		$objek_terdekat = $this->objek_model->get_objek_terdekat($id);

		$filter			= array('objek_id' => $id, 'limit'	=> 5);
		$data_artikel 	= $this->objek_model->get_data_artikel($filter)->result();
		$result_artikel = array();
		foreach($data_artikel as $key => $c)
		{
			unset($c->user_id);
			unset($c->moderasi_keterangan);
			unset($c->moderasi_user_id);
			unset($c->moderasi_waktu);
			$c->tgl_posting = date('H:i:s d-m-Y', strtotime($c->tgl_posting));
			$c->link 		= site_url('artikel/baca/' . $c->artikel_id . '-'  . $c->objek_id . '-' . $c->url_seo);

			if(!empty($c->foto))
			{
				$c->foto = base_url('uploads/' . $c->foto);			
			}
			else
			{
				$c->foto = base_url('assets/default.png');
			}
			$c->info_tiket = $c->info_tiket;
			$result_artikel[] = $c;
		}

		$filter	= array('objek_id' => $id, 'limit'	=> 3);
		$data_foto 		= $this->objek_model->get_data_foto($filter)->result();
		$result_foto 	= array();
		foreach($data_foto as $key => $c)
		{
			unset($c->user_id);
			unset($c->moderasi_keterangan);
			unset($c->moderasi_user_id);
			unset($c->moderasi_waktu);
			$c->nama 		= substr($c->nama, 0, 25);
			$c->tgl_upload 	= date('H:i:s d-m-Y', strtotime($c->tgl_upload));
			$c->link 		= site_url('galeri/lihat/' . $c->foto_id . '-' . $c->objek_id . '-'. $c->url_seo);

			if(!empty($c->foto))
			{
				$c->foto = base_url('uploads/galeri/' . $c->foto);			
			}
			else
			{
				$c->foto = base_url('assets/default.png');
			}
			$result_foto[] = $c;
		}

		//Tracking Visitor
		$param_visitor = array('objek_id'	=> $id,
							   'ip'			=> $this->input->ip_address(),
							   'waktu'		=> date('Y-m-d'),
						 	);
		$this->objek_model->tracking_visitor($param_visitor);
		//End Of Tracking Visitor

		$respon = array('status' 	=> '200', 
						'msg' 		=> 'Data ditemukan', 
						'data' 		=> $data,
						'artikel'	=> $result_artikel,
						'foto'		=> $result_foto,
						'terdekat'	=> $objek_terdekat);		
		echo json_encode($respon);
	}
}