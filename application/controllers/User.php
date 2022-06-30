<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
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
            'getKunciCount' => $this->Kunci_model->count(),
            'getEndpointCount' => $this->Endpoint_model->count()
        ];
        $this->load->view('user', $data);
    }
    public function project()
    {
        $data = [
            'breadcrumb' => 'Project',
            'konten' => 'project',
            'tabel' => 'project',
        ];
        $this->load->view('user', $data);
    }

    public function objek_kriptografi($id = NULL)
    {
        if ($this->uri->segment(2) == 'objek_kriptografi' && $this->uri->segment(3) == '') {
            $id_project = $this->encryptor->enkrip('dekrip', $id);
            $data = [
                'konten' => 'objek_kriptografi',
                'breadcrumb' => 'Objek Kriptografi',
                'tabel' => 'objek_kriptografi',
                'id_project' => $id_project

            ];
            $this->load->view('user', $data);
        } else {
            redirect(base_url("User/project"));
        }
    }
    public function kunci()
    {
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user', $data);
    }

    public function endpoint_api()
    {
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user', $data);
    }

    public function detail_endpoint_api($param = NULL)
    {
        $data = [
            'konten' => 'dashboard',
        ];
        $this->load->view('user', $data);
    }

    public function statistik_akses()
    {
    }

    public function grafik_statistik($param = NULL)
    {
    }
}