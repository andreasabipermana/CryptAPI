<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model', 'Endpoint_detail_model']);
    }

    public function user($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->User_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }

    public function project($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->Project_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }

    public function objek_kriptografi($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->Objek_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }

    public function kunci($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->Kunci_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }

    public function endpoint_api($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->Endpoint_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }

    public function detail_endpoint_api($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->encryptor->enkrip('dekrip', $id);
            $hapus = $this->Endpoint_detail_model->delete($id);
            echo json_encode(array(
                "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>",
            ));
        }
    }
}