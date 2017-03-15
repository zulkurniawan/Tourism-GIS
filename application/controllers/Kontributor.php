<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontributor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$param['data']			= json_decode(file_get_contents(site_url('API/user/get_user_kontributor')));
		$param['main_content'] 	= 'kontributor/main';
		$this->templates->load('templates_frontend', $param);		
	}

}

/* End of file Kontributor.php */
/* Location: ./application/controllers/Kontributor.php */