<?php

class User extends CI_Controller
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

		$this->load->model('panel/user_model');
		$this->page_active = 'user';
	}


	public function index($jenis = 'index')
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword'],
						'jenis'		=> $jenis == 'index' ? 'administrator' : $jenis);

		$param['data']			= $this->user_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->user_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/user/' . $jenis, $total_rows, $limit, $uri_segment);

		$param['jenis']				= $jenis;
		$param['main_content']		= 'panel/user/table';
		$param['page_active'] 		= $this->page_active;
		$param['sub_page_active'] 	= $jenis;
		$this->templates->load('templates_panel', $param);
	}

	public function kontributor()
	{
		$this->index('kontributor');
	}

	public function partners()
	{
		$this->index('partners');
	}

	public function form($jenis = '', $id = '')
	{
		if(empty($jenis))
		{
			show_404();
		}

		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;
		$param['jenis']			= $jenis;

		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}
		else
		{
			if(!empty($id))
			{
				$param['data'] = $this->user_model->get_data_row($id);
			}
		}

		$param['opt_level']			= array('administrator' => 'Administrator', 
											'kontributor' 	=> 'Kontributor', 
											'partners' 		=> 'Partners');
		$param['main_content']	= 'panel/user/form';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active'] 	= $jenis;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($jenis = '', $id = '')
	{	
		if(empty($jenis))
		{
			show_404();
		}
		$data_post = $this->input->post();
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		if(empty($id))
		{
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|valid_email');
			$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|is_unique[user.no_hp]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Ulangi Password', 'required|matches[password]');
		}
		else
		{
			if($jenis == 'Kontributor')
			{
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('organisasi', 'Organisasi / Komunitas', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			}
			elseif($jenis == 'Partners')
			{
				$this->form_validation->set_rules('nama', 'Nama Pemilik', 'required');
				$this->form_validation->set_rules('organisasi', 'Nama Bisnis', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat Usaha', 'required');
			}

			if(empty($data_post['password']))
			{
				unset($data_post['password']);
				unset($data_post['cpassword']);
			}
			else
			{
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Ulangi Password', 'required|matches[password]');
			}			
		}

		// $this->form_validation->set_rules('level', 'Level');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/user/form/' . $jenis . '/' . $id);
		}
		else
		{
			if(!empty($_FILES['userfiles']['tmp_name']))
			{
				$config['upload_path']          = './uploads/';
	            $config['allowed_types']        = 'jpg|png';

	            $this->load->library('upload', $config);
	            if (!$this->upload->do_upload('userfiles'))
	            {
					$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
					$this->session->set_flashdata('last_data', $data_post);
					redirect('panel/user/form/'  . $jenis . '/' . $id);
	            }
	            else
	            {
	            	$data_upload 			= $this->upload->data();
	            	$data_post['foto']		= $data_upload['file_name'];
	            }				
			}

			$data_post['level']	= ucwords($data_post['level']);
			// $data_post['level'] = ucwords($jenis == 'index' ? 'administrator' : $jenis);
			if(empty($id))
			{
				$data_post['password'] = md5($data_post['password']);
				unset($data_post['cpassword']);
				$proses = $this->user_model->insert($data_post);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Data berhasil disimpan.'));					
					redirect('panel/user/' . $jenis);
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal disimpan, silahkan ulangi lagi.'));					
					redirect('panel/user/form/' . $jenis . '/' . $id);
				}
			}
			else
			{
				if(empty($data_post['password']))
				{
					unset($data_post['password']);
				}
				else
				{
					$data_post['password'] = md5($data_post['password']);					
				}

				unset($data_post['cpassword']);
				$last_data 	= $this->user_model->get_data_row($id);
				$proses 	= $this->user_model->update($data_post, $id);
				if($proses)
				{
					$status = $data_post['status'] == 'aktif' ? 'Aktif' : ($data_post['status'] == 'blokir' ? 'Blokir' : 'Moderasi');
					if($data_post['level'] == 'Kontributor')
					{
						// Mail User
						$param_mail_user = array(
												'mail_to'		=> $id,
												'template_id' 	=> 'status_verifikasi_user',
												'data' 			=> array('nama' 		=> $data_post['nama'],
																		 'alamat'		=> $data_post['alamat'],
																		 'organisasi'	=> $data_post['organisasi'],
																		 'email'		=> $data_post['email'],
																		 'status'		=> $status)
										   	);
						send_mail($param_mail_user);
						// End Of Mail User			
					}

					if($data_post['level'] == 'Partners')
					{
						// Mail User
						$param_mail_user = array(
												'mail_to'		=> $id,
												'template_id' 	=> 'status_verifikasi_user_partners',
												'data' 			=> array('nama' 		=> $data_post['nama'],
																		 'alamat'		=> $data_post['alamat'],
																		 'organisasi'	=> $data_post['organisasi'],
																		 'email'		=> $data_post['email'],
																		 'status'		=> $status)
										   	);
						send_mail($param_mail_user);
						// End Of Mail User			
					}
					//SMS User
					if(!empty($status))
					{
						if($last_data->status == 'moderasi')
						{
							$param_sms_user = array('sms_to' 		=> $id, 
													'template_id' 	=> 'notifikasi_moderasi_user',
													'data'			=> array('nama_user'	=> $data_post['nama'], 
																			  'tanggal' 	=> date('d-m-Y'),
																			  'status'		=> $status)
											  );
						}
						else
						{
							$param_sms_user = array('sms_to' 		=> $id, 
													'template_id' 	=> 'status_user',
													'data'			=> array('nama_user'	=> $data_post['nama'], 
																			  'tanggal' 	=> date('d-m-Y'),
																			  'status'		=> $status)
											  );
						}
						send_sms($param_sms_user);							
					}
					//End Of SMS User

					$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
					redirect('panel/user/' . $jenis . '/');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
					redirect('panel/user/' . $jenis . '/');
				}
			}
		}
	}

	public function hapus($jenis = '', $id = '')
	{
		if(empty($jenis) || empty($id))
		{
			show_404();
		}

		$proses = $this->user_model->delete($id);
		$this->session->set_flashdata('msg', suc_msg('Data berhasil dihapus.'));					
		redirect('panel/user/' . $jenis);
	}

	public function hapus_foto($jenis = '' , $id = '')
	{
		if(empty($jenis) || empty($id))
		{
			show_404();
		}

		$data = $this->user_model->get_data_row($id);
		if(!empty($data))
		{
			if(unlink('uploads/' . $data->foto))
			{
				$proses = $this->user_model->update(array('foto' => ''), $id);
				$this->session->set_flashdata('msg', suc_msg('Foto berhasil dihapus.'));					
			}
			else
			{
				$this->session->set_flashdata('msg', err_msg('Foto gagal dihapus'));					
			}
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Foto Gagal dihapus'));	
		}
		redirect('panel/user/form/' . $jenis . '/' . $id);
	}
}