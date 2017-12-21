<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/api/Restdata.php';
use \Firebase\JWT\JWT;

class Users extends Restdata {


	public function register_post()
	{

		$email = $this->input->post('email');
		
		$data = [
			'nama_lengkap' => $this->post('nama_lengkap'),
			'username' => $this->post('username'),
			'password' => password_hash($this->post('password'),PASSWORD_DEFAULT)
		];
	
		
		//Check Apakah Email Sudah Ada Yang Daftar
		if($this->User_model->check_email($email)){
			return $this->badreq('Email Anda Sudah Terdaftar, Silahkan Gunakan E-Mail Lain');
		}else{
			$data['email'] = $email;
		}

		//Check Apakah Username Sudah Ada Yang Daftar
		// -- CODE --

		$this->form_validation->set_rules('email','EMAIL','trim|max_length[255]|required');
	    $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','trim|max_length[255]|required');
	    $this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
	    $this->form_validation->set_rules('password','Password','trim|required|min_length[8]');

	    if ($this->form_validation->run()==false) {
	      $this->badreq($this->validation_errors());
	    }else {

	      if ($this->User_model->register($data)) {
	        $this->response($data,Restdata::HTTP_CREATED);
	      }
	    }
	}

  	//method untuk melihat token pada user
  	public function login_post(){

	    $date = new DateTime();

	    $username = $this->post('username',TRUE);
	    $email    = $this->post('email', TRUE);
	    $password = $this->post('password',TRUE);

	    $dataadmin = $this->User_model->is_valid($username);

	    if ($dataadmin) {

	      if (password_verify($password,$dataadmin->password)) {

	        $payload['id_user'] = $dataadmin->id_user;
	        $payload['username'] = $dataadmin->username;
	        $payload['iat'] = $date->getTimestamp(); //waktu di buat
	        $payload['exp'] = $date->getTimestamp() + 2629746; //satu bulan

	        $output['id_token'] = JWT::encode($payload,$this->secretkey);
	        $this->response($output,REST_Controller::HTTP_OK);

	      }else {

	        $this->viewtokenfail($username,$password);

	      }

	    }else {
	      $this->viewtokenfail($username,$password);
	    }

	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */