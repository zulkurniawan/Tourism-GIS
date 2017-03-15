<?php

class Statistik_akomodasi extends CI_Controller
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

		$this->load->model('panel/statistik_akomodasi_model');
		$this->load->model('panel/akomodasi_objek_model');
		$this->page_active = 'statistik_akomodasi';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$param['kategori']	= $this->input->get('kategori');

		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword'],
						'kategori'	=> $param['kategori']);

		$param['data']	= $this->statistik_akomodasi_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->statistik_akomodasi_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/statistik_akomodasi/index', $total_rows, $limit, $uri_segment);

		$param['populer']		= $this->statistik_akomodasi_model->get_data(array('limit' => 10))->result();

		$param['opt_kategori']	= $this->akomodasi_objek_model->get_opt_kategori(true);
		$param['main_content']	= 'panel/statistik_akomodasi/main';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function detail($objek_id = '')
	{
		if(empty($objek_id))
		{
			show_404();
		}
		$jml_hari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

		$param['tgl_mulai']		= $this->input->get('mulai');
		if(empty($param['tgl_mulai']))
		{
			$param['tgl_mulai']		= date('01-m-Y');
		}

		$param['tgl_selesai']		= $this->input->get('sampai');
		{
			$jml_hari = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($param['tgl_mulai'])), date('Y', strtotime($param['tgl_mulai'])));
			$param['tgl_selesai']	= date('d-m-Y');
		}
		$param['list_tanggal']		= tanggal_antara(date('Y-m-d', strtotime($param['tgl_mulai'])), date('Y-m-d', strtotime($param['tgl_selesai'])));

		$param['data_view_objek']			= $this->statistik_akomodasi_model->get_data_view_objek($objek_id, $param);
		$param['data_view_unik_visitor']	= $this->statistik_akomodasi_model->get_data_unik_visitor($objek_id, $param);
		$param['data_objek']				= $this->statistik_akomodasi_model->get_data_row($objek_id);
		// echo '<pre>';
		// print_r($param['data_objek']);
		// exit;

		$param['main_content']	= 'panel/statistik_akomodasi/detail';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);		
	}
}