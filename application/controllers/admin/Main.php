<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('madmin')))
		{
			redirect(base_url('admin/login'));
		}
		$this->load->model('UserModel');
	}

	public function index()
	{
		$data['nav']=1;
		$data['child'] = 'admin/main';
		$this->load->view('admin/layout/index',$data);
	}

	public function profile()
	{
		$data['nav']=0;
		$data['user']=$this->UserModel->getByField('username',$this->session->userdata('admin'),'admin');
		$data['child'] = 'admin/profile';
		$this->load->view('admin/layout/index',$data);
	}
	
}
