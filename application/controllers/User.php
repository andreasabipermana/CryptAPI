<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model', 'Endpoint_detail_model']);
    }

    public function index()
    {
        $id_user = $this->encryptor->enkrip('dekrip', $this->session->userdata('id'));
        $data = [
            'konten' => 'dashboard',
            'getProjectCount' => $this->Project_model->count(['id_user' => $id_user]),
            'getObjekCount' => $this->Objek_model->countObjekByUser($id_user),
            'getKunciCount' => $this->Kunci_model->count(['id_user' => $id_user]),
            'getEndpointCount' => $this->Endpoint_model->count(['id_user' => $id_user])
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
        if ($this->uri->segment(2) == 'objek_kriptografi' && $this->uri->segment(3) != '') {
            $project = $this->Project_model->get($this->encryptor->enkrip('dekrip', $id), FALSE);
            $data = [
                'konten' => 'objek_kriptografi',
                'breadcrumb' => 'Objek Kriptografi',
                'tabel' => 'objek_kriptografi',
                'id_project' => $id,
                'nama_project' => $project->nama

            ];
            $this->load->view('user', $data);
        } else {
            redirect(base_url("User/project"));
        }
    }
    public function kunci()
    {
        $data = [
            'konten' => 'kunci',
            'breadcrumb' => 'kunci',
            'tabel' => 'kunci'
        ];
        $this->load->view('user', $data);
    }

    public function endpoint_api()
    {
        $id_user = $this->encryptor->enkrip('dekrip', $this->session->userdata('id'));
        $data = [
            'konten' => 'endpoint_api',
            'breadcrumb' => 'endpoint_api',
            'tabel' => 'endpoint_api',
            'getNamaProject' => $this->Project_model->getProject($id_user)
        ];
        $this->load->view('user', $data);
    }

    public function detail_endpoint_api($id = NULL)
    {
        if ($this->uri->segment(2) == 'detail_endpoint_api' && $this->uri->segment(3) != '') {
            $endpoint_api = $this->Endpoint_model->get($this->encryptor->enkrip('dekrip', $id), FALSE);
            $id_user = $this->encryptor->enkrip('dekrip', $this->session->userdata('id'));
            $id_project = $endpoint_api->id_project;
            $project = $this->Project_model->get($id_project, FALSE);
            $data = [
                'konten' => 'detail_endpoint_api',
                'breadcrumb' => 'Detail Endpoint API',
                'tabel' => 'detail_endpoint_api',
                'id_endpoint' => $id,
                'nama_endpoint' => $endpoint_api->nama,
                'rute' => $endpoint_api->rute,
                'api_key' => $endpoint_api->api_key,
                'nama_project' => $project->nama,
                'getNamaObjek' => $this->Objek_model->getObjekEndpoint($id_user, $id_project),
                'getNamaKunci' => $this->Kunci_model->getKunci($id_user)

            ];
            $this->load->view('user', $data);
        } else {
            redirect(base_url("User/endpoint_api"));
        }
    }

    public function statistik_akses()
    {
    }

    public function grafik_statistik($param = NULL)
    {
    }
}