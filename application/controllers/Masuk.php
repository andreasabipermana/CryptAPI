<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends MY_Controller 
{

	public function __construct() { 
		parent::__construct();
	}

	public function login()
	{
		if()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','trim|required|min_length[3]|max_length[40]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[3]|max_length[40]');
			$this->form_validation->set_message('required','%s harus diisi !');
			
			if($this->form_validation->run() == TRUE)
			{
				$username 	= $this->input->post('username');
				$password	= sha1($this->input->post('password'));
			
				$valid = $this->m_user->validasi_login($username, $password);
				if ($this->input->post('secutity_code') == $this->session->userdata('mycaptcha'))
				{

					if($valid ->num_rows() > 0)
					{
						$data_user = $valid->row();
						$data_session = array(
							'id' => $data_user->id_user,
							'nip' => $data_user->nip,
							'nama_program' => $data_user->nama_program,
							'email' => $data_user->email,
							'id_provinsi' => $data_user->id_provinsi,
							'kd_kab' => $data_user->kd_kab,
							'kd_kec' => $data_user->kd_kec,
							'kd_desa' => $data_user->kd_desa,
							'level' => $data_user->level
							);


						$this->session->set_userdata($data_session);

						$json['status']		= 1;
						if ($this->session->userdata('level') == '1') {
							$json['url_home'] 	= site_url('dashboard/sso');

						} else if ($this->session->userdata('level') == '2') {
							$json['url_home'] 	= site_url('nasional');

						} else if ($this->session->userdata('level') == '3') {
							$json['url_home'] 	= site_url('provinsi');

						} else if ($this->session->userdata('level') == '4') {
							$json['url_home'] 	= site_url('kabupaten');

						} else if ($this->session->userdata('level') == '5') {
							$json['url_home'] 	= site_url('kecamatan');

						} else if ($this->session->userdata('level') == '6') {
							$json['url_home'] 	= site_url('desa');

						} else {
							$json['url_home'] 	= site_url('nofound');
						}
						echo json_encode($json);

					}else{
						$this->query_error("Login Gagal, Cek kembali Username / password anda!");
					}
				}
				else{
					$json['status']		= 3;
					echo json_encode($json);
				}	
			}
			else
			{
				$this->input_error();
			}

		}

		else
		{
		$this->load->view('login/login');
		}
	}
}