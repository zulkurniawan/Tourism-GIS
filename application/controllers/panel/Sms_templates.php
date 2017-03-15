<?php

class Sms_templates extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status == 'ok')
		{
			if($this->login_level != 'Administrator')
			{
				show_404();
			}
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}

		$this->load->model('panel/sms_templates_model');
		$this->page_active = 'konfigurasi';
		$this->sub_page_active = 'sms_templates';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword']);

		$param['data']			= $this->sms_templates_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->sms_templates_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/sms_templates/index', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/sms_templates/table';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($id = '')
	{
		if(empty($id))
		{
			show_404();
		}

		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;

		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}
		else
		{
			$param['data'] = $this->sms_templates_model->get_data_row($id);
		}

		$param['main_content']	= 'panel/sms_templates/form';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($id = '')
	{	
		if(empty($id))
		{
			show_404();
		}
		$data_post = $this->input->post();
		$data_post['terakhir_update'] = date('Y-m-d H:i:s');
		$proses = $this->sms_templates_model->update($data_post, $id);
		if($proses)
		{
			$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
			redirect('panel/sms_templates');
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
			redirect('panel/sms_templates');
		}
	}
}