<?php

class Statistik_web_model extends CI_Model
{
	function get_data($param = array())
	{
		$awal 	= date('Y-m-d', strtotime($param['awal']));
		$akhir 	= date('Y-m-d', strtotime($param['akhir']));

		$query_str 	= "SELECT 
							COUNT(*) AS jml_visitor,
							SUM(case when unik = 'Y' then 1 else 0 end) as jml_visitor_unik,
							waktu,
							hari
						FROM web_visitor
						WHERE waktu >= '$awal' AND waktu <= '$akhir'
						GROUP BY waktu
						ORDER BY waktu ASC";

		$get = $this->db->query($query_str);
		return $get;
	}
}