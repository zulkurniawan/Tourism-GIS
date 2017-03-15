<?php

class Donasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/donasi_model');
	}

	function index()
	{
		$data = $this->donasi_model->get_data();
		if(!empty($data))
		{
			$result = array();
			foreach($data as $key => $c)
			{
				if(empty($c->gambar))
				{
					$c->gambar 	= base_url('assets/default.png');
				}
				else
				{
					$c->gambar 	= base_url('uploads/' . $c->gambar);
				}
				$result[] 	= $c;
			}
			echo json_encode(array('status' => '200', 'data' => $data, 'msg' => 'Data Konfigurasi ditemukan'));
		}
		else
		{
			echo json_encode(array('status' => '201', 'data' => '', 'msg' => 'Data Konfigurasi tidak ditemukan'));			
		}
	}
}