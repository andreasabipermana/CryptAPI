<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
    }

    public function login()
    {

        if ($this->input->is_ajax_request()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[40]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[40]');

            if ($this->form_validation->run() == TRUE) {
                $username     = $this->input->post('username');
                $password    = $this->encryptor->enkrip('enkrip', $this->input->post('password'));


                $data_user = $this->User_model->get_by(['username' => $username, 'password' => $password, 'aktif' => 1], 1, NULL, FALSE, NULL);

                $data_user = $this->site->be_array($data_user);
                if (!empty($data_user)) {
                    $data_session = array(
                        'id' => $this->encryptor->enkrip('enkrip', $data_user[0]['id_user']),
                        'nama' => $data_user[0]['nama'],
                        'email' => $data_user[0]['email'],
                        'username' => $data_user[0]['username'],
                        'level' => $data_user[0]['level'],
                    );


                    $this->session->set_userdata($data_session);

                    $json['status']        = 1;
                    if ($this->session->userdata('level') == 'Admin') {
                        $json['url_home']     = site_url('Admin');
                        echo json_encode($json);
                    } else if ($this->session->userdata('level') == 'User') {
                        $json['url_home']     = site_url('User');
                        echo json_encode($json);
                    }
                } else {
                    $json['status']        = 2;
                    echo json_encode($json);
                }
            } else {
                $this->input_error();
                $json['status']        = 3;
                echo json_encode($json);
            }
        } else {
            $this->load->view('login/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->sess_destroy();
        redirect('Auth/login');
    }
}