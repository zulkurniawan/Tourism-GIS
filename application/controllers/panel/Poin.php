<?php

class Poin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status != 'ok')
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}
		$this->load->model('panel/poin_model');
		$this->page_active 		= 'poin';
	}

	function index()
	{
		if($this->login_level != 'Kontributor')
		{
			show_404();
		}

		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'user_id'	=> $this->login_uid);

		$param['poin']	= $this->poin_model->hitung_poin($this->login_uid);
		$param['data']	= $this->poin_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->poin_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/poin/index', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/poin/table';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);	
	}

	function top()
	{
		// if($this->login_level != 'Administrator' && $this->login_level != 'Partners')
		// {
		// 	show_404();
		// }

		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment));

		$param['data']	= $this->poin_model->get_kontributor_terbaik($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->poin_model->get_kontributor_terbaik($filter)->num_rows();
		$param['pagination']	= paging('panel/poin/top', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/poin/table_top_kontributor';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);			
	}

	function log_detail()
	{
		if($this->login_level != 'Administrator' && $this->login_level != 'Partners')
		{
			show_404();
		}
		$uid 			= $this->uri->segment(4);
		$limit 			= 20;
		$uri_segment	= 5;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'user_id'	=> $uid);

		$this->load->model('panel/user_model');
		$param['user']		= $this->user_model->get_data_row($uid);

		$param['poin']		= $this->poin_model->hitung_poin($uid);
		$param['data']		= $this->poin_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->poin_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/poin/log_detail/' . $uid, $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/poin/log_detail';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);	
	}	
}
