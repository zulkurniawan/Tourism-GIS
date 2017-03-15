<?php

class Akomodasi_kategori extends CI_Controller
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

		$this->load->model('panel/akomodasi_kategori_model');
		$this->page_active 		= 'kategori';
		$this->sub_page_active 	= 'kategori_akomodasi';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword']);

		$param['data']			= $this->akomodasi_kategori_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->akomodasi_kategori_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/akomodasi_kategori/index', $total_rows, $limit, $uri_segment);

		$param['main_content']		= 'panel/akomodasi_kategori/table';
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
				$param['data'] = $this->akomodasi_kategori_model->get_data_row($id);
			}
		}

		$param['main_content']		= 'panel/akomodasi_kategori/form';
		$param['page_active']		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($id = '')
	{	
		$data_post = $this->input->post();
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/akomodasi_kategori/form/' . $id);
		}
		else
		{
			if(!empty($_FILES['userfiles']['tmp_name']))
			{
				$config['upload_path']          = './uploads/';
	            $config['allowed_types']        = 'gif|jpg|png';

	            $this->load->library('upload', $config);
	            if (!$this->upload->do_upload('userfiles'))
	            {
					$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
					$this->session->set_flashdata('last_data', $data_post);
					redirect('panel/akomodasi_kategori/form/' . $id);
	            }
	            else
	            {
	            	$data_upload 				= $this->upload->data();
	            	$data_post['marker_path']	= $data_upload['file_name'];
	            }				
			}

			if(empty($id))
			{
				$data_post['jenis'] = 'akomodasi';
				$proses = $this->akomodasi_kategori_model->insert($data_post);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/akomodasi_kategori');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));					
					redirect('panel/akomodasi_kategori/form/' . $id);
				}
			}
			else
			{
				$proses = $this->akomodasi_kategori_model->update($data_post, $id);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
					redirect('panel/akomodasi_kategori');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
					redirect('panel/akomodasi_kategori');
				}
			}
		}
	}

	public function hapus($id)
	{
		$proses = $this->akomodasi_kategori_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/akomodasi_kategori');
	}
}