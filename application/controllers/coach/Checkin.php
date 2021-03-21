<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

    public function index()
    {
        $data['nav']=2;
		$data['child'] = 'coach/checkin';
        $data['company']= $this->UserModel->getID($this->session->userdata('id'),'coach');
		$this->load->view('coach/layout/index',$data);
    }

	
}
