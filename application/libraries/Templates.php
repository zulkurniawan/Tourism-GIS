<?php

class Templates
{
	function load($template_name = '', $param = array())
	{
		$CI =& get_instance();

		$param['login_status'] 		= $CI->session->userdata('login_status');
		$param['login_level'] 		= $CI->session->userdata('login_level');
		$param['login_uid'] 		= $CI->session->userdata('login_uid');
		$param['login_terakhir'] 	= $CI->session->userdata('login_terakhir');

		$param['msg']	= $CI->session->flashdata('msg');

		if(empty($param['meta_title']))
		{
			$param['meta_title'] = $CI->config->item('head_meta_title');
		}

		if(empty($param['meta_author']))
		{
			$param['meta_author'] = $CI->config->item('head_meta_author');
		}

		if(empty($param['meta_description']))
		{
			$param['meta_description'] = $CI->config->item('head_meta_description');
		}

		$CI->db->select('nama');
		$query = $CI->db->get('objek');
		$param['meta_keywords'] = '';
		foreach ($query->result() as $key => $c) 
		{ 
			$param['meta_keywords'] .= $c->nama . ', '; 
		}

		if(!empty($param['login_status']))
		{

			$CI->db->where('user_id', $param['login_uid']);
			$CI->db->from('user');
			$data_user = $CI->db->get()->row();

			$param['nama_user']	= $data_user->nama;
			$param['foto_user']	= $data_user->foto;
		}

		if(empty($template_name))
		{
			$CI->load->view('templates', $param);
		}
		else
		{
			$CI->load->view($template_name, $param);			
		}
	}
}