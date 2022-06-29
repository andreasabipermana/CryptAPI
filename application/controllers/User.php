<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{

	public function __construct() { 
		parent::__construct();
        

         
    }

    public function index(){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user',$data);
    }
    public function project(){
        $data = [
            'breadcrumb' => 'Project',
            'konten' => 'project'
        ];
        $this->load->view('user',$data);
    }

    public function objek_kriptografi($param=NULL){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user',$data);
    }
    public function kunci(){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user',$data);
    }

    public function endpoint_api(){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user',$data);
    }

    public function detail_endpoint_api($param=NULL){
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user',$data);
    }

    public function statistik_akses(){

    }

    public function grafik_statistik($param=NULL){
        
    }



}