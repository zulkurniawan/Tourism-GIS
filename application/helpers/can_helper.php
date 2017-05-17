<?php

function send_mail($param = array(), $debug = false)
{
	if(empty($param))
	{
		return false;
	}

	$CI =& get_instance();

	if(!empty($param['template_id']))
	{
		$CI->load->model('panel/mail_templates_model');
		$templates 	= $CI->mail_templates_model->get_data_row($param['template_id']);

		if($templates->aktif == 'N')
		{
			return false;
		}

		$subjek = $templates->subjek;

		$search 	= array();
		$replace 	= array();
		foreach($param['data'] as $key => $c)
		{
			$search[] 	= '{' . $key . '}';
			$replace[]	= $c;
		}
		
		$context['content']  = str_replace($search, $replace, $templates->isi);
		$context['title']	= $subjek;
		$isi 	= $CI->load->view('templates_mail', $context, true)	;
	}
	else
	{
		$subjek	= @$param['subject'];
		$isi 	= @$param['msg'];
	}

 	if(!empty($param['mail_to']))
 	{
		if($param['mail_to'] == 'Administrator')
		{
			$CI->db->select('email');
			$CI->db->where('status', 'Aktif');
			$CI->db->where('level', 'Administrator');
			$query = $CI->db->get('user');		

			$param['mail_to'] = $query->result();		
		}
		else
		{
			$CI->db->select('email');
			$CI->db->where('user_id', $param['mail_to']);
			$query = $CI->db->get('user');		

			$param['mail_to'] = $query->result();		
		} 		
 	}
 	else
 	{
 		if(!empty($param['mail_address']))
 		{
	 		$param['mail_to'] = (object) array((object) array('email' => $param['mail_address']));
 		}
 	}

	if(!empty($param['mail_to']))
	{
		$CI->load->library('email');
		$CI->email->initialize(array(
					  				'protocol' 	=> 'smtp',
					  				'smtp_host' => $CI->config->item('mail_smtp_host'),
					  				'smtp_user' => $CI->config->item('mail_smtp_user'),
					  				'smtp_pass' => $CI->config->item('mail_smtp_pass'),
					  				'smtp_port' => $CI->config->item('mail_smtp_port'),
					  				'crlf' 		=> "\r\n",
					  				'newline' 	=> "\r\n",
					  				'mailtype'	=> 'html'
								));

		foreach($param['mail_to'] as $key => $c)
		{
			$CI->email->from($CI->config->item('mail_account_addr'), $CI->config->item('mail_account_name'));
			$CI->email->to($c->email);
			$CI->email->subject($subjek);
			$CI->email->message($isi);
			$CI->email->send();
			if($debug == true)
			{
				echo $CI->email->print_debugger();
			}
		}		
	}
	return true;
}

function send_sms($param = array())
{
	if(empty($param))
	{
		return false;
	}	

	$CI =& get_instance();

	$username 	= $CI->config->item('sms_service_username');
	$password 	= $CI->config->item('sms_service_password');
	if(!empty($param['template_id']))
	{
		$CI->load->model('panel/sms_templates_model');
		$templates 	= $CI->sms_templates_model->get_data_row($param['template_id']);

		if($templates->aktif == 'N')
		{
			return false;
		}


		$search 	= array();
		$replace 	= array();
		foreach($param['data'] as $key => $c)
		{
			$search[] 	= '{' . $key . '}';
			$replace[]	= $c;
		}
		
		$message  = str_replace($search, $replace, $templates->isi);		
	}
	else
	{
		$message 	= @$param['msg'];
	}
 
 	if(!empty($param['sms_to']))
 	{
		if($param['sms_to'] == 'Administrator')
		{
			$CI->db->select('no_hp');
			$CI->db->where('status', 'Aktif');
			$CI->db->where('level', 'Administrator');
			$query = $CI->db->get('user');		

			$param['sms_to'] = $query->result();		
		}
		else
		{
			$CI->db->select('no_hp');
			$CI->db->where('user_id', $param['sms_to']);
			$query = $CI->db->get('user');		

			$param['sms_to'] = $query->result();		
		} 		
 	}
 	else
 	{
 		if(!empty($param['sms_no']))
 		{
	 		$param['sms_to'] = (object) array((object) array('no_hp' => $param['sms_no']));
 		} 		
 	}

	// echo '<pre>';
	// print_r($param['sms_to']);
	// exit;
	$respon = false;
 	if(!empty($param['sms_to']))
 	{
		$ch 		= curl_init();
		foreach($param['sms_to'] as $key => $c)
		{
			$mobile		= $c->no_hp;
		
			$url_target = "http://api.gosmsgateway.net/api/Send.php";
			$url_array 	= array("username" 	=> $username,
								"mobile"	=> $mobile,
								"message"	=> $message,
								"password"	=> $password);
			$url_target .= '?' . http_build_query($url_array);
			curl_setopt($ch, CURLOPT_URL, $url_target);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$proses 	= curl_exec($ch);
			if(curl_errno($ch) == '0')
			{
				$respon = true;
			}
			else
			{
				$respon = false;
			}
		} 		
 	}
	return $respon;
}

