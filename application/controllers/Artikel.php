<?php

class Artikel extends CI_Controller
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

		$url = site_url('API/artikel/index/' . $objek_id . '?q=' . $param['keyword'] . '&limit=' . $limit . '&offset=' . $offset);
		$param['data'] 		= json_decode(file_get_contents($url));
		// echo '<pre>';
		// print_r($param['data']);
		// exit;

		if(!empty($param['data']))
		{
			if($param['data']->status == '200')
			{
				$param['pagination']	= paging('artikel/index/' . $url_objek, $param['data']->jml_data, $limit, $uri_segment);
			}

			$param['meta_title']		= $param['data']->objek_wisata->nama;
			$param['meta_description']	= $param['data']->objek_wisata->info_deskripsi;
			$param['meta_author']		= $param['data']->objek_wisata->nama_kontributor;

			$param['page_active']		= 'artikel';
			$param['main_content'] 		= 'page_objek';
			$param['sub_main_content']	= 'artikel/list';
			$this->templates->load('templates_frontend', $param);
		}
		else
		{
			show_404();
		}
	}

	public function baca($url_artikel = '')
	{
		if(empty($url_artikel))
		{
			show_404();
		}

		$artikel_ps	= explode('-', $url_artikel);
		$artikel_id	= $artikel_ps[0];
		$objek_id	= $artikel_ps[1];

		if(empty($artikel_id) || empty($objek_id))
		{
			show_404();
		}

		$url = site_url('API/artikel/index/' . $objek_id . '?id=' . $artikel_id);
		$param['data'] 		= json_decode(file_get_contents($url));

		// echo '<pre>';
		// print_r($param['data']);
		// exit;

		if(!empty($param['data']))
		{
			$param['meta_title']		= $param['data']->data[0]->judul;
			$param['meta_description']	= $param['data']->data[0]->singkat;
			$param['meta_author']		= $param['data']->data[0]->nama_kontributor;

			$param['page_active']		= 'artikel';
			$param['main_content'] 		= 'page_objek';
			$param['sub_main_content']	= 'artikel/detail';
			$this->templates->load('templates_frontend', $param);
		}
		else
		{
			show_404();
		}

	}
}