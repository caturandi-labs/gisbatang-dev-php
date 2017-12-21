<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends REST_Controller {

	public function index_get()
	{
		$data = [
			[
				'nama'  => 'Andi',
				'kelas' => 'P43'
			],
			[
				'nama'  => 'Wow',
				'kelas' => 'P43'
			],
			[
				'nama'  => 'Wew',
				'kelas' => 'P43'
			],
		];

		$this->response($data);
	}

}
/* End of file Test.php */
/* Location: ./application/controllers/Test.php */