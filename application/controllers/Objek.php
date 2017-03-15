<?php

class Objek extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($url_objek = '')
	{
		if(empty($url_objek))
		{
			show_404();
		}

		$objek_id	= explode('-', $url_objek);
		$objek_id	= $objek_id[0];

		if(empty($objek_id))
		{
			show_404();
		}

		$limit 			= 10;
		$uri_segment	= 4;
		$offset			= $this->uri->segment($uri_segment);

		$param['keyword']	= $this->input->get('q');

		$url 		= site_url('API/objek/detail/' . $objek_id);
		$objek 		= json_decode(file_get_contents($url));

		if(!empty($objek))
		{
			$param['data']					= $objek;
			$param['data']->objek_wisata	= $objek->data;
			// echo '<pre>';
			// print_r($param['data']->objek_wisata);
			// exit;
			$param['data']->objek_terdekat	= $objek->terdekat;
			$param['meta_title']			= htmlentities($objek->data->nama);
			$param['meta_description']		= strip_tags($objek->data->info_deskripsi);
			$param['meta_author']			= strip_tags($objek->data->nama_kontributor);

			$param['page_active']		= 'profil';
			$param['main_content'] 		= 'page_objek';
			$param['sub_main_content']	= 'objek/list';
			$this->templates->load('templates_frontend', $param);
		}
		else
		{
			show_404();
		}
	}
}