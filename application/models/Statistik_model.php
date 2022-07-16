<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistik_model extends MY_Model
{

    protected $_table_name = 'statistik';
    protected $_primary_key = 'id_statistik';
    protected $_order_by = 'id_statistik';
    protected $_order_by_type = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    function gen_tabel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $id_endpoint)
    {
        $id_endpoint = $this->encryptor->enkrip('dekrip', $id_endpoint);
        $sql = "
            SELECT 
            
            (@row:=@row+1) AS nomor,
            a.`id_statistik`,
            a.`id_endpoint`,
            a.`objek`,
            a.`aksi`,
            a.`ip_address`,
            a.`user_agent`

            FROM 
            `tb_statistik` as a,
            (SELECT @row := 0) r WHERE 1=1 AND a.`id_endpoint`=" . $id_endpoint . "
            ";

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " AND ( ";
            $sql .= "
		 a.`objek` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`ip_address` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 OR a.`user_agent` LIKE '%" . $this->db->escape_like_str($like_value) . "%' 
		 
		 ";
            $sql .= " ) ";
        }

        $data['totalFiltered']    = $this->db->query($sql)->num_rows();

        $columns_order_by = array(

            0 => 'nomor',
            1 => 'a.`objek`',
            2 => 'a.`aksi`',
            3 => 'a.`ip_address`',
            3 => 'a.`user_agent`',

        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }

    function get_statistic()
    {

        $this->db->select("Count({PRE}statistik.id_statistik) AS total_visit,
			  Date_Format({PRE}statistik.waktu, '%d/%m') AS date", FALSE);
        $this->db->where(
            "YEAR({PRE}statistik.waktu) = YEAR(NOW()) AND
				 DATE({PRE}statistik.waktu) >= NOW() - INTERVAL 15 DAY"
        );

        $this->db->group_by('date');
        $this->db->limit(15, 0);
        $this->_order_type = 'ASC';
        return parent::get_by();
    }

    function get_30()
    {
        $this->db->select("*", FALSE);
        $this->db->limit(30, 0);
        $this->_order_type = 'DESC';
        return parent::get_by();
    }

    function get_by_hour()
    {
        $this->db->select("CONCAT(HOUR(waktu), ':00-', 
			CONCAT( HOUR(waktu)+1, ':00' ) ) AS jam, 
			count(*) as jumlah");
        $this->db->group_by("HOUR(waktu)");
        $this->_order_by = 'jam';
        $this->_order_type = 'ASC';
        return parent::get_by("DATE(waktu) = CURDATE()");
    }

    function perHariEnkrip()
    {
        $this->db->select("CONCAT(DAY(waktu), ' ' , MONTHNAME(waktu) ) AS x, count(*) as y");
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where('aksi', 'Enkrip');
        return parent::get_by();
    }

    function perHariDekrip()
    {
        $this->db->select("CONCAT(DAY(waktu), ' ' , MONTHNAME(waktu) ) AS x, 
        count(*) as y");
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where('aksi', 'Dekrip');
        return parent::get_by();
    }

    function perHariEnkripById($id_endpoint)
    {
        $this->db->select("CONCAT(DAY(waktu), ' ' , MONTHNAME(waktu) ) AS x, count(*) as y");
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where('aksi', 'Enkrip');
        $this->db->where('id_endpoint', $id_endpoint);
        return parent::get_by();
    }

    function perHariDekripById($id_endpoint)
    {
        $this->db->select("CONCAT(DAY(waktu), ' ' , MONTHNAME(waktu) ) AS x, 
        count(*) as y");
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where('aksi', 'Dekrip');
        $this->db->where('id_endpoint', $id_endpoint);
        return parent::get_by();
    }

    function perHariEnkripByUser($id_user)
    {
        $this->db->select("CONCAT(DAY({PRE}" . $this->_table_name . ".waktu), ' ' , MONTHNAME({PRE}" . $this->_table_name . ".waktu) ) AS x, count(*) as y");

        $this->db->from('{PRE}' . $this->_table_name);
        $this->db->join('{PRE}endpoint', '{PRE}' . $this->_table_name . '.id_endpoint  = {PRE}endpoint.id_endpoint');
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where(['{PRE}endpoint.id_user' => $id_user]);
        $this->db->where('{PRE}' . $this->_table_name . '.aksi', 'Enkrip');
        $query = $this->db->get();
        return $query->result();
    }

    function perHariDekripByUser($id_user)
    {
        $this->db->from('{PRE}' . $this->_table_name);
        $this->db->join('{PRE}endpoint', '{PRE}' . $this->_table_name . '.id_endpoint  = {PRE}endpoint.id_endpoint');
        $this->db->select("CONCAT(DAY({PRE}" . $this->_table_name . ".waktu), ' ' , MONTHNAME({PRE}" . $this->_table_name . ".waktu) ) AS x, count(*) as y");
        $this->db->group_by("x");
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        $this->db->where(['{PRE}endpoint.id_user' => $id_user]);
        $this->db->where('{PRE}' . $this->_table_name . '.aksi', 'Dekrip');
        $query = $this->db->get();
        return $query->result();
    }


    function get_by_dayEnkrip()
    {
        $this->db->select("count(*) as y, DATE(waktu) as x");
        $this->db->limit(0, 15);
        $this->db->group_by("x");
        $this->db->where('aksi', 'Enkrip');
        $this->_order_by = 'x';
        $this->_order_type = 'DESC';
        return parent::get_by("MONTH(waktu) = MONTH(CURDATE())");
    }
}