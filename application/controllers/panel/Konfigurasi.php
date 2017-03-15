<?php

class Konfigurasi extends CI_Controller
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

		$this->load->model('panel/konfigurasi_p_model', 'konfig_model');
		$this->page_active = 'konfigurasi';
		$this->sub_page_active = 'konfigurasi';
	}


	public function index()
	{
		$param['keyword']	= $this->input->get('q');
		$limit 				= 20;
		$uri_segment		= 4;
		$filter = array('limit'		=> $limit, 
						'offset'	=> $this->uri->segment($uri_segment),
						'keyword'	=> $param['keyword']);

		$param['data']			= $this->konfig_model->get_data($filter)->result();

		unset($filter['limit']);
		unset($filter['offset']);
		$total_rows 			= $this->konfig_model->get_data($filter)->num_rows();
		$param['pagination']	= paging('panel/konfigurasi/index', $total_rows, $limit, $uri_segment);

		$param['main_content']	= 'panel/konfigurasi/table';
		$param['page_active'] 	= $this->page_active;
		$param['sub_page_active'] 	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function form($id = '')
	{
		if(empty($id))
		{
			show_404();
		}

		$param['msg']			= $this->session->flashdata('msg');
		$param['id']			= $id;

		$last_data 	= $this->session->flashdata('last_data');
		if(!empty($last_data))
		{
			$param['data'] = (object) $last_data;
		}
		else
		{
			$param['data'] = $this->konfig_model->get_data_row($id);
			if(empty($param['data']))
			{
				show_404();
			}
		}

		$param['main_content']	= 'panel/konfigurasi/form';
		$param['page_active']	= $this->page_active;
		$param['sub_page_active']	= $this->sub_page_active;
		$this->templates->load('templates_panel', $param);
	}

	public function submit($id = '')
	{	
		if(empty($id))
		{
			show_404();
		}

		$data_post = $this->input->post();
		unset($data_post['files']);
		$proses = $this->konfig_model->update($data_post, $id);
		if($proses)
		{
			$proses = $this->konfig_model->update(array('terakhir_update' => date('Y-m-d H:i:s')), $id);

			$this->session->set_flashdata('msg', suc_msg('Data berhasil diperbaharui.'));					
			redirect('panel/konfigurasi');
		}
		else
		{
			$this->session->set_flashdata('msg', err_msg('Data gagal diperbaharui, tidak ada yang berubah.'));	
			redirect('panel/konfigurasi');
		}
	}

	public function upload_gambar_isi()
	{
		if(!empty($_FILES['file']['tmp_name']))
		{
			$config['upload_path']		= './uploads/';
            $config['allowed_types']	= 'gif|jpg|png';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file'))
            {
            	echo "Gagal memasukkan gambar.";
            }
            else
            {
            	$data_upload 			= $this->upload->data();
            	echo base_url('uploads/' . $data_upload['file_name']);
            }				
		}		
	}

	public function test_email()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
		}
		else
		{
			$param_mail_user = array(
									'mail_address'	=> $this->input->post('email'),
									'msg' 			=> 'Test Mail ....',
									'subject'		=> 'Test Mail ....');
			send_mail($param_mail_user);						
			$this->session->set_flashdata('msg', suc_msg('Test Email berhasil, silahkan cek di inbox akun email Anda, jika pesan belum masuk, silahkan cek di spam / pastikan konfigurasi smtp email Anda sudah benar.'));
		}
		redirect('panel/mail_templates');
	}

	public function test_sms()
	{
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('msg', err_msg(validation_errors()));
		}
		else
		{
			$param_sms_user = array('sms_no' 		=> $this->input->post('no_hp'), 
									'msg'			=> 'Test SMS ....');
			send_sms($param_sms_user);							

			$this->session->set_flashdata('msg', suc_msg('Test SMS berhasil, silahkan cek di inbox handphone Anda, jika pesan belum masuk, silahkan periksa no handphone / pastikan konfigurasi sms service Anda sudah benar.'));
		}
		redirect('panel/sms_templates');
	}	
}