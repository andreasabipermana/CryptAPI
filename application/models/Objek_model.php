<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Objek_model extends MY_Model
{

    protected $_table_name = 'objek_kriptografi';
    protected $_primary_key = 'id_objek_kriptografi';
    protected $_order_by = 'id_objek_kriptografi';
    protected $_order_by_type = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }
    function gen_tabel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $id_project)
    {
        $user_session = $this->session->userdata;
        $id = $this->encryptor->enkrip('dekrip', $user_session['id']);
        $id_project = $this->encryptor->enkrip('dekrip', $id_project);

        $sql = "
	  SELECT 
	
	  (@row:=@row+1) AS nomor,
      a.`id_objek_kriptografi`,
	  a.`nama`,
	  a.`keterangan`

	  FROM 
	  `tb_objek_kriptografi` as a,
      `tb_project` as b,
	  (SELECT @row := 0) r WHERE 1=1 AND
      a.`id_project`= b.`id_project` AND b.`id_user`=" . $id . " 
      AND a.`id_project`=" . $id_project . "
      ";

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " AND ( ";
            $sql .= "
		 a.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`keterangan` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 ";
            $sql .= " ) ";
        }

        $data['totalFiltered']    = $this->db->query($sql)->num_rows();

        $columns_order_by = array(

            0 => 'nomor',
            1 => 'a.`nama`',
            2 => 'a.`keterangan`',
        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }

    function validObjek($nama)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $as  = $this->db->get();

        foreach ($as->result() as $p) {
            # code...
            if ($nama == $p->nama) {
                return 1;
            }
        }
    }
}