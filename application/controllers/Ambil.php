<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambil extends MY_Controller
{

	public function __construct() {
		parent::__construct();
        $this->load->model('User_model');
		
	}

    public function getUserById($id){
		$id = $this->encryptor->enkrip('dekrip',$id);
		$datas = $this->User_model->get($id,FALSE);
		$data = array(
			'nama'=>$datas->nama,
			'email'=>$datas->email, 
			'username'=>$datas->username,
			'level'=>$datas->level,    
			'aktif'=>$datas->aktif,  
			);
		echo json_encode($data);
	}

    



}