<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tambah extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model']);
	}

	function input_error()
	{
		$json['status'] = 0;
		$json['csrfHash'] = $this->security->get_csrf_hash();

		$json['pesan'] 	= validation_errors();
		echo json_encode($json);
	}

	function query_error($pesan = "Terjadi kesalahan, coba lagi !")
	{
		$json['status'] = 2;
		$json['csrfHash'] = $this->security->get_csrf_hash();

		$json['pesan'] 	= "<div class='alert alert-danger error_validasi'>" . $pesan . "</div>";
		echo json_encode($json);
	}

	public function user()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email ', 'trim|required|valid_email');
		$this->form_validation->set_rules('level', 'Level ', 'required');
		$this->form_validation->set_rules('aktif', 'aktif ', 'required');
		$this->form_validation->set_rules('password', 'password ', 'required|min_length[3]|max_length[40]');
		$this->form_validation->set_rules('username', 'username ', 'required|min_length[3]|max_length[40]');
		$this->form_validation->set_message('required', '%s harus diisi !');
		$this->form_validation->set_message('alpha_numeric_spaces', '%s Harus huruf / angka !');

		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$valid = $this->User_model->validUsername($username);
			$valid2 = $this->User_model->validEmail($email);

			if ($valid == 0) {
				if ($valid2->num_rows() == 0) {

					$data = array(
						'nama' => $this->input->post('nama'),
						'email' => htmlspecialchars($this->input->post('email')),
						'level' => $this->input->post('level'),
						'aktif' => $this->input->post('aktif'),
						'username' => htmlspecialchars($this->input->post('username')),
						'password' => $this->encryptor->enkrip('enkrip', $this->input->post('password')),

					);
					$insert = $this->User_model->insert($data);

					if ($insert) {
						echo json_encode(array(
							'status' => 1,
							'csrfName' => $this->security->get_csrf_token_name(),
							'csrfHash' => $this->security->get_csrf_hash(),
						));
					} else {
						$this->query_error();
					}
				} else {
					$json['status'] = 2;
					$json['csrfHash'] = $this->security->get_csrf_hash();
					$json['pesan'] 	= "Email sudah terdaftar di database!";
					echo json_encode($json);
				}
			} else {
				$json['status'] = 2;
				$json['csrfHash'] = $this->security->get_csrf_hash();
				$json['pesan'] 	= "Username sudah terdaftar di database!";
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
			$nama = $this->input->post('nama');
			$valid = $this->Project_model->validProject($nama);
			$id_user = $this->session->userdata('id');

			if ($valid == 0) {
				$data = array(
					'nama' => htmlspecialchars($this->input->post('nama')),
					'id_user' => $this->encryptor->enkrip('dekrip', $id_user),
					'keterangan' => htmlspecialchars($this->input->post('keterangan')),

				);
				$insert = $this->Project_model->insert($data);

				if ($insert) {
					echo json_encode(array(
						'status' => 1,
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
					));
				} else {
					$this->query_error();
				}
			} else {
				$json['status'] = 2;
				$json['csrfHash'] = $this->security->get_csrf_hash();
				$json['pesan'] 	= "Project sudah terdaftar di database!";
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
			$nama = $this->input->post('nama');
			$valid = $this->Objek_model->validObjek($nama);
			$id_project = $this->input->post('id_project');


			if ($valid == 0) {
				$data = array(
					'nama' => htmlspecialchars($this->input->post('nama')),
					'id_project' => $this->encryptor->enkrip('dekrip', $id_project),
					'keterangan' => htmlspecialchars($this->input->post('keterangan')),

				);
				$insert = $this->Objek_model->insert($data);

				if ($insert) {
					echo json_encode(array(
						'status' => 1,
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
					));
				} else {
					$this->query_error();
				}
			} else {
				$json['status'] = 2;
				$json['csrfHash'] = $this->security->get_csrf_hash();
				$json['pesan'] 	= "Objek sudah terdaftar di database!";
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
			$kunci = $this->input->post('kunci');
			$valid = $this->Kunci_model->validKunci($kunci);
			$id_user = $this->session->userdata('id');

			if ($valid == 0) {
				$data = array(
					'nama_kunci' => htmlspecialchars($this->input->post('nama_kunci')),
					'kunci' => $this->input->post('kunci'),
					'id_user' => $this->encryptor->enkrip('dekrip', $id_user),
					'keterangan' => htmlspecialchars($this->input->post('keterangan')),

				);
				$insert = $this->Kunci_model->insert($data);

				if ($insert) {
					echo json_encode(array(
						'status' => 1,
						'csrfName' => $this->security->get_csrf_token_name(),
						'csrfHash' => $this->security->get_csrf_hash(),
					));
				} else {
					$this->query_error();
				}
			} else {
				$json['status'] = 2;
				$json['csrfHash'] = $this->security->get_csrf_hash();
				$json['pesan'] 	= "Kunci sudah terdaftar di database, silahkan bangkitkan ulang !";
				echo json_encode($json);
			}
		} else {
			$this->input_error();
		}
	}
}