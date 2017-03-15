<?php

class Objek extends CI_Controller
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

		$this->load->model('panel/objek_model');
		$this->page_active = 'objek';
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

		if($this->login_level == 'Kontributor')
		{
			// $filter['user_id'] = $this->login_uid;
			$param['user_id'] = $this->login_uid;
		}

		$param['data']			= $this->objek_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->objek_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/objek/index', $total_rows, $limit, $uri_segment);

		$param['opt_kategori']	= $this->objek_model->get_opt_kategori(true);
		$param['main_content']	= 'panel/objek/table';
		$param['page_active'] 	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($id = '')
	{
		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;

		$param['opt_kategori']	= $this->objek_model->get_opt_kategori();
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
				$param['data'] = $this->objek_model->get_data_row($id, $filter);
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

		$param['main_content']	= 'panel/objek/form';
		$param['page_active']	= $this->page_active;
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
			redirect('panel/objek/form/' . $id);
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
					redirect('panel/objek/form/' . $id);
                }
                else
                {
                	$data_upload 			= $this->upload->data();
                	$data_post['foto']		= $data_upload['file_name'];
                }				
			}

			if(!empty($data_post['street_view_url']))
			{
				$data_post['street_view_url'] = scrape_get_between($data_post['street_view_url'], 'src="', '"');
			}
			$data_post['user_id'] 		 = $this->login_uid;
			$data_post['info_deskripsi'] = $this->input->post('info_deskripsi', false);
			$data_post['url_seo'] 		= format_uri($data_post['nama']);
			if(empty($id))
			{
				if($this->login_level == 'Kontributor')
				{
					$data_post['status']	= 'Moderasi';
				}
				elseif($this->login_level == 'Administrator')
				{
					$data_post['status']		 = 'Publish';
				}
				$data_post['terakhir_update'] = date('Y-m-d H::s');
				$proses = $this->objek_model->insert($data_post);
				if($proses)
				{
					//Mail
					if($this->login_level == 'Kontributor')
					{
						$id = $this->db->insert_id();
						$data_objek = $this->objek_model->get_data_row($id);

						//Mail User
						$param_mail_user = array(
												'mail_to'		=> $this->login_uid,
												'template_id' 	=> 'posting_objek_notif_kontributor',
												'data' 			=> array('nama_kontributor' => $data_objek->nama_kontributor,
																		 'nama'				=> $data_objek->nama,
																		 'tanggal'			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail User

						//Mail Administrator
						$param_mail_user = array(
												'mail_to'		=> 'Administrator',
												'template_id' 	=> 'posting_objek_notif_administrator',
												'data' 			=> array('nama_kontributor' => $data_objek->nama_kontributor,
																		 'nama'				=> $data_objek->nama,
																		 'tanggal'			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail Administrator						
					}
					// ENd Of Mail

					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/objek');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));					
					redirect('panel/objek/form/' . $id);
				}
			}
			else
			{
				$data 	= $this->objek_model->get_data_row($id);
				if(empty($data))
				{
					show_404();
				}
				if($data->user_id != $data_post['user_id'] && $this->login_level == 'Kontributor')
				{
					$data_post['terakhir_update'] 	= date('Y-m-d H::s');
					$data_post['status']			= 'Moderasi';
					$data_post['duplikat_dari_id']	= $data->objek_id;
					$proses = $this->objek_model->insert($data_post);
					if($proses)
					{
						//Mail
						if($this->login_level == 'Kontributor')
						{
							$id = $this->db->insert_id();
							$data_objek = $this->objek_model->get_data_row($id);

							//Mail User
							$param_mail_user = array(
													'mail_to'		=> $this->login_uid,
													'template_id' 	=> 'posting_objek_notif_kontributor',
													'data' 			=> array('nama_kontributor' => $data_objek->nama_kontributor,
																			 'nama'				=> $data_objek->nama,
																			 'tanggal'			=> date('d-m-Y H:i:s'))
											   	);
							send_mail($param_mail_user);
							//End Of Mail User

							//Mail Administrator
							$param_mail_user = array(
													'mail_to'		=> 'Administrator',
													'template_id' 	=> 'posting_objek_notif_administrator',
													'data' 			=> array('nama_kontributor' => $data_objek->nama_kontributor,
																			 'nama'				=> $data_objek->nama,
																			 'tanggal'			=> date('d-m-Y H:i:s'))
											   	);
							send_mail($param_mail_user);
							//End Of Mail Administrator						
						}
						// ENd Of Mail

						$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan dan akan melakukan moderasi.'));
						redirect('panel/objek');
					}				
					else
					{
						$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));
						redirect('panel/objek/' . $id);						
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
					$proses = $this->objek_model->update($data_post, $id);
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
						$this->objek_model->update($data_update, $id);

						$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
						redirect('panel/objek');
					}
					else
					{
						$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
						redirect('panel/objek');
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
				// redirect('panel/objek/form/' . $id);
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
		if($this->login_level == 'Kontributor')
		{
			$filter['user_id'] = $this->login_uid;
		}
		$data 	= $this->objek_model->get_data_row($id, $filter);
		if(empty($data))
		{
			show_404();
		}
		if(!empty($data->foto))
		{
			unlink('./uploads/' . $data->foto);
		}						
		$proses = $this->objek_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/objek');
	}

	public function detail($id = '')
	{
		if(empty($id))
		{
			show_404();
		}
		$filter = array();
		if($this->login_level == 'Kontributor')
		{
			// $filter['user_id'] = $this->login_uid;
		}
		$param['data'] 	= $this->objek_model->get_data_row($id, $filter);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['main_content']	= 'panel/objek/detail';
		$param['page_active']	= $this->page_active;
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
		$data 	= $this->objek_model->get_data_row($id);
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
				redirect('panel/objek/detail/' . $id);
				exit;
			}


			/* Poin */
			$poin = $this->input->post('poin');
			if(!empty($poin))
			{
				$id_objek_poin = empty($data->duplikat_dari_id) ? $id : $data->duplikat_dari_id;

				$this->load->model('panel/poin_model');
				$data_poin = array('user_id'	=> $data->user_id,
								   'jumlah'		=> $poin,
								   'jenis'		=> 'Objek',
								   'id'			=> $id_objek_poin,
								   'keterangan'	=> 'Poin untuk pulikasi objek "' . $data->nama . '"',
								   'tanggal'	=> date('Y-m-d H:i:s'));
				$this->poin_model->insert($data_poin);

				//Mail User
				$param_mail_user = array(
										'mail_to'		=> $data->user_id,
										'template_id' 	=> 'verifikasi_objek_publish',
										'data' 			=> array('nama_kontributor' 	=> $data->nama_kontributor,
																 'nama'					=> $data->nama,
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
			/* End Of Poin */				

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
				$this->objek_model->update($data_update, $id_target);
				$this->objek_model->delete($id);

				$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
				redirect('panel/objek/detail/' . $id_target);
				exit;
			}
		}
		elseif($status == 'Draft')
		{
			//Mail User
			$param_mail_user = array(
									'mail_to'		=> $data->user_id,
									'template_id' 	=> 'verifikasi_objek_draft',
									'data' 			=> array('nama_kontributor' 	=> $data->nama_kontributor,
															 'nama'					=> $data->nama,
															 'keterangan_moderasi'	=> $this->input->post('keterangan'))
							   	);
			send_mail($param_mail_user);
			//End Of Mail User

			//SMS User
			$param_sms_user = array('sms_to' 		=> $data->user_id, 
									'template_id' 	=> 'konten_draft',
									'data'			=> array('nama_kontributor'	=> $data->nama_kontributor, 
															  'jenis_konten' 	=> 'Objek')
							  );
			send_sms($param_sms_user);							
			//End Of SMS User
		}

		$data_update = array('status' 				=> $this->input->post('status'), 
							 'moderasi_keterangan' 	=> $this->input->post('keterangan'),
							 'moderasi_user_id'		=> $this->login_uid,
							 'moderasi_waktu'		=> date('Y-m-d H:i:s'));
		$this->objek_model->update($data_update, $id);
		$this->session->set_flashdata('msg', suc_msg('Moderasi berhasil disimpan.'));					
		redirect('panel/objek/detail/' . $id);
	}

	public function export_kml()
	{
		if($this->login_level != 'Administrator')
		{
			show_404();
		}		

		$param['kategori']	= $this->objek_model->get_data_kategori_list()->result();
		$param['data']		= $this->objek_model->get_data()->result();

		$this->load->view('panel/objek/export_kml', $param);
	}

	public function import_kml()
	{
		if($this->login_level != 'Administrator')
		{
			show_404();
		}

		$param['main_content']	= 'panel/objek/import_kml';
		$param['page_active']	= $this->page_active;
		$this->templates->load('templates_panel', $param);						
	}

	public function submit_kml()
	{
		if($this->login_level != 'Administrator')
		{
			show_404();
		}

		if(!empty($_FILES['userfiles']['tmp_name']))
		{
			$config['upload_path']		= './uploads/';
            $config['allowed_types']	= 'xml|kml';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfiles'))
            {
				$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
				redirect('panel/objek/import_kml/');
            }
            else
            {
            	$data_upload 	= $this->upload->data();
            	$data_file 		= open_content_token($data_upload['file_name']);
            	$data_kml 		= $this->_run_kml($data_file);

            	$success = 0;
            	foreach($data_kml as $key => $c)
            	{
            		$kategori_id 	= '';
            		$cek_kategori 	= $this->objek_model->get_data_kategori($c['kategori']);
            		if(empty($cek_kategori))
            		{
            			$kategori_id = $this->objek_model->insert_data_kategori($c['kategori']);
            		}
            		else
            		{
            			$kategori_id = $cek_kategori->kategori_id;
            		}

            		if(!empty($kategori_id))
            		{
            			unset($c['kategori']);

            			$c['kategori_id']	= $kategori_id;
            			$c['user_id']		= $this->login_uid;
            			$c['status']		= 'Publish';
            			$c['url_seo']		= format_uri($c['nama']);
            			$cek_objek 			= $this->objek_model->get_data_row_by_nama($c['nama']);
            			if(empty($cek_objek))
            			{
            				$proses = $this->objek_model->insert($c);
            			}
            			else
            			{
            				$this->objek_model->update($c, $cek_objek->objek_id);
            			}
        				if($this->db->affected_rows() > 0)
        				{
        					$success++;
        				}
            		}
            	}

            	unlink('uploads/' . $data_upload['file_name']);
				$this->session->set_flashdata('msg', suc_msg($success . " berhasil disimpan melalui import KML."));
				redirect('panel/objek/');
            }				
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Masukkan terlebih dahulu file KML'));
			redirect('panel/objek/import_kml/');
		}				
	}

	function _run_kml($data_file)
	{
		// $data_file 		= open_content_token('Peta_Wisata_Kebumen_kml.xml');
		$data 			= explode('<Folder>', $data_file);
		$z = 0;
		$data_import	= array();
		for($i = 1; $i <= count($data); $i++)
		{
			$y = @$data[$i];
			if(empty($y))
			{
				continue;
			}
			
			$kategori 		= scrape_get_between($y, '<name>', '</name>');

			$data_objek		= explode('</Placemark>', $y);
			foreach($data_objek as $kex => $x)
			{
				$data_import[$z]['kategori'] = $kategori;
	
				$x = trim(preg_replace('/\s+/', ' ', $x));
				$data_import[$z]['nama'] 				= scrape_get_between($x, '<Placemark> <name>', '</name>');
				if(empty($data_import[$z]['nama']))
				{
					unset($data_import[$z]);
					continue;
				}
	
				$data_import[$z]['lokasi_desa'] 			= scrape_get_between(trim($x), "<Data name='Desa'> <value>", '</value>');
				$data_import[$z]['lokasi_kecamatan'] 		= scrape_get_between(trim($x), "<Data name='Kecamatan'> <value>", '</value>');
				$data_import[$z]['lokasi_kabupaten_kota'] 	= $this->config->item('kabupaten');
				$data_import[$z]['info_tiket'] 				= scrape_get_between(trim($x), "<Data name='Tiket'> <value>", '</value>');
				$data_import[$z]['info_tempat_ibadah'] 		= scrape_get_between(trim($x), "<Data name='Tempat Ibadah'> <value>", '</value>');
				$data_import[$z]['info_penginapan'] 		= scrape_get_between(trim($x), "<Data name='Penginapan'> <value>", '</value>');
				$data_import[$z]['info_toilet'] 			= scrape_get_between(trim($x), "<Data name='Toilet'> <value>", '</value>');
				$data_import[$z]['info_akses_jalan'] 		= scrape_get_between(trim($x), "<Data name='Akses Jalan'> <value>", '</value>');
				$data_import[$z]['info_deskripsi'] 			= scrape_get_between(trim($x), "<Data name='Deskripsi'> <value>", '</value>');
				$data_import[$z]['terakhir_update'] 		= date('Y-m-d H:i:s');
				
				$coordinate = explode(',', scrape_get_between(trim($x), "<coordinates>", '</coordinates>'));
				$data_import[$z]['lokasi_koordinat'] 	= '{lat:' . $coordinate[1] . ',' . 'lng:' . $coordinate[0] . '}';
				$z++;
			}
		}
		return $data_import;
	}
}