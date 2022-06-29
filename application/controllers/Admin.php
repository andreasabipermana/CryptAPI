<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller 
{

	public function __construct() { 
		parent::__construct();
    }

    public function index(){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('admin',$data);
    }
    public function user(){
        $data = [
            'konten' => 'user',
            'breadcrumb' => 'User',
            'tabel' => 'user',
        ];
        $this->load->view('admin',$data);
    }

    public function statistik_user(){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('admin',$data);
    }



}