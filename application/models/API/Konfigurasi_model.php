<?php

class Konfigurasi_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

		$cek_login = $this->session->userdata('login_status');
		if(empty($cek_login))
		{
			$this->load->helper('cookie');
			$data_cookie = get_cookie('kp_gis_remember_me');
			if(!empty($data_cookie))
			{
				$get_data_login = $this->get_login($data_cookie)->row();
				if(!empty($get_data_login))
				{
					$this->session->set_userdata('login_status', 'ok');
					$this->session->set_userdata('login_level', $get_data_login->level);
					$this->session->set_userdata('login_uid', $get_data_login->user_id);
				}
			}
		}

		$data = $this->get_data();
		foreach($data as $key => $c)
		{
			$this->config->set_item($c->konfigurasi_id, $c->isi);
		}
	}

	function get_data()
	{
		$this->db->from('konfigurasi');
		$query = $this->db->get();
		return $query->result();				
	}

	function get_login($email, $field = 'email')
	{
		$this->db->where($field, $email);
		$this->db->from('user');
		$query = $this->db->get();
		if(empty($query->row()))
		{
			if($field == 'email')
			{
				return $this->get_login($email, 'no_hp');
			}
		}
		return $query;
	}	
}