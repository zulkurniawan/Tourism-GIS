<?php

class Statistik_web extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status == 'ok')
		{
			if($this->login_level != 'Administrator' && $this->login_level != 'Partners')
			{
				show_404();
			}
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}

		$this->load->model('panel/statistik_web_model');
		$this->page_active = 'statistik_web';
	}


	public function index()
	{
		$param['awal']	= empty($this->input->get('awal')) ? '01-' . date('m-Y') : $this->input->get('awal');
		$param['akhir']	= empty($this->input->get('akhir')) ? date('d-m-Y') : $this->input->get('akhir');

		$filter = array('awal' => $param['awal'], 'akhir' => $param['akhir']);

		$param['data']	= $this->statistik_web_model->get_data($filter)->result();
		$param['main_content']	= 'panel/statistik_web/main';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}
}