<?php

class Galeri extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status == 'ok')
		{
			if($this->login_level != 'Administrator' && $this->login_level != 'Kontributor')
			{
				show_404();
			}
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}

		$this->load->model('panel/galeri_model');
		$this->page_active = 'galeri';
	}


	public function index()
	{
		$kategori 	= $this->uri->segment(4);
		$objek		= $this->uri->segment(5);

		if(empty($kategori))
		{
			$filter_user_id 	= '';
			if($this->login_level == 'Kontributor')
			{
				$filter_user_id = $this->login_uid;
			}

			$param['data'] 			= $this->galeri_model->get_kategori_objek_wisata($filter_user_id)->result();
			$param['main_content']	= 'panel/galeri/list_kategori';
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
			if($this->login_level == 'Kontributor')
			{
				$filter_user_id = $this->login_uid;
			}

			$param['nama_kategori']	= $nama_kategori;
			$param['data'] 			= $this->galeri_model->get_objek_wisata($id_kategori, $filter_user_id)->result();
			if(empty($param['data']))
			{
				// show_404();
			}
			$param['main_content']	= 'panel/galeri/list_objek';
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

			$param['main_content']	= 'panel/galeri/table';
		}

		$param['page_active'] 	= $this->page_active;
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
			if($this->login_level == 'Kontributor')
			{
				$filter['user_id'] = $this->login_uid;
			}				
			$param['data'] = $this->galeri_model->get_data_row($id, $filter);
			if(empty($param['data']))
			{
				show_404();
			}
		}

		$param['main_content']	= 'panel/galeri/form';
		$param['page_active']	= $this->page_active;
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
			redirect('panel/galeri/form/' . $kategori . '/' . $objek . '/' . $id);
		}
		else
		{
			$proses = $this->galeri_model->update($data_post, $id);
			if($proses)
			{
				$data_update['terakhir_update']	= date('Y-m-d H:i:s');
				if($this->login_level == 'Kontributor')
				{
					$data_update['status']		= 'Moderasi';
				}
				elseif($this->login_level == 'Administrator')
				{
					$data_update['status']		 = 'Publish';
				}
				$this->galeri_model->update($data_update, $id);

				$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
				redirect('panel/galeri/index/' . $kategori . '/' . $objek);
			}
			else
			{
				$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
				redirect('panel/galeri/index/' . $kategori . '/' . $objek);
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
		if($this->login_level == 'Kontributor')
		{
			$filter['user_id'] = $this->login_uid;
		}
		$param['data'] 	= $this->galeri_model->get_data_row($id, $filter);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['main_content']	= 'panel/galeri/detail';
		$param['page_active']	= $this->page_active;
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
		$data 	= $this->galeri_model->get_data_row($id);
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
				redirect('panel/galeri/detail/' . $kategori . '/' . $objek . '/' . $id);
				exit;
			}

			/* Poin */
			$poin = $this->input->post('poin');
			if(!empty($poin))
			{
				$this->load->model('panel/poin_model');
				$data_poin = array('user_id'	=> $data->user_id,
								   'jumlah'		=> $poin,
								   'jenis'		=> 'Foto',
								   'id'			=> $id,
								   'keterangan'	=> 'Poin untuk pulikasi foto "' . $data->nama . '"',
								   'tanggal'	=> date('Y-m-d H:i:s'));
				$this->poin_model->insert($data_poin);
				/* End Of Poin */

				//Mail User
				$param_mail_user = array(
										'mail_to'		=> $data->user_id,
										'template_id' 	=> 'verifikasi_foto_publish',
										'data' 			=> array('nama_kontributor' 	=> $data->nama_kontributor,
																 'nama'					=> $data->nama,
																 'objek_wisata'			=> $data->nama_objek_wisata,
																 'poin'					=> $poin)
								   	);
				send_mail($param_mail_user);
				//End Of Mail User

				//SMS User
				$param_sms_user = array('sms_to' 		=> $data->user_id, 
										'template_id' 	=> 'poin_kontribusi',
										'data'			=> array('nama_kontributor'	=> $data->nama_kontributor, 
																  'tanggal' 		=> date('d-m-Y'),
																  'poin'			=> $poin)
								  );
				send_sms($param_sms_user);							
				//End Of SMS User
			}

		}
		elseif($status == 'Draft')
		{
			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_foto_draft',
									'data' 			=> array('nama_kontributor' 	=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'objek_wisata'			=> $data->nama_objek_wisata,
															 'keterangan_moderasi'	=> $this->input->post('keterangan'))
							   	);
			send_mail($param_mail_user);
			//End Of Mail User

			//SMS User
			$param_sms_user = array('sms_to' 		=> $data->user_id, 
									'template_id' 	=> 'konten_draft',
									'data'			=> array('nama_kontributor'	=> $data->nama_kontributor, 
															  'jenis_konten' 	=> 'Foto')
							  );
			send_sms($param_sms_user);							
			//End Of SMS User
		}

		$data_update = array('status' 				=> $this->input->post('status'), 
							 'moderasi_keterangan' 	=> $this->input->post('keterangan'),
							 'moderasi_user_id'		=> $this->login_uid,
							 'moderasi_waktu'		=> date('Y-m-d H:i:s'));
		$this->galeri_model->update($data_update, $id);
		$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
		redirect('panel/galeri/detail/' . $kategori . '/' . $objek . '/' . $id);
	}
}
