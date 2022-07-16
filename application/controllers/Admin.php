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
            'konten' => 'statistik_user',
            'breadcrumb' => 'statistik_user',
            'tabel' => 'statistik_user',

        ];
        $this->load->view('admin', $data);
    }

    public function endpoint_statistik_user($id_user = NULL)

    {
        if ($this->uri->segment(2) == 'endpoint_statistik_user' && $this->uri->segment(3) != '') {

            $user = $this->User_model->get($this->encryptor->enkrip('dekrip', $id_user), FALSE);
            $data = [
                'konten' => 'endpoint_statistik_user',
                'breadcrumb' => 'Endpoint API User',
                'tabel' => 'endpoint_statistik_user',
                'id_user' => $id_user,
                'nama_user' => $user->nama
            ];
            $this->load->view('admin', $data);
        } else {
            redirect(base_url("Admin/statistik_user"));
        }
    }

    public function grafik_statistik_user($id = NULL)
    {
        if ($this->uri->segment(2) == 'grafik_statistik_user' && $this->uri->segment(3) != '') {
            $endpoint_api = $this->Endpoint_model->get($this->encryptor->enkrip('dekrip', $id), FALSE);
            $id_project = $endpoint_api->id_project;
            $project = $this->Project_model->get($id_project, FALSE);
            $data = [
                'konten' => 'grafik_statistik_user',
                'breadcrumb' => 'Detail Statistik Endpoint API',
                'breadcrumb2' => 'Log Akses',
                'tabel' => 'log_akses',
                'id_endpoint' => $id,
                'nama_project' => $project->nama

            ];
            $this->load->view('admin', $data);
        } else {
            redirect(base_url("Admin/statistik_user"));
        }
    }
}