<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/api/Restdata.php';
use \Firebase\JWT\JWT;

class Kategori extends Restdata {

	public function __construct()
	{
		parent::__construct();
		$this->cektoken();
	}
}

/* End of file Kategori.php */
/* Location: ./application/controllers/api/Kategori.php */