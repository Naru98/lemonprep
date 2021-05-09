<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		if(empty($this->session->userdata('type')))
		{
			redirect(base_url('login'));
		}else{
			if($this->session->userdata('type')!='company')
			{
				redirect(base_url($this->session->userdata('type')),'refresh');
			}
		}
	}

	public function index()
	{
		$data['nav']=1;
		$data['child'] = 'company/main';
		$this->load->view('company/layout/index',$data);
	}

	public function profile()
	{
		$data['nav']=0;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['user']=$this->UserModel->getByField('email',$this->session->userdata('email'),'users');
		$data['child'] = 'company/profile';
		$this->load->view('company/layout/index',$data);
	}
	
}
