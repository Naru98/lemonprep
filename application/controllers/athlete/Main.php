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
		$data['child'] = 'athlete/main';
		$this->load->view('athlete/layout/index',$data);
	}

	public function profile()
	{
		$data['nav']=0;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['user']=$this->UserModel->getByField('email',$this->session->userdata('email'),'athlete');
		$data['child'] = 'athlete/profile';
		$this->load->view('athlete/layout/index',$data);
	}


	public function workouts()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_workouts';
		$this->load->view('athlete/layout/index',$data);
	}

	public function workout($id)
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_workouts';
		$this->load->view('athlete/layout/index',$data);
	}
	
}
