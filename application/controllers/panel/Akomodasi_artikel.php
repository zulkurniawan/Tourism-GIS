<?php

class Akomodasi_artikel extends CI_Controller
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

		$this->load->model('panel/akomodasi_artikel_model');
		$this->page_active 		= 'akomodasi';
		$this->sub_page_active 	= 'akomodasi_artikel';
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

			$param['data'] 			= $this->akomodasi_artikel_model->get_kategori_objek_wisata($filter_user_id)->result();
			$param['main_content']	= 'panel/akomodasi_artikel/list_kategori';
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
			$param['data'] 			= $this->akomodasi_artikel_model->get_objek_wisata($id_kategori, $filter_user_id)->result();
			if(empty($param['data']))
			{
				// show_404();
			}
			$param['main_content']	= 'panel/akomodasi_artikel/list_objek';
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

			$param['status']	= $this->input->get('status');
			$param['keyword']	= $this->input->get('q');
			$limit 				= 20;
			$uri_segment		= 6;
			$filter = array('limit'		=> $limit, 
							'offset'	=> $this->uri->segment($uri_segment),
							'keyword'	=> $param['keyword'],
							'objek_id'	=> $id_objek,
							'status'	=> $param['status']);
	
			if($this->login_level == 'Kontributor')
			{
				$filter['user_id'] = $this->login_uid;
			}

			$param['data']			= $this->akomodasi_artikel_model->get_data($filter)->result();

			unset($filter['limit']);
			unset($filter['offset']);
			$total_rows 			= $this->akomodasi_artikel_model->get_data($filter)->num_rows();
			$param['pagination']	= paging('panel/akomodasi_artikel/index/' . $param['uri_kategori'] . '/' . $param['uri_objek'] . '/', $total_rows, $limit, $uri_segment);

			$param['main_content']	= 'panel/akomodasi_artikel/table';
		}

		$param['page_active'] 	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($kategori = '', $objek = '', $id = '')
	{
		if(empty($kategori) || empty($objek))
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

		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}
		else
		{
			if(!empty($id))
			{
				$filter = array();
				if($this->login_level == 'Kontributor')
				{
					$filter['user_id'] = $this->login_uid;
				}				
				$param['data'] = $this->akomodasi_artikel_model->get_data_row($id, $filter);
				if(empty($param['data']))
				{
					show_404();
				}
			}
		}

		$param['main_content']	= 'panel/akomodasi_artikel/form';
		$param['page_active']	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($kategori = '', $objek = '', $id = '')
	{	
		if(empty($kategori)|| empty($objek))
		{
			show_404();
		}
		$data_post = $this->input->post();
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('singkat', 'Sekilas', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/akomodasi_artikel/form/' . $kategori . '/' . $objek . '/' . $id);
		}
		else
		{
			$data_post['user_id'] 		= $this->login_uid;
			$data_post['tgl_posting'] 	= date('Y-m-d H:i:s');
			$data_post['url_seo'] 		= format_uri($data_post['judul']);

			if(!empty($_FILES['userfiles']['tmp_name']))
			{
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfiles'))
                {
					$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
					$this->session->set_flashdata('last_data', $data_post);
					redirect('panel/akomodasi_artikel/form/' . $kategori . '/' . $objek . '/' . $id);
                }
                else
                {
                	$data_upload 			= $this->upload->data();
                	$data_post['foto']		= $data_upload['file_name'];
                }				
			}			

			if(empty($id))
			{
				$objek_uri 				= $objek;
				$objek 					= explode('-', $objek);
				$data_post['objek_id']	= $objek[0];

				if($this->login_level == 'Partners')
				{
					$data_post['status']	= 'Moderasi';
				}
				elseif($this->login_level == 'Administrator')
				{
					$data_post['status']	= 'Publish';
				}

				$proses = $this->akomodasi_artikel_model->insert($data_post);
				if($proses)
				{
					//Mail
					if($this->login_level == 'Partners')
					{
						$id = $this->db->insert_id();
						$data_artikel = $this->akomodasi_artikel_model->get_data_row($id);

						//Mail User
						$param_mail_user = array(
												'mail_to'		=> $this->login_uid,
												'template_id' 	=> 'posting_artikel_akomodasi_notif_partners',
												'data' 			=> array('nama_partners'	=> $data_artikel->nama_kontributor,
																		 'judul'			=> $data_artikel->judul,
																		 'akomodasi'		=> $data_artikel->nama_objek_wisata,
																		 'tanggal'			=> date('d-m-Y H:i:s', strtotime($data_artikel->tgl_posting)))
										   	);
						send_mail($param_mail_user);
						//End Of Mail User

						//Mail Administrator
						$param_mail_user = array(
												'mail_to'		=> 'Administrator',
												'template_id' 	=> 'posting_artikel_akomodasi_notif_administrator',
												'data' 			=> array('nama_partners'	=> $data_artikel->nama_kontributor,
																		 'judul'			=> $data_artikel->judul,
																		 'akomodasi'		=> $data_artikel->nama_objek_wisata,
																		 'tanggal'			=> date('d-m-Y H:i:s', strtotime($data_artikel->tgl_posting)))
										   	);
						send_mail($param_mail_user);
						//End Of Mail Administrator						
					}
					// ENd Of Mail

					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/akomodasi_artikel/index/' . $kategori . '/' . $objek_uri);
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));				
					redirect('panel/akomodasi_artikel/form/' . $kategori . '/' . $objek . '/' . $id);
				}
			}
			else
			{
				if(!empty($data_post['foto']))
				{
					$data 	= $this->objek_model->get_data_row($id);
					if(!empty($data->foto))
					{
						unlink('./uploads/' . $data->foto);
					}						
				}
				$proses = $this->akomodasi_artikel_model->update($data_post, $id);
				if($proses)
				{
					$data_update['terakhir_update']	= date('Y-m-d H:i:s');
					if($this->login_level == 'Partners')
					{
						$data_update['status']		= 'Moderasi';
					}
					elseif($this->login_level == 'Administrator')
					{
						$data_update['status']		 = 'Publish';
					}
					$this->akomodasi_artikel_model->update($data_update, $id);

					$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
					redirect('panel/akomodasi_artikel/index/' . $kategori . '/' . $objek);
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
					redirect('panel/akomodasi_artikel/form/' . $kategori . '/' . $objek . '/' . $id);
				}
			}
		}
	}

	public function hapus($kategori = '', $objek = '', $id = '')
	{
		if(empty($kategori) || empty($objek) || empty($id))
		{
			show_404();
		}

		$filter = array();
		if($this->login_level == 'Partners')
		{
			$filter['user_id'] = $this->login_uid;
		}
		$data 	= $this->akomodasi_artikel_model->get_data_row($id, $filter);
		if(empty($data))
		{
			show_404();
		}
		if(!empty($data->foto))
		{
			unlink('./uploads/' . $data->foto);
		}						


		$proses = $this->akomodasi_artikel_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/akomodasi_artikel/index/' . $kategori . '/' . $objek);
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
		$param['data'] 	= $this->akomodasi_artikel_model->get_data_row($id, $filter);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['main_content']	= 'panel/akomodasi_artikel/detail';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active']	= $this->sub_page_active;
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
		
		$data 	= $this->akomodasi_artikel_model->get_data_row($id);
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
				redirect('panel/akomodasi_artikel/detail/' . $kategori . '/' . $objek . '/' . $id);
				exit;
			}

			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_artikel_akomodasi_publish',
									'data' 			=> array('nama_partners' 		=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'akomodasi'			=> $data->nama_objek_wisata,
															 'poin'					=> $poin)
							   	);
			send_mail($param_mail_user);
			//End Of Mail User
		}
		elseif($status == 'Draft')
		{
			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_artikel_akomodasi_draft',
									'data' 			=> array('nama_partners' 		=> $data->nama_kontributor,
															 'judul'				=> $data->judul,
															 'akomodasi'			=> $data->nama_objek_wisata,
															 'keterangan_moderasi'	=> $this->input->post('keterangan'))
							   	);
			send_mail($param_mail_user);
			//End Of Mail User
		}

		$data_update = array('status' 				=> $this->input->post('status'), 
							 'moderasi_keterangan' 	=> $this->input->post('keterangan'),
							 'moderasi_user_id'		=> $this->login_uid,
							 'moderasi_waktu'		=> date('Y-m-d H:i:s'));
		$this->akomodasi_artikel_model->update($data_update, $id);
		$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
		redirect('panel/akomodasi_artikel/detail/' . $kategori . '/' . $objek . '/' . $id);
	}
}
