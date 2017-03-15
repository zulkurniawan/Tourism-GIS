<?php

class Web_visitor_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

		$login_status 	 = $this->session->userdata('login_status');
		if(!empty($login_status))
		{
			return true;
		}

		$tracking_status = $this->session->userdata('tracking_status');

		if(empty($tracking_status))
		{
			$param = array('ip' 	=> $this->input->ip_address(),
						   'hari'	=> date('w'),
						   'waktu'	=> date('Y-m-d'));

			$cek_waktu = $this->cek_waktu($param['ip'], $param['waktu'])->row();
			if(empty($cek_waktu))
			{
				$cek_unik = $this->cek_unik($param['ip'])->row();
				if(empty($cek_unik))
				{
					$param['unik'] = 'Y';
				}
				else
				{
					$param['unik'] = 'N';					
				}
				$this->insert($param);
				$this->session->set_userdata('tracking_status', 'OK');
			}			
		}
	}

	function insert($param)
	{
		$this->db->insert('web_visitor', $param);
	}

	function cek_unik($ip)
	{
		$this->db->limit(1);
		$this->db->where('unik', 'Y');
		$this->db->where('ip', $ip);
		$query = $this->db->get('web_visitor');
		return $query;
	}

	function cek_waktu($ip, $waktu)
	{
		$this->db->limit(1);
		$this->db->where('waktu', $waktu);
		$this->db->where('ip', $ip);
		$query = $this->db->get('web_visitor');
		return $query;		
	}
}