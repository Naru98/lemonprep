<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diet extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	public function add($id)
	{
		$data['nav']=2;
        $data['id']=$id;
		$data['child'] = 'coach/add_diet';
		$this->load->view('coach/layout/index',$data);
	}
	
}
