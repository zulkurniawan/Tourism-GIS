<?php

class Akomodasi_objek extends CI_Controller
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

		$this->load->model('panel/akomodasi_objek_model');
		$this->page_active 		= 'akomodasi';
		$this->sub_page_active 	= 'akomodasi_objek';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$param['status']	= $this->input->get('status');
		$param['kategori']	= $this->input->get('kategori');

		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword'],
						'status'	=> $param['status'],
						'kategori'	=> $param['kategori']);

		if($this->login_level == 'Partners')
		{
			// $filter['user_id'] = $this->login_uid;
			$param['user_id'] = $this->login_uid;
		}

		$param['data']			= $this->akomodasi_objek_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->akomodasi_objek_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/akomodasi_objek/index', $total_rows, $limit, $uri_segment);

		$param['opt_kategori']	= $this->akomodasi_objek_model->get_opt_kategori(true);
		$param['main_content']	= 'panel/akomodasi_objek/table';
		$param['page_active'] 	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($id = '')
	{
		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;

		$param['opt_kategori']	= $this->akomodasi_objek_model->get_opt_kategori();
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
					// $filter['user_id'] = $this->login_uid;
				}
				$param['data'] = $this->akomodasi_objek_model->get_data_row($id, $filter);
				if(empty($param['data']))
				{
					show_404();
				}
			}
		}

		// echo '<pre>';
		// echo $this->login_uid;
		// print_r($param['data']);
		// exit;

		$param['main_content']	= 'panel/akomodasi_objek/form';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($id = '')
	{	
		$data_post = $this->input->post();
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
		$this->form_validation->set_rules('lokasi_koordinat', 'Koordinat', 'required');
		$this->form_validation->set_rules('lokasi_desa', 'Desa', 'required');
		$this->form_validation->set_rules('lokasi_kecamatan', 'Kecamatan', 'required');
		$this->form_validation->set_rules('lokasi_kabupaten_kota', 'Kabupaten / Kota', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/akomodasi_objek/form/' . $id);
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
					redirect('panel/akomodasi_objek/form/' . $id);
                }
                else
                {
                	$data_upload 			= $this->upload->data();
                	$data_post['foto']		= $data_upload['file_name'];
                }				
			}

			$data_post['user_id'] 		 = $this->login_uid;
			$data_post['info_deskripsi'] = $this->input->post('info_deskripsi', false);
			$data_post['url_seo'] 		= format_uri($data_post['nama']);
			if(empty($id))
			{
				if($this->login_level == 'Partners')
				{
					$data_post['status']	= 'Moderasi';
				}
				elseif($this->login_level == 'Administrator')
				{
					$data_post['status']		 = 'Publish';
				}
				$data_post['terakhir_update'] = date('Y-m-d H::s');
				$proses = $this->akomodasi_objek_model->insert($data_post);
				if($proses)
				{
					//Mail
					if($this->login_level == 'Partners')
					{
						$id = $this->db->insert_id();
						$data_objek = $this->akomodasi_objek_model->get_data_row($id);

						//Mail User
						$param_mail_user = array(
												'mail_to'		=> $this->login_uid,
												'template_id' 	=> 'posting_akomodasi_notif_partners',
												'data' 			=> array('nama_partners' => $data_objek->nama_kontributor,
																		 'nama'				=> $data_objek->nama,
																		 'tanggal'			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail User

						//Mail Administrator
						$param_mail_user = array(
												'mail_to'		=> 'Administrator',
												'template_id' 	=> 'posting_akomodasi_notif_administrator',
												'data' 			=> array('nama_partners' => $data_objek->nama_kontributor,
																		 'nama'				=> $data_objek->nama,
																		 'tanggal'			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail Administrator						
					}
					// ENd Of Mail

					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/akomodasi_objek');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));					
					redirect('panel/akomodasi_objek/form/' . $id);
				}
			}
			else
			{
				$data 	= $this->akomodasi_objek_model->get_data_row($id);
				if(empty($data))
				{
					show_404();
				}
				if($data->user_id != $data_post['user_id'])
				{
					$data_post['terakhir_update'] 	= date('Y-m-d H::s');
					$data_post['status']			= 'Moderasi';
					$data_post['duplikat_dari_id']	= $data->objek_id;
					$proses = $this->akomodasi_objek_model->insert($data_post);
					if($proses)
					{
						//Mail
						if($this->login_level == 'Partners')
						{
							$id = $this->db->insert_id();
							$data_objek = $this->akomodasi_objek_model->get_data_row($id);

							//Mail User
							$param_mail_user = array(
													'mail_to'		=> $this->login_uid,
													'template_id' 	=> 'posting_akomodasi_notif_partners',
													'data' 			=> array('nama_partners' 	=> $data_objek->nama_kontributor,
																			 'nama'				=> $data_objek->nama,
																			 'tanggal'			=> date('d-m-Y H:i:s'))
											   	);
							send_mail($param_mail_user);
							//End Of Mail User

							//Mail Administrator
							$param_mail_user = array(
													'mail_to'		=> 'Administrator',
													'template_id' 	=> 'posting_akomodasi_notif_administrator',
													'data' 			=> array('nama_partners' 	=> $data_objek->nama_kontributor,
																			 'nama'				=> $data_objek->nama,
																			 'tanggal'			=> date('d-m-Y H:i:s'))
											   	);
							send_mail($param_mail_user);
							//End Of Mail Administrator						
						}
						// ENd Of Mail

						$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan dan akan melakukan moderasi.'));
						redirect('panel/akomodasi_objek');
					}				
					else
					{
						$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));
						redirect('panel/akomodasi_objek/' . $id);						
					}
				}
				else
				{
					if(!empty($data_post['foto']))
					{
						if(!empty($data->foto))
						{
							unlink('./uploads/' . $data->foto);
						}						
					}
					$proses = $this->akomodasi_objek_model->update($data_post, $id);
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
						$this->akomodasi_objek_model->update($data_update, $id);

						$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
						redirect('panel/akomodasi_objek');
					}
					else
					{
						$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
						redirect('panel/akomodasi_objek');
					}						
				}
			}
		}
	}

	public function upload_gambar_deskripsi()
	{
		if(!empty($_FILES['file']['tmp_name']))
		{
			$config['upload_path']		= './uploads/';
            $config['allowed_types']	= 'gif|jpg|png';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file'))
            {
            	echo "Gagal memasukkan gambar.";
				// $this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
				// $this->session->set_flashdata('last_data', $data_post);
				// redirect('panel/akomodasi_objek/form/' . $id);
            }
            else
            {
            	$data_upload 			= $this->upload->data();
            	echo base_url('uploads/' . $data_upload['file_name']);
            }				
		}		
	}

	public function hapus($id = '')
	{
		if(empty($id))
		{
			show_404();
		}
		$filter = array();
		if($this->login_level == 'Partners')
		{
			$filter['user_id'] = $this->login_uid;
		}
		$data 	= $this->akomodasi_objek_model->get_data_row($id, $filter);
		if(empty($data))
		{
			show_404();
		}
		if(!empty($data->foto))
		{
			unlink('./uploads/' . $data->foto);
		}						
		$proses = $this->akomodasi_objek_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/akomodasi_objek');
	}

	public function detail($id = '')
	{
		if(empty($id))
		{
			show_404();
		}
		$filter = array();
		if($this->login_level == 'Partners')
		{
			// $filter['user_id'] = $this->login_uid;
		}
		$param['data'] 	= $this->akomodasi_objek_model->get_data_row($id, $filter);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['main_content']	= 'panel/akomodasi_objek/detail';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);				
	}

	public function set_status($id = '')
	{
		if(empty($id))
		{
			show_404();
		}
		if($this->login_level != 'Administrator')
		{
			show_404();
		}
		$data 	= $this->akomodasi_objek_model->get_data_row($id);
		if(empty($data))
		{
			show_404();
		}		

		$akomodasi_maks_waktu_tayang = $this->input->post('akomodasi_maks_waktu_tayang');
		if(!empty($akomodasi_maks_waktu_tayang))
		{
			$tgl_baru = date('Y-m-d H:i:00', strtotime($akomodasi_maks_waktu_tayang));
		}

		$status = $this->input->post('status');
		if($status == 'Publish')
		{
			if($data->status == 'Publish' && $tgl_baru == $data->akomodasi_maks_waktu_tayang)
			{
				$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
				redirect('panel/akomodasi_objek/detail/' . $id);
				exit;
			}

			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_objek_publish',
									'data' 			=> array('nama_kontributor' 	=> $data->nama_kontributor,
															 'nama'					=> $data->nama)
							   	);
			send_mail($param_mail_user);
			//End Of Mail User

			if(!empty($data->duplikat_dari_id))
			{
				$id_target = $data->duplikat_dari_id;

				$data_update = array('status' 					=> $this->input->post('status'), 
									 'moderasi_keterangan' 		=> $this->input->post('keterangan'),
									 'moderasi_user_id'			=> $this->login_uid,
									 'moderasi_waktu'			=> date('Y-m-d H:i:s'));

				unset($data->nama_kategori);
				unset($data->nama_kontributor);
				unset($data->nama_moderator);
				unset($data->objek_id);
				unset($data->status);
				foreach($data as $key => $c)
				{
					if($key == 'duplikat_dari_id' || $key == 'url_seo')
					{
						continue;
					}

					$data_update[$key] = $c;
				}			
				$this->akomodasi_objek_model->update($data_update, $id_target);
				$this->akomodasi_objek_model->delete($id);

				$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
				redirect('panel/akomodasi_objek/detail/' . $id_target);
				exit;
			}
		}
		elseif($status == 'Draft')
		{
			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_akomodasi_draft',
									'data' 			=> array('nama_partners' 		=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'keterangan_moderasi'	=> $this->input->post('keterangan'))
							   	);
			send_mail($param_mail_user);
			//End Of Mail User
		}

		$data_update = array('status' 				=> $this->input->post('status'), 
							 'moderasi_keterangan' 	=> $this->input->post('keterangan'),
							 'moderasi_user_id'		=> $this->login_uid,
							 'moderasi_waktu'		=> date('Y-m-d H:i:s'));

		if(!empty($akomodasi_maks_waktu_tayang))
		{
			$data_update['akomodasi_maks_waktu_tayang'] = date('Y-m-d H:i', strtotime($akomodasi_maks_waktu_tayang));
		}
		else
		{
			$data_update['akomodasi_maks_waktu_tayang'] = NULL;
		}

		$this->akomodasi_objek_model->update($data_update, $id);
		$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
		redirect('panel/akomodasi_objek/detail/' . $id);
	}

}