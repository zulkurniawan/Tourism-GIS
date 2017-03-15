<?php

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/user_model');
	}

	function get_user_profil($user_id)
	{
		$data = $this->user_model->get_user_profil($user_id);
		if(!empty($data))
		{
			echo json_encode(array('status' => '200', 'data' => $data, 'msg' => 'Data Profil ditemukan'));
		}
		else
		{
			echo json_encode(array('status' => '201', 'data' => '', 'msg' => 'Data Profil tidak ditemukan'));			
		}
	}

	function get_user_kontributor()
	{
		$data = $this->user_model->get_kontributor();
		if(!empty($data))
		{
			$result = array();
			foreach ($data as $key => $c) 
			{
				$c->profil 	= site_url('user/profil') . '/' . format_uri($c->user_id . '-' . $c->nama);
				$c->foto 	= load_foto_user($c->foto);

				unset($c->terakhir_login);
				unset($c->level);
				unset($c->user_id);
				unset($c->email);
				unset($c->password);
				$result[] 	= $c;
			}
			echo json_encode(array('status' => '200', 'data' => $data, 'msg' => 'Data Kontributor ditemukan'));
		}
		else
		{
			echo json_encode(array('status' => '201', 'data' => '', 'msg' => 'Data Kontributor tidak ditemukan'));			
		}		
	}
}