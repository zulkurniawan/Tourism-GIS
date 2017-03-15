<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tentang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$param['data']			= json_decode(file_get_contents(site_url('API/konfigurasi/index')));
		$param['main_content'] 	= 'tentang/main';
		$this->templates->load('templates_frontend', $param);		
	}

}

/* End of file Kontributor.php */
/* Location: ./application/controllers/Kontributor.php */