<?php

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	function index()
	{
		$this->register();
	}

	function register()
	{
		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}

		// echo '<pre>';
		// print_r($param['data']);
		// exit;

		$param['msg'] 			= $this->session->flashdata('msg');
		$param['main_content'] 	= 'user/register';
		$this->templates->load('templates_frontend', $param);
	}

	function register_submit()
	{
		$data_post = $this->input->post();
		if(empty($data_post))
		{
			show_404();
		}
		else
		{
			if($data_post['regas'] == 'Kontributor')
			{
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('organisasi', 'Organisasi / Komunitas');
				$this->form_validation->set_rules('alamat', 'Alamat');
			}
			elseif($data_post['regas'] == 'Partners')
			{
				$this->form_validation->set_rules('nama', 'Nama Pemilik', 'required');
				$this->form_validation->set_rules('organisasi', 'Nama Bisnis');
				$this->form_validation->set_rules('alamat', 'Alamat Usaha');
			}
			else
			{
				show_404();
			}
		}

		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|valid_email');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|is_unique[user.no_hp]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Ulangi Password', 'required|matches[password]');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('/');
		}
		else
		{

			$email 	= $this->input->post('email');
			$cek 	= $this->user_model->cek_data($email)->row();
			if(!empty($cek))
			{
				$this->session->set_flashdata('last_data', $data_post);
				$this->session->set_flashdata('msg', err_msg('Pendaftaran Gagal. Email pernah terdaftar, gunakan Email lainnya.'));
				redirect('/');
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
						$this->session->set_flashdata('last_data', $data_post);
						$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
						redirect('/');
		            }
		            else
		            {
		            	$data_upload 			= $this->upload->data();
		            	$data_post['foto']		= $data_upload['file_name'];
		            }				
				}

				$password = $data_post['password'];

				// $data_post['level']				= 'Kontributor';
				$data_post['status']			= 'aktif';
				// $data_post['status']			= 'temp_moderasi';
				$data_post['password'] 			= md5($data_post['password']);
				// $data_post['kode_registrasi']	= $this->user_model->generate_reg_code();
				$data_post['tgl_daftar']		= date('Y-m-d H:i:s');
				$data_post['level']				= $data_post['regas'];

				unset($data_post['cpassword']);
				unset($data_post['regas']);
				$proses = $this->user_model->insert($data_post);
				if($proses)
				{
					$id_user = $this->db->insert_id();

					if($data_post['level'] == 'Kontributor')
					{
						// SMS User
						$param_sms_user = array('sms_to' 		=> $id_user, 
												'template_id' 	=> 'notifikasi_registrasi_kontributor',
												'data'			=> array('nama_kontributor'	=> $data_post['nama'])
										  );
						send_sms($param_sms_user);
						// End Of SMS User

						//Mail User
						$param_mail_user = array(
												'mail_to'		=> $id_user,
												'template_id' 	=> 'registrasi_notif_kontributor',
												'data' 			=> array('nama_kontributor' => $data_post['nama'],
																		 'alamat'			=> $data_post['alamat'],
																		 'organisasi'		=> $data_post['organisasi'],
																		 'email'			=> $data_post['email'],
																		 'password' 		=> $password)
										   	);
						send_mail($param_mail_user);
						//End Of Mail User

						//Mail Administrator
						$param_mail_user = array(
												'mail_to'		=> 'Administrator',
												'template_id' 	=> 'registrasi_notif_administrator',
												'data' 			=> array('nama_kontributor' => $data_post['nama'],
																		 'email'			=> $data_post['email'],
																		 'tanggal' 			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail Administrator

						//SMS Administrator
						$param_sms_administrator = array('sms_to' 		=> 'Administrator', 
														 'template_id' 	=> 'notifikasi_registrasi_administrator',
														 'data'			=> array('nama_kontributor'	=> $data_post['nama'])
										  			);
						send_sms($param_sms_administrator);
						//End Of SMS Administrator
					}
					elseif($data_post['level'] == 'Partners')
					{
						// SMS User
						$param_sms_user = array('sms_to' 		=> $id_user, 
												'template_id' 	=> 'notifikasi_registrasi_partners',
												'data'			=> array('nama_partners'	=> $data_post['nama'])
										  );
						send_sms($param_sms_user);
						// End Of SMS User

						//Mail User
						$param_mail_user = array(
												'mail_to'		=> $id_user,
												'template_id' 	=> 'registrasi_notif_partners',
												'data' 			=> array('nama_partners' 	=> $data_post['nama'],
																		 'alamat'			=> $data_post['alamat'],
																		 'organisasi'		=> $data_post['organisasi'],
																		 'email'			=> $data_post['email'],
																		 'password' 		=> $password)
										   	);
						send_mail($param_mail_user);
						//End Of Mail User

						//Mail Administrator
						$param_mail_user = array(
												'mail_to'		=> 'Administrator',
												'template_id' 	=> 'registrasi_notif_administrator_partners',
												'data' 			=> array('nama_partners' => $data_post['nama'],
																		 'email'			=> $data_post['email'],
																		 'tanggal' 			=> date('d-m-Y H:i:s'))
										   	);
						send_mail($param_mail_user);
						//End Of Mail Administrator

						//SMS Administrator
						$param_sms_administrator = array('sms_to' 		=> 'Administrator', 
														 'template_id' 	=> 'notifikasi_registrasi_administrator_partners',
														 'data'			=> array('nama_partners'	=> $data_post['nama'])
										  			);
						send_sms($param_sms_administrator);
						//End Of SMS Administrator
					}



					$this->session->set_flashdata('msg', suc_msg('Pendaftaran berhasil, Silahkan login untuk melanjutkan.'));
					redirect('/');
					// $this->session->set_flashdata('msg', suc_msg('Pendaftaran berhasil, Masukkan Kode Verifikasi yang kami kirimkan via SMS. Batas waktu memasukkan kode verifikasi adalah 2 Jam. Melebihi waktu 2 jam maka pendaftaran dianggap batal.'));
					// redirect('user/verifikasi');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Pendaftaran gagal, Silahkan ulangi lagi.'));					
					redirect('/');
				}				
			}
		}		
	}

	function profil($id = '')
	{
		if(empty($id))
		{
			show_404();
		}

		$parsing_url = explode('-', $id);
		$id = $parsing_url[0];

		$param['data'] = $this->user_model->get_user_profil($id);
		if(empty($param['data']))
		{
			show_404();
		}

		$param['kontributor']	= json_decode(file_get_contents(site_url('API/user/get_user_kontributor')));
		$param['main_content'] 	= 'user/profil';
		$this->templates->load('templates_frontend', $param);		
	}

	function verifikasi()
	{
		$param['msg'] 			= $this->session->flashdata('msg');
		$param['main_content'] 	= 'user/verifikasi';
		$this->templates->load('templates_frontend', $param);		
	}
}