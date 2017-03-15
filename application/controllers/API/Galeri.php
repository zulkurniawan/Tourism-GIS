<?php

class Galeri extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/galeri_model');
	}


	function index($objek_id = array())
	{
		if(empty($objek_id))
		{
			show_404();
		}

		$keyword	= $this->input->get('q');
		$limit 		= $this->input->get('limit');
		$offset		= $this->input->get('offset');
		$id			= $this->input->get('id');		

		$filter		= array('objek_id' 	=> $objek_id, 
							'limit' 	=> $limit, 
							'offset' 	=> $offset,
							'keyword'	=> $keyword,							
							'id'		=> $id);
		$data		= $this->galeri_model->get_data($filter)->result();

		$this->load->model('API/objek_model');
		$data_objek = $this->objek_model->get_data(array('objek_id' => $objek_id))->row();
		if(!empty($data_objek->foto))
		{
			$data_objek->foto = base_url('uploads/' . $data_objek->foto);			
		}
		else
		{
			$data_objek->foto = base_url('assets/default.png');
		}

		unset($data_objek->moderasi_keterangan);
		unset($data_objek->moderasi_user_id);
		unset($data_objek->moderasi_waktu);
		unset($data_objek->user_id);		

		$objek_terdekat = $this->objek_model->get_objek_terdekat($objek_id);


		if(empty($data))
		{
			$respon 	= array('status' 			=> '201', 
								'msg' 				=> 'Galeri Kosong', 
								'data'				=> '', 
								'objek_wisata'		=> $data_objek,
								'jml_data' 			=> '',
								'objek_terdekat'	=> $objek_terdekat);
		}
		else
		{
			unset($filter['limit']);
			unset($filter['offset']);
			$jml_data 	= $this->galeri_model->get_data($filter)->num_rows();

			$result = array();
			foreach($data as $key => $c)
			{
				// unset($c->isi);
				unset($c->moderasi_keterangan);
				unset($c->moderasi_user_id);
				unset($c->moderasi_waktu);
				unset($c->user_id);
				
				$c->tgl_upload = date('H:i:s d-m-Y', strtotime($c->tgl_upload));
				if(!empty($c->foto))
				{
					$c->foto = base_url('uploads/galeri/' . $c->foto);			
				}
				else
				{
					$c->foto = base_url('assets/default.png');
				}

				$result[] = $c;
			}

			$respon 	= array('status' 			=> '200', 
								'msg' 				=> 'Data ditemukan', 
								'data'				=> $result, 
								'objek_wisata'		=> $data_objek,
								'jml_data' 			=> $jml_data,
								'objek_terdekat'	=> $objek_terdekat);			
		}
		echo json_encode($respon);
	}
}