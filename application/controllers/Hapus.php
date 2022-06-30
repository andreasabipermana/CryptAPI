<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
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
}