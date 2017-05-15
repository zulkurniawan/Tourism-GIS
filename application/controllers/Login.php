<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$login_uid = $this->session->userdata('login_uid');
		if(!empty($login_uid))
		{
			$param['login_status'] = 'ok';
			// $user_profile = json_decode(file_get_contents(site_url('API/user/get_user_profil/' . $login_uid)));
			// if($user_profile->status == '200')
			// {
			// 	$param['user_profile']	= $user_profile->data;
			// }
			// else
			// {
			// 	redirect('API/auth/logout');
			// }
		}
		$param['kontributor']	= json_decode(file_get_contents(site_url('API/user/get_user_kontributor')));
		$param['konfigurasi']	= json_decode(file_get_contents(site_url('API/konfigurasi/index')));
		$param['donasi']		= json_decode(file_get_contents(site_url('API/donasi/index')));

		$param['main_content'] 	= 'home/login';
		$this->templates->load('templates_login', $param);
	}
}
