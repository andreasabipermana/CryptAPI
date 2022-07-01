<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunci_model extends MY_Model
{

    protected $_table_name = 'kunci';
    protected $_primary_key = 'id_kunci';
    protected $_order_by = 'id_kunci';
    protected $_order_by_type = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }
    function gen_tabel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
    {
        $user_session = $this->session->userdata;
        $id = $this->encryptor->enkrip('dekrip', $user_session['id']);
        $sql = "
            SELECT 
            
            (@row:=@row+1) AS nomor,
            a.`id_kunci`,
            a.`id_user`, 
            a.`nama_kunci`,
            a.`keterangan`
            FROM 
            `tb_kunci` as a
            , (SELECT @row := 0) r WHERE 1=1 AND `id_user`=" . $id . "
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
            1 => 'a.`nama_kunci`',
            2 => 'a.`keterangan`',

        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }

    function validKunci($kunci)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $as  = $this->db->get();

        foreach ($as->result() as $p) {
            # code...
            if ($kunci == $p->kunci) {
                return 1;
            }
        }
    }
    function getKunci($id_user)
    {
        $this->db->select(['id_kunci', 'nama_kunci']);
        $this->db->where(['id_user' => $id_user]);
        $this->db->from('{PRE}' . $this->_table_name);
        $query = $this->db->get();
        return $query->result();
    }
}