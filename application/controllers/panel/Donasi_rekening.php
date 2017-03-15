<?php

class Donasi_rekening extends CI_Controller
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

		$this->load->model('panel/donasi_rekening_model');
		$this->page_active 		= 'donasi';
		$this->sub_page_active 	= 'donasi_rekening';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword']);

		$param['data']			= $this->donasi_rekening_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->donasi_rekening_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/donasi_rekening/index', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/donasi_rekening/table';
		$param['page_active'] 		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($id = '')
	{
		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;

		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}
		else
		{
			if(!empty($id))
			{
				$param['data'] = $this->donasi_rekening_model->get_data_row($id);
			}
		}

		$param['opt_bank']			= $this->donasi_rekening_model->get_opt_bank();
		$param['main_content']		= 'panel/donasi_rekening/form';
		$param['page_active']		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($id = '')
	{	
		$data_post = $this->input->post();
		$this->form_validation->set_rules('bank_id', 'Bank', 'required');
		if(empty($id))
		{
			$this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'required|is_unique[donasi_rekening.nomor_rekening]');
		}
		$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/donasi_rekening/form/' . $id);
		}
		else
		{
			if(empty($id))
			{
				$proses = $this->donasi_rekening_model->insert($data_post);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/donasi_rekening');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));					
					redirect('panel/donasi_rekening/form/' . $id);
				}
			}
			else
			{
				$proses = $this->donasi_rekening_model->update($data_post, $id);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
					redirect('panel/donasi_rekening');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
					redirect('panel/donasi_rekening');
				}
			}
		}
	}

	public function hapus($id)
	{
		$proses = $this->donasi_rekening_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/donasi_rekening');
	}
}