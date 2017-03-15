<?php

class Profil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_status 	= $this->session->userdata('login_status');
		$this->login_level 		= $this->session->userdata('login_level');
		$this->login_uid 		= $this->session->userdata('login_uid');
		if($this->login_status != 'ok')
		{
			$this->session->set_flashdata('msg', err_msg('Silahkan login untuk melanjutkan.'));
			redirect(site_url());
		}
		$this->load->model('panel/profil_model');
		$this->page_active 		= 'profil';
	}


	public function index()
	{
		$param['data']	= $this->profil_model->get_data_row($this->login_uid);

		$this->load->model('panel/poin_model');
		$param['poin']	= $this->poin_model->hitung_poin($this->login_uid);

		$param['main_content']		= 'panel/profil/table';
		$param['page_active'] 		= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form()
	{
		$param['msg']	= $this->session->flashdata('msg');
		$last_data 		= $this->session->flashdata('last_data');

		$param['data'] = $this->profil_model->get_data_row($this->login_uid);
		if(!empty($last_data))
		{
			foreach($last_data as $key => $c)
			{
				if(!empty($c))
				{
					$param['data']->$key = $c;
				}
			}
			// $param['data'] = (object) $last_data;
		}

		$param['main_content']	= 'panel/profil/form';
		$param['page_active']	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit()
	{	
		$data_post = $this->input->post();
		if(empty($data_post))
		{
			show_404();
		}
		else
		{
			if($this->login_level == 'Kontributor')
			{
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('organisasi', 'Organisasi / Komunitas', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			}
			elseif($this->login_level == 'Partners')
			{
				$this->form_validation->set_rules('nama', 'Nama Pemilik', 'required');
				$this->form_validation->set_rules('organisasi', 'Nama Bisnis', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat Usaha', 'required');
			}
			else
			{
				$this->form_validation->set_rules('nama', 'Nama', 'required');				
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
				$data_post['password'] = md5($data_post['password']);					
			}			

			if(!empty($data_post['no_hp']))
			{
				$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|is_unique[user.no_hp]');
			}
		}

		// echo '<pre>';
		// print_r($data_post);
		// exit;

		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
			$this->session->set_flashdata('last_data', $data_post);
			redirect('panel/profil/form/');
		}
		else
		{
			// if(empty($data_post['password']))
			// {
			// 	unset($data_post['password']);
			// }
			// else
			// {
			// 	$data_post['password'] = md5($data_post['password']);					
			// }
			unset($data_post['cpassword']);
			$proses = $this->profil_model->update($data_post, $this->login_uid);
			if($proses)
			{
				$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
				redirect('panel/profil');
			}
			else
			{
				$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
				redirect('panel/profil');
			}
		}
	}	

	public function upload_foto()
	{
		$param['msg']	= $this->session->flashdata('msg');
		$param['data'] = $this->profil_model->get_data_row($this->login_uid);

		$param['main_content']	= 'panel/profil/upload_foto';
		$param['page_active']	= $this->page_active;
		$this->templates->load('templates_panel', $param);
	}		

	public function do_upload()
	{
		if(!empty($_FILES['userfiles']['tmp_name']))
		{
			$config['upload_path']      = './uploads/';
            $config['allowed_types']    = 'jpg|png';
 			$config['max_size'] 		= '2048';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfiles'))
            {
				$this->session->set_flashdata('msg', err_msg($this->upload->display_errors()));
				redirect('panel/profil/upload_foto/');			
            }
            else
            {
            	$data_upload 			= $this->upload->data();
            	$data_post['foto']		= $data_upload['file_name'];
				$proses = $this->profil_model->update($data_post, $this->login_uid);
				if($proses)
				{
					$this->session->set_flashdata('msg', suc_msg('Foto berhasil disimpan.'));					
					redirect('panel/profil');
				}
				else
				{
					$this->session->set_flashdata('msg', err_msg('Foto gagal disimpan, silahkan ulangi lagi.'));	
					redirect('panel/profil/upload_foto/');			
				}
            }				
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Pilih Foto Profil'));					
			redirect('panel/profil/upload_foto/');			
		}
	}

	function verifikasi_no_hp()
	{
		$param['main_content']	= 'panel/profil/verifikasi_no_hp';
		$param['page_active']	= $this->page_active;
		$this->templates->load('templates_panel', $param);		
	}
}