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
	public function index()
	{

		$this->load->library('cryptapi');
		// $hasil =  $this->encryptor->enkrip_service('enkrip', 'andreasabipermana', 'TUJDPwu3gZVlrx1L2\/xFIB7\/kKi9IV2DTZZccZtTgLg=');
		// echo $hasil;
		// echo '<br>';
		// $hasil = $this->encryptor->enkrip_service('dekrip', $hasil, 'TUJDPwu3gZVlrx1L2/xFIB7/kKi9IV2DTZZccZtTgLg=');;
		// echo $hasil;

		// echo '<br>';
		// echo '<br>';

		$hasil =  $this->cryptapi->enkrip(base64_encode('andreasabipermana'), 'Karyawan');
		echo $hasil;
		// echo '<br>';
		// $hasil = $this->cryptapi->dekrip($hasil['ciphertext'], 'Karyawan');
		// echo $hasil['plaintext'];
	}
}