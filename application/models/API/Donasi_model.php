<?php

class Donasi_model extends CI_Model
{
	function get_data()
	{
		$this->db->select('a.*, b.nama as nama_bank, b.gambar');
		$this->db->from('donasi_rekening a');
		$this->db->join('donasi_master_bank b', 'a.bank_id = b.bank_id');
		$query = $this->db->get();
		return $query->result();				
	}
}