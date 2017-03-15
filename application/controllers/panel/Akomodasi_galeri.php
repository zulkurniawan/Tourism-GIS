<?php

class Akomodasi_galeri extends CI_Controller
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

		$this->load->model('panel/akomodasi_galeri_model');
		$this->page_active 		= 'akomodasi';
		$this->sub_page_active 	= 'akomodasi_galeri';
	}


	public function index()
	{
		$kategori 	= $this->uri->segment(4);
		$objek		= $this->uri->segment(5);

		if(empty($kategori))
		{
			$filter_user_id 	= '';
			if($this->login_level == 'Partners')
			{
				$filter_user_id = $this->login_uid;
			}

			$param['data'] 			= $this->akomodasi_galeri_model->get_kategori_objek_wisata($filter_user_id)->result();
			$param['main_content']	= 'panel/akomodasi_galeri/list_kategori';
		}
		elseif(empty($objek))
		{
			$param['uri_kategori']	= $kategori;
			$kategori 				= explode('-', $kategori);
			$id_kategori			= $kategori[0];
			$nama_kategori			= '';
			for($i = 1; $i <= count($kategori); $i++)
			{
				$nama_kategori .= @$kategori[$i] . ' ';
			}

			$filter_user_id 	= '';
			if($this->login_level == 'Partners')
			{
				$filter_user_id = $this->login_uid;
			}

			$param['nama_kategori']	= $nama_kategori;
			$param['data'] 			= $this->akomodasi_galeri_model->get_objek_wisata($id_kategori, $filter_user_id)->result();
			if(empty($param['data']))
			{
				// show_404();
			}
			$param['main_content']	= 'panel/akomodasi_galeri/list_objek';
		}
		else
		{
			$param['uri_kategori']	= $kategori;
			$param['uri_objek']		= $objek;
			$objek 					= explode('-', $objek);
			$id_objek				= $objek[0];
			$nama_objek				= '';
			for($i = 1; $i <= count($objek); $i++)
			{
				$nama_objek .= @$objek[$i] . ' ';
			}
			$param['nama_objek']	= $nama_objek;

			$param['main_content']	= 'panel/akomodasi_galeri/table';
		}

		$param['page_active'] 		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($kategori = '', $objek = '', $id = '')
	{
		if(empty($kategori) || empty($objek) || empty($id))
		{
			show_404();
		}
		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;
		$param['uri_kategori']	= $kategori;
		$param['uri_objek']		= $objek;
		$objek 					= explode('-', $objek);
		$id_objek				= $objek[0];
		$nama_objek				= '';
		for($i = 1; $i <= count($objek); $i++)
		{
			$nama_objek .= @$objek[$i] . ' ';
		}
		$param['nama_objek']	= $nama_objek;

		if(!empty($id))
		{
			$filter = array();
			if($this->login_level == 'Partners')
			{
				$filter['user_id'] = $this->login_uid;
			}				
			$param['data'] = $this->akomodasi_galeri_model->get_data_row($id, $filter);
			if(empty($param['data']))
			{
				show_404();
			}
		}

		$param['main_content']		= 'panel/akomodasi_galeri/form';
		$param['page_active'] 		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($kategori = '', $objek = '', $id = '')
	{	
		if(empty($kategori)|| empty($objek) || empty($id))
		{
			show_404();
		}
		$data_post = $this->input->post();
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/akomodasi_galeri/form/' . $kategori . '/' . $objek . '/' . $id);
		}
		else
		{
			$proses = $this->akomodasi_galeri_model->update($data_post, $id);
			if($proses)
			{
				$data_update['terakhir_update']	= date('Y-m-d H:i:s');
				if($this->login_level == 'Kontributor')
				{
					$data_update['status']		= 'Partners';
				}
				elseif($this->login_level == 'Administrator')
				{
					$data_update['status']		 = 'Publish';
				}
				$this->akomodasi_galeri_model->update($data_update, $id);

				$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
				redirect('panel/akomodasi_galeri/index/' . $kategori . '/' . $objek);
			}
			else
			{
				$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
				redirect('panel/akomodasi_galeri/index/' . $kategori . '/' . $objek);
			}
		}
	}

	public function detail($kategori = '', $objek = '', $id = '')
	{
		if(empty($kategori) || empty($objek) || empty($id))
		{
			show_404();
		}

		$param['uri_kategori']	= $kategori;
		$param['uri_objek']		= $objek;


		$filter = array();
		if($this->login_level == 'Partners')
		{
			$filter['user_id'] = $this->login_uid;
		}
		$param['data'] 	= $this->akomodasi_galeri_model->get_data_row($id, $filter);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['main_content']		= 'panel/akomodasi_galeri/detail';
		$param['page_active'] 		= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);	
	}

	public function set_status($kategori = '', $objek = '', $id = '')
	{
		if(empty($kategori) || empty($objek) || empty($id))
		{
			show_404();
		}
		if($this->login_level != 'Administrator')
		{
			show_404();
		}		
		$data 	= $this->akomodasi_galeri_model->get_data_row($id);
		if(empty($data))
		{
			show_404();
		}		

		$status = $this->input->post('status');
		if($status == 'Publish')
		{		
			if($data->status == 'Publish')
			{
				$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
				redirect('panel/akomodasi_galeri/detail/' . $kategori . '/' . $objek . '/' . $id);
				exit;
			}

			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_foto_akomodasi_publish',
									'data' 			=> array('nama_partners' 		=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'objek_wisata'			=> $data->nama_objek_wisata)
							   	);
			send_mail($param_mail_user);
			//End Of Mail User

		}
		elseif($status == 'Draft')
		{
			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_foto_akomodasi_draft',
									'data' 			=> array('nama_partners' 		=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'objek_wisata'			=> $data->nama_objek_wisata,
															 'keterangan_moderasi'	=> $this->input->post('keterangan'))
							   	);
			send_mail($param_mail_user);
			//End Of Mail User
		}

		$data_update = array('status' 				=> $this->input->post('status'), 
							 'moderasi_keterangan' 	=> $this->input->post('keterangan'),
							 'moderasi_user_id'		=> $this->login_uid,
							 'moderasi_waktu'		=> date('Y-m-d H:i:s'));
		$this->akomodasi_galeri_model->update($data_update, $id);
		$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
		redirect('panel/akomodasi_galeri/detail/' . $kategori . '/' . $objek . '/' . $id);
	}
}