function err_msg($msg, $dismiss = true)
{
	$result = 	'<div class="alert alert-danger" role="alert">';
	if($dismiss == true)
	{
		$result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>';
	}
	$result .= $msg . '</div>';
    return $result;
}

function war_msg($msg, $dismiss = true)
{
	$result = 	'<div class="alert alert-warning" role="alert">';
	if($dismiss == true)
	{
		$result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>';
	}
	$result .= $msg . '</div>';
    return $result;
}

function suc_msg($msg, $dismiss = true)
{
	$result = 	'<div class="alert alert-success" role="alert">';
	if($dismiss == true)
	{
		$result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>';
	}
	$result .= $msg . '</div>';
    return $result;
}

function info_msg($msg, $dismiss = true)
{
	$result = 	'<div class="alert alert-info" role="alert">';
	if($dismiss == true)
	{
		$result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>';
	}
	$result .= $msg . '</div>';
    return $result;
}

function scrape_get_between($data, $start, $end)
{
    $data = stristr($data, $start); // Stripping all data from before $start
    $data = substr($data, strlen($start));  // Stripping $start
    $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
    $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
    return $data;   // Returning the scraped data from the function
}

function convert_to_rupiah($data = '')
{
	if(empty($data) OR $data <= 0)
	{
		return 'Rp. <span style="float: right">0,-</span>';
	}
	else
	{
		return 'Rp. <span style="float: right">' . number_format($data, 0, ',', '.') . ',-</span>';
	}
}	

function paging($controller='', $total_rows='', $limit='', $uri='')
{
	$CI =& get_instance();
	$CI->load->library('pagination');
	
	$config['base_url'] 	= site_url($controller);
	$config['total_rows'] 	= $total_rows;
	$config['per_page'] 	= $limit;

	$config['first_url'] 	= site_url($controller);

	if(!empty($uri))
	{
		$config['uri_segment']	= $uri;
	}

	// TAMBAHAN PENTING
	$suffix 			 = http_build_query($_GET, '', "&"); 
	$config['suffix'] 	 = '?'.$suffix;
	$config['first_url'] = site_url($controller . '?' . $suffix);
	// TAMBAHAN PENTING

	$config['cur_tag_open'] 	= '<span class="paging">';
	$config['cur_tag_close'] 	= '</span>';
	// $this->load->library('pagination');
	
	$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
	$config['full_tag_close'] 	= '</ul>';
	$config['first_link'] 		= 'Awal';
	$config['first_tag_open'] 	= '<li>';
	$config['first_tag_close'] 	= '</li>';
	$config['last_link'] 		= 'Akhir';
	$config['last_tag_open'] 	= '<li>';
	$config['last_tag_close'] 	= '</li>';
	$config['next_link'] 		= '&gt;';
	$config['next_tag_open'] 	= '<li>';
	$config['next_tag_close'] 	= '</li>';
	$config['prev_link'] 		= '&lt;';
	$config['prev_tag_open'] 	= '<li>';
	$config['prev_tag_close'] 	= '</li>';
	$config['cur_tag_open'] 	= '<li class="active"><a href="">';
	$config['cur_tag_close'] 	= '</a></li>';
	$config['num_tag_open'] 	= '<li>';
	$config['num_tag_close'] 	= '</li>';

	$CI->pagination->initialize($config);

	return $CI->pagination->create_links();
}

function write_content_json($file, $content = '_blank')
{
	$dir_temp = 'uploads';
	$myfile = fopen($dir_temp . '/' . $file, 'w');
	$act = fwrite($myfile, @$content);
	fclose($myfile);
	if($act)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function open_content_token($file)
{
	$dir_temp = 'uploads';		
	$myfile = fopen($dir_temp . '/' . $file,'r');
	$result = fread($myfile,filesize($dir_temp . '/' . $file));
	fclose($myfile);
	return $result;
}

function format_uri( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}

function hari_indonesia($index)
{
	$list = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
	return $list[$index];
}

function tanggal_antara($strDateFrom,$strDateTo)
{
    $aryRange 	= array();

    $iDateFrom 	= mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo 	= mktime(1,0,0,substr($strDateTo,5,2), substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo >= $iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo)
        {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}	


function label_user_verified($param, $style = '', $add_label = '')
{
	$str = '';
	if($param->verifikasi_no_hp == 'Y')
	{
		$str .= '<span class="label label-success" style="' . $style . '">';
		$str .= '<i class="fa fa-check-circle fa-lg" style="color:white"></i>';
		if($add_label != '')
		{
			$str .= ' / ' . $add_label;
		}
		$str .= '</span>';
	}
	return $str;
}

function load_foto_user($path)
{
	if(empty($path))
	{
		return base_url('assets/user.png');
	}
	else
	{
		if(strpos($path, 'http') !== false)
		{
			return $path;			
		}
		else
		{
			return base_url('uploads/' . $path);
		}
	}
}