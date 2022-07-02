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
}