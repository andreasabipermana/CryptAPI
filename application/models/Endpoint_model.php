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

    function gen_tabel2($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $id_user)
    {
        $id_user = $this->encryptor->enkrip('dekrip', $id_user);

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
            , (SELECT @row := 0) r WHERE 1=1 AND a.`id_project`= b.`id_project` AND a.`id_user`=" . $id_user . "
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

    function validEndpointReq($rute, $api_key)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $this->db->where('rute', $rute);
        $this->db->where('api_key', $api_key);
        $this->db->where(['aktif' => 1]);
        $this->db->limit(1);
        return $this->db->get();
    }

    function getEndpointbyAPIKey($api_key, $id_objek_kriptografi)
    {
        // $this->db->from('{PRE}' . $this->_table_name);
        // $this->db->join('{PRE}detail_endpoint', '{PRE}' . $this->_table_name . '.id_endpoint  = {PRE}detail_endpoint.id_endpoint');
        // $this->db->where(['{PRE}' . $this->_table_name . '.api_key' => $api_key]);
        // $this->db->where(['{PRE}' . $this->_table_name . '.id_project' => ]);
        $sql = "
            SELECT 
            a.`id_endpoint`,
            a.`id_project`,
            d.`id_objek_kriptografi`,
            a.`id_user`,
            d.`nama` AS nama_objek,
            a.`nama`,
            a.`api_key`,
            a.`rute`,
            c.`kunci`

            FROM
            `tb_endpoint` as a,
            `tb_detail_endpoint` as b,
            `tb_kunci` as c,
            `tb_objek_kriptografi` as d

            WHERE 
            a.`id_endpoint`=b.`id_endpoint` AND
            b.`id_kunci`=c.`id_kunci` AND
            d.`id_objek_kriptografi`=b.`id_objek_kriptografi` AND
            a.`api_key` = ? AND
            b.`id_objek_kriptografi` = ?

           
        
        
        ";
        $query = $this->db->query($sql, [$api_key, $id_objek_kriptografi]);
        return $query->row_array();
    }
}