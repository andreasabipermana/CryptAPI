<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ubah extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model', 'Endpoint_detail_model']);
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
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                    ));
                } else {
                    $json['status'] = 2;
                    $json['csrfHash'] = $this->security->get_csrf_hash();
                    $json['pesan']     = "Email sudah terdaftar di database!";
                    echo json_encode($json);
                }
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Username sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }

    public function project()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id_project');
            $id_user = $this->session->userdata('id');
            $nama = $this->input->post('nama');
            $namalama = $this->input->post('namalama');
            $valid = $this->Project_model->validProject($nama);

            if ($nama == $namalama || $valid == 0) {

                $data = array(
                    'nama' => htmlspecialchars($this->input->post('nama')),
                    'id_user' => $this->encryptor->enkrip('dekrip', $id_user),
                    'keterangan' => htmlspecialchars($this->input->post('keterangan')),

                );
                $this->Project_model->update($data, ['id_project' => $this->encryptor->enkrip('dekrip', $id)]);
                echo json_encode(array(
                    'status' => 1,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                ));
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Nama Project sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }

    public function objek_kriptografi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id_objek_kriptografi');
            $id_project = $this->input->post('id_project');
            $nama = $this->input->post('nama');
            $namalama = $this->input->post('namalama');
            $valid = $this->Objek_model->validObjek($nama);

            if ($nama == $namalama || $valid == 0) {

                $data = array(
                    'nama' => htmlspecialchars($this->input->post('nama')),
                    'id_project' => $this->encryptor->enkrip('dekrip', $id_project),
                    'keterangan' => htmlspecialchars($this->input->post('keterangan')),

                );
                $this->Objek_model->update($data, ['id_objek_kriptografi' => $this->encryptor->enkrip('dekrip', $id)]);
                echo json_encode(array(
                    'status' => 1,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                ));
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Nama Objek sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }

    public function kunci()
    {
        $this->form_validation->set_rules('nama_kunci', 'Nama Kunci', 'trim|required');
        $this->form_validation->set_rules('kunci', 'Kunci', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id_kunci');
            $kunci = $this->input->post('kunci');
            $kuncilama = $this->input->post('kuncilama');
            $valid = $this->Kunci_model->validKunci($kunci);
            $id_user = $this->session->userdata('id');

            if ($kunci == $kuncilama || $valid == 0) {

                $data = array(
                    'nama_kunci' => htmlspecialchars($this->input->post('nama_kunci')),
                    'kunci' => $this->input->post('kunci'),
                    'id_user' => $this->encryptor->enkrip('dekrip', $id_user),
                    'keterangan' => htmlspecialchars($this->input->post('keterangan')),

                );
                $this->Kunci_model->update($data, ['id_kunci' => $this->encryptor->enkrip('dekrip', $id)]);
                echo json_encode(array(
                    'status' => 1,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                ));
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Kunci sudah terdaftar di database, silahkan bangkitkan ulang !";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }

    public function endpoint_api()
    {
        $this->form_validation->set_rules('id_project', 'Project', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Endpoint', 'trim|required');
        $this->form_validation->set_rules('rute', 'Rute Endpoint', 'trim|required');
        $this->form_validation->set_rules('api_key', 'Kunci API', 'trim|required');
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {

            $id = $this->input->post('id_endpoint');
            $api_key = $this->input->post('api_key');
            $api_keylama = $this->input->post('api_keylama');
            $rute = $this->input->post('rute');
            $rutelama = $this->input->post('rutelama');

            $valid = $this->Endpoint_model->validAPIkey($api_key);
            $valid2 = $this->Endpoint_model->validRute($rute);
            $id_user = $this->session->userdata('id');

            if ($rute == $rutelama || $valid2 == 0) {
                if ($api_key == $api_keylama || $valid == 0) {

                    $data = array(
                        'id_project' => $this->input->post('id_project'),
                        'nama' => htmlspecialchars($this->input->post('nama')),
                        'rute' => htmlspecialchars($this->input->post('rute')),
                        'api_key' => $this->input->post('api_key'),
                        'aktif' => $this->input->post('aktif'),
                        'id_user' => $this->encryptor->enkrip('dekrip', $id_user),

                    );
                    $this->Endpoint_model->update($data, ['id_endpoint' => $this->encryptor->enkrip('dekrip', $id)]);
                    echo json_encode(array(
                        'status' => 1,
                        'csrfName' => $this->security->get_csrf_token_name(),
                        'csrfHash' => $this->security->get_csrf_hash(),
                    ));
                } else {
                    $json['status'] = 2;
                    $json['csrfHash'] = $this->security->get_csrf_hash();
                    $json['pesan']     = "KunciAPI sudah terdaftar di database!";
                    echo json_encode($json);
                }
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Rute sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }

    public function detail_endpoint_api()
    {
        $this->form_validation->set_rules('id_objek_kriptografi', 'Objek Kriptografi', 'required');
        $this->form_validation->set_rules('id_kunci', 'Kunci Kriptografi', 'required');
        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

        if ($this->form_validation->run() == TRUE) {


            $id = $this->input->post('id_detail_endpoint');
            $id_objek_kriptografi = $this->input->post('id_objek_kriptografi');
            $id_objek_kriptografi_lama = $this->input->post('id_objek_kriptografi_lama');

            $valid = $this->Objek_model->validObjekById($id_objek_kriptografi);

            if ($id_objek_kriptografi == $id_objek_kriptografi_lama || $valid == 0) {

                $data = array(
                    'id_endpoint' => $this->input->post('id_endpoint'),
                    'id_objek_kriptografi' => $this->input->post('id_objek_kriptografi'),
                    'id_kunci' => $this->input->post('id_kunci'),

                );
                $this->Endpoint_detail_model->update($data, ['id_detail_endpoint' => $this->encryptor->enkrip('dekrip', $id)]);
                echo json_encode(array(
                    'status' => 1,
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                ));
            } else {
                $json['status'] = 2;
                $json['csrfHash'] = $this->security->get_csrf_hash();
                $json['pesan']     = "Objek sudah terdaftar di database!";
                echo json_encode($json);
            }
        } else {
            $this->input_error();
        }
    }
}