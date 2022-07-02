<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index($plain = NULL)
	{
		$this->load->model('Endpoint_model');
		$abi = $this->Endpoint_model->getEndpointbyAPIKey('NfqRXaC8vwwxB0gt1CKPXtPJrO3fx1OG', 3);
		var_dump($abi);
		echo $abi['id_endpoint'];
		// $hasil = $this->encryptor->enkrip_service('enkrip', $plain, $abi['kunci']);
		// echo 'Hasil Enkrip : ' . $hasil;
		// echo '<br>';
		// $dekrip = $this->encryptor->enkrip_service('dekrip', $hasil, $abi['kunci']);
		// echo 'Hasil Dekrip : ' . $dekrip;
		// echo '<br>';
		// echo date('Y-m-d H:i:s');
	}
}