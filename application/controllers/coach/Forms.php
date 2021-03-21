<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

    public function index()
    {
        $data['nav']=3;
		$data['child'] = 'coach/forms';
		$this->load->view('coach/layout/index',$data);
    }

	
}
