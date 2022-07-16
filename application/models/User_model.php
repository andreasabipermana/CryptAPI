<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{

	protected $_table_name = 'user';
	protected $_primary_key = 'id_user';
	protected $_order_by = 'id_user';
	protected $_order_by_type = 'DESC';

	public function __construct()
	{
		parent::__construct();
	}
	function gen_tabel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
	  SELECT 
	
	  (@row:=@row+1) AS nomor,
	  a.`id_user`, 
	  a.`nama`,
	  a.`username`,
	  a.`level`,
	  a.`aktif`

	  FROM 
	  `tb_user` as a
	  , (SELECT @row := 0) r WHERE 1=1 
	  ";

		$data['totalData'] = $this->db->query($sql)->num_rows();

		if (!empty($like_value)) {
			$sql .= " AND ( ";
			$sql .= "
		 a.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`username` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`level` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`aktif` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 ";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		$columns_order_by = array(

			0 => 'nomor',
			1 => 'a.`nama`',
			2 => 'a.`username`',
			3 => 'a.`level`',
			4 => 'a.`aktif`',

		);

		$sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
		$sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function gen_tabel2($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
	  SELECT 
	
	  (@row:=@row+1) AS nomor,
	  a.`id_user`, 
	  a.`nama`,
	  a.`username`,
	  a.`aktif`

	  FROM 
	  `tb_user` as a
	  , (SELECT @row := 0) r WHERE 1=1 AND a.`level`='User' 
	  ";

		$data['totalData'] = $this->db->query($sql)->num_rows();

		if (!empty($like_value)) {
			$sql .= " AND ( ";
			$sql .= "
		 a.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`username` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`aktif` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 ";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		$columns_order_by = array(

			0 => 'nomor',
			1 => 'a.`nama`',
			2 => 'a.`username`',
			4 => 'a.`aktif`',

		);

		$sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
		$sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function validUsername($username)
	{
		$this->db->from('{PRE}' . $this->_table_name);
		$as  = $this->db->get();

		foreach ($as->result() as $p) {
			# code...
			if ($username == $p->username) {
				return 1;
			}
		}
	}

	function validEmail($email)
	{
		$this->db->from('{PRE}' . $this->_table_name);
		$this->db->where('email', $email);
		$this->db->limit(1);
		return $this->db->get();
	}
}