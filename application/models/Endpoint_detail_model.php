<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Endpoint_detail_model extends MY_Model
{

    protected $_table_name = 'detail_endpoint';
    protected $_primary_key = 'id_detail_endpoint';
    protected $_order_by = 'id_detail_endpoint';
    protected $_order_by_type = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }
    function gen_tabel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $id_endpoint)
    {
        $user_session = $this->session->userdata;
        $id = $this->encryptor->enkrip('dekrip', $user_session['id']);
        $id_endpoint = $this->encryptor->enkrip('dekrip', $id_endpoint);

        $sql = "
            SELECT 
            
            (@row:=@row+1) AS nomor,
            a.`id_detail_endpoint`,
            d.`nama` AS nama_endpoint,
            b.`nama` AS nama_objek,
            c.`nama_kunci`

            FROM 
            `tb_detail_endpoint` as a,
            `tb_objek_kriptografi` as b,
            `tb_kunci` as c,
            `tb_endpoint` as d,
            (SELECT @row := 0) r WHERE 1=1 AND
            a.`id_objek_kriptografi`= b.`id_objek_kriptografi` AND a.`id_kunci`=c.`id_kunci` AND a.`id_endpoint`=d.`id_endpoint`
            AND b.`id_project`=d.`id_project`
            AND d.`id_user`=" . $id . " 
            AND a.`id_endpoint`=" . $id_endpoint . " 
            ";

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " AND ( ";
            $sql .= "
		 d.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR b.`nama` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR c.`nama_kunci` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 ";
            $sql .= " ) ";
        }

        $data['totalFiltered']    = $this->db->query($sql)->num_rows();

        $columns_order_by = array(

            0 => 'nomor',
            1 => 'd.`nama`',
            2 => 'b.`nama`',
            3 => 'c.`nama_kunci`'
        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }
}