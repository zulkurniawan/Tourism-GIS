<?php

class Dashboard_model extends CI_Model
{
	function get_data_scraping($param = array())
	{
		if(!empty($param))
		{
			if(!empty($param['limit']))
			{
				if(!empty($param['offset']))
				{
					$this->db->limit($param['limit'], $param['offset']);
				}
				else
				{
					$this->db->limit($param['limit']);
				}
			}
		}

		$this->db->order_by('a.id_produk', 'DESC');
		$this->db->from('hasil_scraping a');
		$query = $this->db->get();
		return $query;
	}	
}