<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	public function index()
	{
		$data['nav']=1;
		$data['child'] = 'coach/main';
		$this->load->view('coach/layout/index',$data);
	}

	public function profile()
	{
		$data['nav']=0;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['user']=$this->UserModel->getByField('email',$this->session->userdata('email'),'coach');
		$data['child'] = 'coach/profile';
		$this->load->view('coach/layout/index',$data);
	}
	
}
