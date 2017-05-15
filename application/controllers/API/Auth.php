<?php

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('API/auth_model');
		$this->load->helper('cookie');
	}

	function login()
	{
		$this->form_validation->set_rules('email', 'Email / No Handphone', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == false)
		{
			$respon = array('status' => '201', 'data' => validation_errors('', ''), 'msg' => 'Login gagal.');
		}
		else
		{	
			$email 	= $this->input->post('email');
			$get_data_login = $this->auth_model->get_login($email)->row();
			if(!empty($get_data_login))
			{
				$password = $this->input->post('password');
				if(md5($password) == $get_data_login->password)
				{
					if($get_data_login->status == 'moderasi')
					{
						$respon = array('status'	=> '201', 
										'data'		=> 'Login gagal, Akun sedang dalam moderasi.', 
										'msg' 		=> 'Login gagal, Akun sedang dalam moderasi.');
					}
					elseif($get_data_login->status == 'blokir')
					{
						$respon = array('status' 	=> '201', 
										'data' 		=> 'Login gagal, Akun diblokir.', 
										'msg' 		=> 'Login gagal, Akun diblokir.');
					}
					elseif($get_data_login->status == 'aktif')
					{
						if($get_data_login->no_hp == $email)
						{
							if($get_data_login->verifikasi_no_hp == 'N')
							{
								$respon = array('status' 	=> '201', 
												'data' 		=> 'Login gagal, No Handphone tidak bisa digunakan login, harap segera lakukan verifikasi.', 
												'msg' 		=> 'Login gagal, No Handphone tidak bisa digunakan login, harap segera lakukan verifikasi.');								
								echo json_encode($respon);
								exit;
							}
						}

						$remember_me = $this->input->post('remember_me');
						if(!empty($remember_me))
						{
							if($remember_me == '1')
							{
								$cookie = array(
								    'name'   => 'kp_gis_remember_me',
								    'value'  => $get_data_login->email,
								    'expire' => '1209600',  // Two weeks
								    'domain' => $_SERVER['HTTP_HOST'],
								    'path'   => '/'
								);
								set_cookie($cookie);								
							}
						}


						$respon = array('status' 	=> '200', 
										'data' 		=> 'Login berhasil', 
										'msg' 		=> 'Login berhasil');
						// redirect('home');			

						$this->auth_model->update_last_login($get_data_login->user_id);

						$this->session->set_flashdata('msg', suc_msg('Login Berhasil, Selamat Datang ' . $get_data_login->nama . '.'));
						$this->session->set_userdata('login_status', 'ok');
						$this->session->set_userdata('login_level', $get_data_login->level);
						$this->session->set_userdata('login_uid', $get_data_login->user_id);

						if(empty($get_data_login->terakhir_login))
						{
							$terakhir_login = date('H:i:s d-m-Y');
						}
						else
						{
							$terakhir_login = date('H:i:s d-m-Y', strtotime($get_data_login->terakhir_login));
						}
						$this->session->set_userdata('login_terakhir', $terakhir_login);						
					}
					else
					{
						$respon = array('status' => '201', 'data' => 'Login Gagal.', 'msg' => 'Login gagal, silahkan ulangi lagi.');						
					}
				}
				else
				{
					$respon = array('status' => '201', 'data' => 'Password tidak valid', 'msg' => 'Login gagal.');
				}
			}	
			else
			{
				$respon = array('status' => '201', 'data' => 'Email / No Handphone tidak valid', 'msg' => 'Login gagal.');
			}
		}
		// redirect('home');			

		echo json_encode($respon);
	}

	function login_with_fb()
	{
		$config = array('appId'  => $this->config->item('facebook_app_id'), 
						'secret' => $this->config->item('facebook_secret_key'));
		$this->load->library('facebook', $config);
		$user = $this->facebook->getUser();

		if($user)
		{
			$user_profile 	= $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
			$email 			= $user_profile['email'];
			$get_data_login = $this->auth_model->get_login($email)->row();
			if(!empty($get_data_login))
			{
				$user_id 		= $get_data_login->user_id;
				$level 			= $get_data_login->level;
				$terakhir_login	= $get_data_login->terakhir_login;
				$nama 			= $get_data_login->nama;

				// SMS User
				$param_sms_user = array('sms_to' 		=> $user_id, 
										'template_id' 	=> 'notifikasi_3rd_login_api',
										'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Facebook')
								  );
				send_sms($param_sms_user);
				// End Of SMS User

			}	
			else
			{
				$param_daftar = array('status' 		=> 'aktif',
									  'tgl_daftar'	=> date('Y-m-d H:i:s'),
									  'nama'		=> $user_profile['first_name'],
									  'email'		=> $email,
									  'level'		=> 'Kontributor',
									  'foto'		=> $user_profile['picture']['data']['url'],
									  'reg_from'	=> 'Facebook');
				$proses = $this->auth_model->register($param_daftar);
				if($proses)
				{
					$user_id 	= $this->db->insert_id();
					$level 	 	= 'Kontributor';
					$nama		= $user_profile['first_name'];

					// SMS User
					$param_sms_user = array('sms_to' 		=> $user_id, 
											'template_id' 	=> 'notifikasi_3rd_registrasi_api',
											'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Facebook')
									  );
					send_sms($param_sms_user);
					// End Of SMS User
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Login Gagal, silahkan ulangi lagi.'));
					redirect();
				}
			}

			$this->auth_model->update_last_login($user_id);
			$this->session->set_userdata('login_status', 'ok');
			$this->session->set_userdata('login_level', $level);
			$this->session->set_userdata('login_uid', $user_id);

			if(empty($terakhir_login))
			{
				$terakhir_login = date('H:i:s d-m-Y');
			}
			else
			{
				$terakhir_login = date('H:i:s d-m-Y', strtotime($terakhir_login));
			}
			$this->session->set_userdata('login_terakhir', $terakhir_login);						

			$this->session->set_flashdata('msg', suc_msg('Login Berhasil, Selamat Datang ' . $nama . '.'));
			redirect();
		}
		else
		{
			$login_url = $this->facebook->getLoginUrl(array('scope' => 'email'));
			redirect($login_url);
		}
	}

	function logout_from_fb()
	{
		$config = array('appId'  => $this->config->item('facebook_app_id'), 
						'secret' => $this->config->item('facebook_secret_key'));
		$this->load->library('facebook', $config);
		$logout_url = $this->facebook->getLogoutUrl(array('next' => site_url('API/auth/logout')));
		redirect($logout_url);
	}

	function login_with_ig()
	{
		$client_name 		= $this->config->item('head_meta_title');
		$site_description 	= $this->config->item('head_meta_description');

		$this->config->set_item('instagram_client_name', $client_name);
		$this->config->set_item('instagram_callback_url', site_url('API/auth/login_with_ig'));
		$this->config->set_item('instagram_website', site_url());
		$this->config->set_item('instagram_description', $site_description);
		$this->config->set_item('instagram_scope', 'basic');
		$this->config->set_item('instagram_ssl_verify', TRUE);

		$this->load->library('instagram');

		$code = $this->input->get('code');
		if(!empty($code))
		{
			$auth_response = $this->instagram->authorize($code);
			if(empty($auth_response->user))
			{
				$this->session->set_flashdata('msg', err_msg('Login melalui Instagram gagal.'));
				redirect();								
			}
			$email 			= $auth_response->user->username . '@instagram.com';
			$get_data_login = $this->auth_model->get_login($email)->row();
			if(!empty($get_data_login))
			{
				$user_id 		= $get_data_login->user_id;
				$level 			= $get_data_login->level;
				$terakhir_login	= $get_data_login->terakhir_login;
				$nama 			= $get_data_login->nama;

				// SMS User
				$param_sms_user = array('sms_to' 		=> $user_id, 
										'template_id' 	=> 'notifikasi_3rd_login_api',
										'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Instagram')
								  );
				send_sms($param_sms_user);
				// End Of SMS User
			}	
			else
			{
				$param_daftar = array('status' 		=> 'aktif',
									  'tgl_daftar'	=> date('Y-m-d H:i:s'),
									  'nama'		=> $auth_response->user->full_name,
									  'email'		=> $email,
									  'level'		=> 'Kontributor',
									  'foto'		=> $auth_response->user->profile_picture,
									  'reg_from'	=> 'Instagram');
				$proses = $this->auth_model->register($param_daftar);
				if($proses)
				{
					$user_id 	= $this->db->insert_id();
					$level 	 	= 'Kontributor';
					$nama 		= $auth_response->user->full_name;

					// SMS User
					$param_sms_user = array('sms_to' 		=> $user_id, 
											'template_id' 	=> 'notifikasi_3rd_registrasi_api',
											'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Instagram')
									  );
					send_sms($param_sms_user);
					// End Of SMS User
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Login Gagal, silahkan ulangi lagi.'));
					redirect();
				}
			}

			$this->auth_model->update_last_login($user_id);
			$this->session->set_userdata('login_status', 'ok');
			$this->session->set_userdata('login_level', $level);
			$this->session->set_userdata('login_uid', $user_id);

			if(empty($terakhir_login))
			{
				$terakhir_login = date('H:i:s d-m-Y');
			}
			else
			{
				$terakhir_login = date('H:i:s d-m-Y', strtotime($terakhir_login));
			}
			$this->session->set_userdata('login_terakhir', $terakhir_login);						

			$this->session->set_flashdata('msg', suc_msg('Login Berhasil, Selamat Datang ' . $nama . '.'));
			redirect();
		}
		else
		{
			$login_url = $this->instagram->instagram_login();
			redirect($login_url);			
		}
	}

	function login_with_google()
	{
        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        
        // Google Project API Credentials
        $clientId 		= $this->config->item('google_client_id');
        $clientSecret 	= $this->config->item('google_client_secret');
        $redirectUrl 	= site_url('API/auth/login_with_google');
        
        // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login Kontributor - ' . $this->config->item('head_meta_title'));
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        $getCode = $this->input->get('code');
        if (isset($getCode)) 
        {
            $gClient->authenticate();
            $this->session->set_userdata('google_api_token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('google_api_token');
        if (!empty($token)) 
        {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) 
        {
            $user_profile 	= $google_oauthV2->userinfo->get();

			$email 			= $user_profile['email'];
			$get_data_login = $this->auth_model->get_login($email)->row();
			if(!empty($get_data_login))
			{
				$user_id 		= $get_data_login->user_id;
				$level 			= $get_data_login->level;
				$terakhir_login	= $get_data_login->terakhir_login;
				$nama 			= $get_data_login->nama;

				// SMS User
				$param_sms_user = array('sms_to' 		=> $user_id, 
										'template_id' 	=> 'notifikasi_3rd_login_api',
										'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Google')
								  );
				send_sms($param_sms_user);
				// End Of SMS User
			}	
			else
			{
				$param_daftar = array('status' 		=> 'aktif',
									  'tgl_daftar'	=> date('Y-m-d H:i:s'),
									  'nama'		=> $user_profile['name'],
									  'email'		=> $email,
									  'level'		=> 'Kontributor',
									  'foto'		=> $user_profile['picture'],
									  'reg_from'	=> 'Google');
				$proses = $this->auth_model->register($param_daftar);
				if($proses)
				{
					$user_id 	= $this->db->insert_id();
					$level 	 	= 'Kontributor';
					$nama		= $user_profile['name'];

					// SMS User
					$param_sms_user = array('sms_to' 		=> $user_id, 
											'template_id' 	=> 'notifikasi_3rd_registrasi_api',
											'data'			=> array('nama_user'	=> $nama, 'nama_pihak_ketiga' => 'Google')
									  );
					send_sms($param_sms_user);
					// End Of SMS User					
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Login Gagal, silahkan ulangi lagi.'));
					redirect();
				}
			}

			$this->auth_model->update_last_login($user_id);
			$this->session->set_userdata('login_status', 'ok');
			$this->session->set_userdata('login_level', $level);
			$this->session->set_userdata('login_uid', $user_id);

			if(empty($terakhir_login))
			{
				$terakhir_login = date('H:i:s d-m-Y');
			}
			else
			{
				$terakhir_login = date('H:i:s d-m-Y', strtotime($terakhir_login));
			}
			$this->session->set_userdata('login_terakhir', $terakhir_login);						
			$this->session->set_flashdata('msg', suc_msg('Login Berhasil, Selamat Datang ' . $nama . '.'));
			redirect();
        } 
        else 
        {
            $authUrl = $gClient->createAuthUrl();
            redirect($authUrl);
        }
	}

	function verifikasi()
	{
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required');
		$this->form_validation->set_rules('kode_registrasi', 'Kode Verifikasi', 'required');
		if($this->form_validation->run() == false)
		{
			$respon = array('status' => '201', 'data' => validation_errors('', ''), 'msg' => 'Login gagal.');
		}
		else
		{	
			$no_hp 					= $this->input->post('no_hp');
			$kode_registrasi		= $this->input->post('kode_registrasi');

			$get_data_verifikasi 	= $this->auth_model->get_data_verifikasi($no_hp)->row();
			if(!empty($get_data_verifikasi))
			{
				if($kode_registrasi == $get_data_verifikasi->kode_registrasi)
				{
					if($get_data_verifikasi->status != 'temp_moderasi')
					{
						$respon = array('status'	=> '201', 
										'data'		=> 'Verifikasi gagal, Akun sudah pernah diverifikasi.', 
										'msg' 		=> 'Verifikasi gagal, Akun sudah pernah diverifikasi.');
					}
					else
					{	
						$this->auth_model->update_status_verifikasi($get_data_verifikasi->user_id);
						$respon = array('status'	=> '200', 
										'data'		=> 'Verifikasi berhasil, Kami akan melakukan verifikasi selanjutnya untuk akun Anda.', 
										'msg' 		=> 'Verifikasi berhasil, Kami akan melakukan verifikasi selanjutnya untuk akun Anda');			
					}
				}
				else
				{
					$respon = array('status'	=> '201', 
									'data'		=> 'Verifikasi gagal, Kode Verifikasi tidak valid.', 
									'msg' 		=> 'Verifikasi gagal, Kode Verifikasi tidak valid.');
				}
			}
			else
			{
				$respon = array('status'	=> '201', 
								'data'		=> 'Verifikasi gagal, No Handphone tidak valid.', 
								'msg' 		=> 'Verifikasi gagal, No Handphone tidak valid.');				
			}
		}
		echo json_encode($respon);
	}

	function req_kode_verifikasi_hp()
	{
		$no_hp = $this->input->post('no_hp');
		$get_data_verifikasi 	= $this->auth_model->get_data_verifikasi($no_hp)->row();
		if(!empty($get_data_verifikasi))
		{
			if($get_data_verifikasi->verifikasi_no_hp == 'N')
			{
				$waktu_req_kode	= empty($get_data_verifikasi->waktu_req_kode) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s', strtotime($get_data_verifikasi->waktu_req_kode));
				$to_time 		= strtotime(date('Y-m-d H:i:s'));
				$from_time 		= strtotime($waktu_req_kode);
				$sisa_waktu_req = $to_time - $from_time;
				$interval 		= $this->config->item('verifikasi_interval_sms_no_hp');

				if($sisa_waktu_req == 0 || $sisa_waktu_req > $interval)
				{
					$kode_verifikasi 	= $this->auth_model->generate_reg_code();
					$data_verfikasi 	= array('waktu_req_kode'	=> date('Y-m-d H:i:s'),
												'kode_registrasi'	=> $kode_verifikasi);

					$proses = $this->auth_model->update_data_verifikasi($get_data_verifikasi->user_id, $data_verfikasi);
					if($proses)
					{
						$respon = array('status'	=> '200',
									    'msg'		=> 'Mengirim SMS kode verifikasi',
									    'counter'	=> $interval);	

						// SMS User
						$param_sms_user = array('sms_to' 		=> $get_data_verifikasi->user_id, 
												'template_id' 	=> 'verifikasi_no_hp_user',
												'data'			=> array('kode_verifikasi'	=> $kode_verifikasi)
										  );
						send_sms($param_sms_user);
						// End Of SMS User

					}
					else
					{
						$respon = array('status'	=> '201',
									    'msg'		=> 'Gagal mengirim SMS kode verifikasi, silahkan ulangi lagi.');									
					}
				}
				else
				{
					$respon = array('status' 	=> '201', 
									'msg' 		=> 'Silahkan menunggu selama ' . $sisa_waktu_req . ' detik untuk permintaan kode verifikasi.');
				}
			}
			else
			{
				$respon = array('status' 	=> '201', 
								'msg' 		=> 'No Handphone sudah pernah diverifikasi.');
			}			
		}
		else
		{
			$respon = array('status' 	=> '201', 
							'msg' 		=> 'No Handphone tidak valid.');			
		}

		echo json_encode($respon);
	}

	function post_kode_verifikasi_hp()
	{
		$no_hp 	= $this->input->post('no_hp');
		$kode 	= $this->input->post('kode');
		$get_data_verifikasi 	= $this->auth_model->get_data_verifikasi($no_hp)->row();
		if(!empty($get_data_verifikasi))
		{
			if($get_data_verifikasi->verifikasi_no_hp == 'N')
			{
				if($get_data_verifikasi->kode_registrasi == $kode)
				{
					$data_verfikasi 	= array('verifikasi_no_hp'	=> 'Y', 'waktu_post_kode' => date('Y-m-d H:i:s'));
					$proses = $this->auth_model->update_data_verifikasi($get_data_verifikasi->user_id, $data_verfikasi);
					if($proses)
					{
						$this->session->set_flashdata('msg', suc_msg('Verifikasi No Handphone berhasil'));
						$respon = array('status' 	=> '200', 
										'msg' 		=> 'Verifikasi berhasil');
					}
					else
					{
						$respon = array('status' 	=> '201', 
										'msg' 		=> 'Verifikasi gagal, silahkan ulangi lagi.');									
					}
				}
				else
				{
					$respon = array('status' 	=> '201', 
									'msg' 		=> 'Kode verifikasi salah.');									
				}
			}
			else
			{
				$respon = array('status' 	=> '201', 
								'msg' 		=> 'No Handphone sudah pernah diverifikasi.');				
			}
		}
		else
		{
			$respon = array('status' 	=> '201', 
							'msg' 		=> 'No Handphone tidak valid.');			
		}
		echo json_encode($respon);
	}

	function logout()
	{
		delete_cookie('kp_gis_remember_me', $_SERVER['HTTP_HOST'], '/');
	    $this->session->sess_destroy();  
		$this->session->unset_userdata('login_status');
		$this->session->unset_userdata('login_level');
		$this->session->unset_userdata('login_uid');		
		$this->session->set_flashdata('msg', suc_msg('Logout Berhasil.'));
		redirect();
	}
}