<?php

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status == 'ok')
		{
			if($this->login_level != 'Administrator' && $this->login_level != 'Kontributor' && $this->login_level != 'Partners')
			{
				show_404();
			}
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}
		$this->page_active 		= 'dashboard';
		$this->load->model('panel/poin_model');
		$this->load->model('panel/dashboard_model');
	}

	function index()
	{
		if($this->login_level == 'Administrator')
		{
			$param['kontribusi_objek']	= $this->dashboard_model->get_total_kontribusi_objek();
			$param['pending_objek']		= $this->dashboard_model->get_total_pending_objek();
			$param['pending_foto']		= $this->dashboard_model->get_total_pending_foto();
			$param['pending_artikel']	= $this->dashboard_model->get_total_pending_artikel();

			$param['pending_akomodasi']	= $this->dashboard_model->get_total_pending_objek('akomodasi');
			$param['pending_foto_akomodasi']	= $this->dashboard_model->get_total_pending_foto('akomodasi');
			$param['pending_artikel_akomodasi']	= $this->dashboard_model->get_total_pending_artikel('akomodasi');

			$param['pending_user']		= $this->dashboard_model->get_total_pending_user('Moderasi');			
			$param['kontributor']		= $this->dashboard_model->get_total_pending_user('Aktif', 'Kontributor');
			$param['kontributor_terbaik']		= $this->poin_model->get_kontributor_terbaik(array('limit' => 10))->result();
		}
		elseif($this->login_level == 'Kontributor' || $this->login_level == 'Partners')
		{
			$param['kontribusi_objek']		= $this->dashboard_model->get_total_kontribusi_objek($this->login_uid);
			$param['kontribusi_foto']		= $this->dashboard_model->get_total_kontribusi_foto($this->login_uid);
			$param['kontribusi_artikel']	= $this->dashboard_model->get_total_kontribusi_artikel($this->login_uid);
			if($this->login_level == 'Kontributor')
			{
				$param['poin']					= $this->poin_model->hitung_poin($this->login_uid);		
				$param['kontributor_terbaik']	= $this->poin_model->get_kontributor_terbaik(array('limit' => 10))->result();
			}
			elseif($this->login_level == 'Partners')
			{
				$this->load->model('panel/statistik_objek_model');
				$param['objek_wisata_terbaik']	= $this->statistik_objek_model->get_data(array('limit'	=> 10))->result();
			}
		}
		// echo '<pre>';
		// print_r($param['objek_wisata_terbaik']);
		// exit;

		$param['main_content']		= 'panel/dashboard/list';
		$param['page_active'] 		= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}
}