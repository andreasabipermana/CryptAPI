<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ambil extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model']);
	}

	public function getUserById($id)
	{
		$id = $this->encryptor->enkrip('dekrip', $id);
		$datas = $this->User_model->get($id, FALSE);
		$data = array(
			'nama' => $datas->nama,
			'email' => $datas->email,
			'username' => $datas->username,
			'level' => $datas->level,
			'aktif' => $datas->aktif,
		);
		echo json_encode($data);
	}

	public function getProjectById($id)
	{
		$id = $this->encryptor->enkrip('dekrip', $id);
		$datas = $this->Project_model->get($id, FALSE);
		$data = array(
			'nama' => $datas->nama,
			'keterangan' => $datas->keterangan,
		);
		echo json_encode($data);
	}

	public function getObjekById($id)
	{
		$id = $this->encryptor->enkrip('dekrip', $id);
		$datas = $this->Objek_model->get($id, FALSE);
		$data = array(
			'nama' => $datas->nama,
			'keterangan' => $datas->keterangan,
		);
		echo json_encode($data);
	}

	public function getKunciById($id)
	{
		$id = $this->encryptor->enkrip('dekrip', $id);
		$datas = $this->Kunci_model->get($id, FALSE);
		$data = array(
			'nama_kunci' => $datas->nama_kunci,
			'kunci' => $datas->kunci,
			'keterangan' => $datas->keterangan,
		);
		echo json_encode($data);
	}

	public function bangkitkanKunci()
	{
		$hasil = base64_encode(openssl_random_pseudo_bytes(32));
		$data = [
			'status' => 1,
			'kunci' => $hasil
		];
		echo json_encode($data);
	}
}