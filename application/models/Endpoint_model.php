<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Endpoint_model extends MY_Model
{

    protected $_table_name = 'endpoint';
    protected $_primary_key = 'id_endpoint';
    protected $_order_by = 'id_endpoint';
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
            a.`id_endpoint`,
            b.`nama` AS nama_project,
            a.`nama`,
            a.`aktif`

            FROM 
            `tb_endpoint` as a,
            `tb_project` as b
            , (SELECT @row := 0) r WHERE 1=1 AND a.`id_project`= b.`id_project` AND a.`id_user`=" . $id . "
            ";

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " AND ( ";
            $sql .= "
		 a.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR b.`nama_project` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 
		 ";
            $sql .= " ) ";
        }

        $data['totalFiltered']    = $this->db->query($sql)->num_rows();

        $columns_order_by = array(

            0 => 'nomor',
            1 => 'a.`nama`',
            2 => 'b.`nama_project`',
            3 => 'a.`aktif`',

        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }

    function validAPIkey($api_key)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $as  = $this->db->get();

        foreach ($as->result() as $p) {
            # code...
            if ($api_key == $p->api_key) {
                return 1;
            }
        }
    }

    function validRute($rute)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $as  = $this->db->get();

        foreach ($as->result() as $p) {
            # code...
            if ($rute == $p->rute) {
                return 1;
            }
        }
    }
}