<?php

class Konfigurasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/konfigurasi_model');
	}

	function index()
	{
		$data = $this->konfigurasi_model->get_data();
		if(!empty($data))
		{
			$result = array();
			foreach($data as $key => $c)
			{
				$result[$c->konfigurasi_id] = $c;
			}
			echo json_encode(array('status' => '200', 'data' => $result, 'msg' => 'Data Konfigurasi ditemukan'));
		}
		else
		{
			echo json_encode(array('status' => '201', 'data' => '', 'msg' => 'Data Konfigurasi tidak ditemukan'));			
		}
	}
}