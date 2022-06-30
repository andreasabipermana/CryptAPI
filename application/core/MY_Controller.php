<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public $data = [];

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(['text', 'url', 'date', 'form']);
		$this->load->library(['session', 'encryption', 'encryptor', 'site', 'form_validation']);
		date_default_timezone_set("Asia/Jakarta");
		$this->load->database();
		$this->site->is_logged_in();
	}
}