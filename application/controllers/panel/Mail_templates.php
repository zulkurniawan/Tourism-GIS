<?php

class Mail_templates extends CI_Controller
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

		$this->load->model('panel/mail_templates_model');
		$this->page_active = 'konfigurasi';
		$this->sub_page_active = 'mail_templates';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword']);

		$param['data']			= $this->mail_templates_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->mail_templates_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/mail_templates/index', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/mail_templates/table';
		$param['page_active'] 	= $this->page_active;
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
			$param['data'] = $this->mail_templates_model->get_data_row($id);
		}

		$param['main_content']	= 'panel/mail_templates/form';
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
		$proses = $this->mail_templates_model->update($data_post, $id);
		if($proses)
		{
			$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
			redirect('panel/mail_templates');
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
			redirect('panel/mail_templates');
		}
	}

	public function upload_gambar_isi()
	{
		if(!empty($_FILES['file']['tmp_name']))
		{
			$config['upload_path']		= './uploads/';
            $config['allowed_types']	= 'gif|jpg|png';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file'))
            {
            	echo "Gagal memasukkan gambar.";
            }
            else
            {
            	$data_upload 			= $this->upload->data();
            	echo base_url('uploads/' . $data_upload['file_name']);
            }				
		}		
	}
}