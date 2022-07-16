<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Endpoint_model', 'Objek_model', 'Statistik_model']);
    }

    public function index()
    {
    }

    public function api($request = NULL)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $valid_req = $this->Endpoint_model->validRute($request);
        if ($valid_req == 1 && isset($input['objek']) && isset($input['aksi']) && isset($input['api-key'])) {
            $valid_auth_req = $this->Endpoint_model->validEndpointReq($request, $input['api-key']);
            if ($valid_auth_req->num_rows() == 1) {
                $valid_objek = $this->Objek_model->validObjek($input['objek']);
                if ($valid_objek == 1) {
                    $id_objek = $this->Objek_model->getObjekID($input['objek']);
                    $data = $this->Endpoint_model->getEndpointbyAPIKey($input['api-key'], $id_objek);
                    if ($input['aksi'] == 'enkrip' && isset($input['plaintext'])) {
                        $plaintext = $input['plaintext'];
                        $plaintext = base64_decode($plaintext);
                        $hasil = $this->encryptor->enkrip_service('enkrip', $plaintext, $data['kunci']);
                        $user_agent = $this->agent->agent_string();
                        if (empty($user_agent)) {
                            $user_agent = 'Unknown';
                        }

                        $statistik =  [
                            'id_endpoint' => $data['id_endpoint'],
                            'objek' => $data['nama_objek'],
                            'aksi' => $input['aksi'],
                            'waktu' => date('Y-m-d H:i:s'),
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'user_agent' => $user_agent
                        ];

                        $this->Statistik_model->insert($statistik);

                        $output = [
                            'status' => 'Sukses',
                            'waktu' => date('Y-m-d H:i:s'),
                            'ciphertext' => $hasil

                        ];

                        echo json_encode($output);
                    } else if ($input['aksi'] == 'dekrip' && isset($input['ciphertext'])) {
                        $ciphertext = $input['ciphertext'];
                        $hasil = $this->encryptor->enkrip_service('dekrip', $ciphertext, $data['kunci']);
                        if (empty($user_agent)) {
                            $user_agent = 'Unknown';
                        }

                        $statistik =  [
                            'id_endpoint' => $data['id_endpoint'],
                            'objek' => $data['nama_objek'],
                            'aksi' => $input['aksi'],
                            'waktu' => date('Y-m-d H:i:s'),
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'user_agent' => $user_agent
                        ];



                        $this->Statistik_model->insert($statistik);
                        $output = [
                            'status' => 'Sukses',
                            'waktu' => date('Y-m-d H:i:s'),
                            'plaintext' => $hasil

                        ];
                        echo json_encode($output);
                    } else if (!isset($input['ciphertext']) || !isset($input['plaintext'])) {
                        $json['pesan'] = "Parameter proses enkripsi tidak ditemukan";
                    } else {
                        $json['pesan'] = "Aksi tidak ditemukan";
                    }
                } else {
                    $json['pesan']     = "Objek tidak ditemukan";
                    echo json_encode($json);
                }
            } else {
                $json['pesan'] = "Unauthorized Access";
                echo json_encode($json);
            }
        } else {
            $json['pesan'] = "Forbidden";
            echo json_encode($json);
        }
    }
}