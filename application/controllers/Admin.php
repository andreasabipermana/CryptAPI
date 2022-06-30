<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model']);
    }

    public function index()
    {
        $data = [
            'konten' => 'dashboard',
            'getProjectCount' => $this->Project_model->count(),
            'getObjekCount' => $this->Objek_model->count(),
            'getUserCount' => $this->User_model->count(),
            'getEndpointCount' => $this->Endpoint_model->count()
        ];
        $this->load->view('admin', $data);
    }
    public function user()
    {
        $data = [
            'konten' => 'user',
            'breadcrumb' => 'User',
            'tabel' => 'user',

        ];
        $this->load->view('admin', $data);
    }

    public function statistik_user()
    {
        $data = [
            'konten' => 'dashboard',

        ];
        $this->load->view('admin', $data);
    }
}