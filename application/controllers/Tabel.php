<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tabel extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Project_model', 'Objek_model', 'Kunci_model', 'Endpoint_model', 'User_model']);
	}



	public function user()
	{

		$requestData	= $_REQUEST;
		$fetch			= $this->User_model->gen_tabel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		$no = 1;
		foreach ($query->result_array() as $row) {

			$nestedData = array();


			if ($row['aktif'] == 1) {
				$aktif = "<span class=\"badge bg-success\">Active</span>";
			} else {
				$aktif = "<span class=\"badge bg-danger\">Disabled</span>";
			}

			$nestedData[]	= $row['nomor'];

			$nestedData[]	= $row['nama'];
			$nestedData[]	= $row['username'];
			$nestedData[]	= $row['level'];
			$nestedData[]	= $aktif;
			$id = $this->encryptor->enkrip('enkrip', $row['id_user']);
			$nestedData[]	= "
            <button onclick=\"ubah('" . $id . "')\" class='btn icon btn-primary'><i class='bi bi-pencil'></i></button>
			<button onclick=\"hapus('" . $id . "')\" class='btn icon btn-danger'><i class='bi bi-trash'></i></button>";

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $data
		);

		echo json_encode($json_data);
	}

	public function project()
	{

		$requestData	= $_REQUEST;
		$fetch			= $this->Project_model->gen_tabel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		$no = 1;
		foreach ($query->result_array() as $row) {

			$nestedData = array();

			$nestedData[]	= $row['nomor'];

			$nestedData[]	= $row['nama'];
			$nestedData[]	= $row['keterangan'];
			$id = $this->encryptor->enkrip('enkrip', $row['id_project']);
			$nestedData[]	= "
            <button onclick=\"info('" . $id . "')\" class='btn icon btn-info'><i class='bi bi-info-circle'></i></button>
            <button onclick=\"ubah('" . $id . "')\" class='btn icon btn-primary'><i class='bi bi-pencil'></i></button>
			<button onclick=\"hapus('" . $id . "')\" class='btn icon btn-danger'><i class='bi bi-trash'></i></button>";

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $data
		);

		echo json_encode($json_data);
	}

	public function objek_kriptografi($id_project)
	{
		$requestData	= $_REQUEST;
		$fetch			= $this->Objek_model->gen_tabel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $id_project);

		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		$no = 1;
		foreach ($query->result_array() as $row) {

			$nestedData = array();

			$nestedData[]	= $row['nomor'];

			$nestedData[]	= $row['nama'];
			$nestedData[]	= $row['keterangan'];
			$id = $this->encryptor->enkrip('enkrip', $row['id_objek_kriptografi']);
			$nestedData[]	= "
            <button onclick=\"ubah('" . $id . "')\" class='btn icon btn-primary'><i class='bi bi-pencil'></i></button>
			<button onclick=\"hapus('" . $id . "')\" class='btn icon btn-danger'><i class='bi bi-trash'></i></button>";

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $data
		);

		echo json_encode($json_data);
	}

	public function kunci()
	{

		$requestData	= $_REQUEST;
		$fetch			= $this->Kunci_model->gen_tabel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		$no = 1;
		foreach ($query->result_array() as $row) {

			$nestedData = array();

			$nestedData[]	= $row['nomor'];

			$nestedData[]	= $row['nama_kunci'];
			$nestedData[]	= $row['keterangan'];
			$id = $this->encryptor->enkrip('enkrip', $row['id_kunci']);
			$nestedData[]	= "
            <button onclick=\"ubah('" . $id . "')\" class='btn icon btn-primary'><i class='bi bi-pencil'></i></button>
			<button onclick=\"hapus('" . $id . "')\" class='btn icon btn-danger'><i class='bi bi-trash'></i></button>";

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $data
		);

		echo json_encode($json_data);
	}


	public function endpoint_api()
	{

		$requestData	= $_REQUEST;
		$fetch			= $this->Endpoint_model->gen_tabel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		$no = 1;
		foreach ($query->result_array() as $row) {


			if ($row['aktif'] == 1) {
				$aktif = "<span class=\"badge bg-success\">Active</span>";
			} else {
				$aktif = "<span class=\"badge bg-danger\">Disabled</span>";
			}

			$nestedData = array();

			$nestedData[]	= $row['nomor'];

			$nestedData[]	= $row['nama'];
			$nestedData[]	= $row['nama_project'];
			$nestedData[]	= $aktif;
			$id = $this->encryptor->enkrip('enkrip', $row['id_endpoint']);
			$nestedData[]	= "
            <button onclick=\"info('" . $id . "')\" class='btn icon btn-info'><i class='bi bi-info-circle'></i></button>
            <button onclick=\"ubah('" . $id . "')\" class='btn icon btn-primary'><i class='bi bi-pencil'></i></button>
			<button onclick=\"hapus('" . $id . "')\" class='btn icon btn-danger'><i class='bi bi-trash'></i></button>";

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $data
		);

		echo json_encode($json_data);
	}
}