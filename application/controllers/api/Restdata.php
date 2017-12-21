<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
class Restdata extends REST_Controller{

  private $secretkey = 'ini rahasia untuk encode dan decode';

  public function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
  }


  //method untuk not found 404
  public function notfound($pesan){

    $this->response([
      'status'=>FALSE,
      'message'=>$pesan
    ],REST_Controller::HTTP_NOT_FOUND);

  }

  //method untuk bad request 400
  public function badreq($pesan){
    $this->response([
      'status'=>FALSE,
      'message'=>$pesan
    ],REST_Controller::HTTP_BAD_REQUEST);
  }


  //method untuk jika view token diatas fail
  public function viewtokenfail($username,$password){
    $this->response([
      'status'=>FALSE,
      'username'=>$username,
      'password'=>$password,
      'message'=>'Invalid Credentials!!'
      ],REST_Controller::HTTP_BAD_REQUEST);
  }

  public function cektoken(){
    $jwt = $this->input->get_request_header('Authorization');
    try {

      $decode = JWT::decode($jwt,$this->secretkey,array('HS256'));
      if ($this->User_model->is_valid_num($decode->username)>0) {
        return true;
      }

    } catch (Exception $e) {
      exit('Wrong Token');
    }
  }

}
