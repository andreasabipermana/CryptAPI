<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ubah extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    function input_error()
    {
        $json['status'] = 0;
        $json['csrfHash'] = $this->security->get_csrf_hash();

        $json['pesan']     = validation_errors();
        echo json_encode($json);
    }

    function query_error($pesan = "Terjadi kesalahan, coba lagi !")
    {
        $json['status'] = 2;
        $json['csrfHash'] = $this->security->get_csrf_hash();

        $json['pesan']     = "<div class='alert alert-danger error_validasi'>" . $pesan . "</div>";
        echo json_encode($json);
    }

    public function user()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ', 'trim|required|valid_email');
        $this->form_validation->set_rules('level', 'Level ', 'required');
        $this->form_validation->set_rules('aktif', 'aktif ', 'required');
        $this->form_validation->set_rules('password', 'password ', 'min_length[3]|max_length[40]');
        $this->form_validation->set_rules('username', 'username ', 'required|min_length[3]|max_length[40]');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id_user');
            $pass = $this->input->post('password');
            $username = $this->input->post('username');
            $email = $this->input->post('email');

            $usernameLama = $this->input->post('usernamelama');
            $emailLama = $this->input->post('emaillama');
            $valid = $this->User_model->validUsername($username);
            $valid2 = $this->User_model->validEmail($email);

            if ($username == $usernameLama || $valid == 0) {

                if ($email == $emailLama || $valid2->num_rows() == 0) {

                    if (!empty($pass)) {
                        $data = array(
                            'nama' => $this->input->post('nama'),
                            'email' => htmlspecialchars($this->input->post('email')),
                            'level' => $this->input->post('level'),
                            'aktif' => $this->input->post('aktif'),
                            'username' => htmlspecialchars($this->input->post('username')),
                            'password' => $this->encryptor->enkrip('enkrip', $this->input->post('password')),

                        );
                    } else {
                        $data = array(
                            'nama' => $this->input->post('nama'),
                            'email' => htmlspecialchars($this->input->post('email')),
                            'level' => $this->input->post('level'),
                            'aktif' => $this->input->post('aktif'),
                            'username' => htmlspecialchars($this->input->post('username')),
                            'password' => $this->encryptor->enkrip('enkrip', $this->input->post('password')),

                        );
                    }
                    $this->User_model->update($data, ['id_user' => $this->encryptor->enkrip('dekrip', $id)]);
                    echo json_encode(array(
                        'status' => 1,
                        // 'csrfName' => $this->security->get_csrf_token_name(),
                        // 'csrfHash' => $this->security->get_csrf_hash(),
                    ));
                } else {
                    $json['status'] = 2;
                    // $json['csrfHash'] = $this->security->get_csrf_hash();
                    $json['pesan']     = "Email sudah terdaftar di database!";
                    echo json_encode($json);
                }
            } else {
                $json['status'] = 2;
                // $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Username sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }
}