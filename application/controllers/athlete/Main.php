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
		$data['workout']=$this->UserModel->getByField('id',$id,'workouts');
		$data['child'] = 'athlete/workout';
		$this->load->view('athlete/layout/index',$data);
	}

	public function diets()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_diets';
		$this->load->view('athlete/layout/index',$data);
	}

	public function diet($id)
	{
		$data['nav']=2;
		$data['diet']=$this->UserModel->getByField('id',$id,'diet');
		$data['child'] = 'athlete/diet';
		$this->load->view('athlete/layout/index',$data);
	}
	
	public function shows()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_shows';
		$this->load->view('athlete/layout/index',$data);
	}

	public function show($id)
	{
		$data['nav']=2;
		$data['show']=$this->UserModel->getByField('id',$id,'shows');
		$data['child'] = 'athlete/show';
		$this->load->view('athlete/layout/index',$data);
	}

	public function forms()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_forms';
		$this->load->view('athlete/layout/index',$data);
	}

	public function form($id)
	{
		$data['nav']=2;
		$data['form']=$this->UserModel->getByField('id',$id,'forms');
		$data['child'] = 'athlete/form';
		$this->load->view('athlete/layout/index',$data);
	}

	public function check_in()
	{
		$data['nav']=2;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['child'] = 'athlete/check_in';
		$this->load->view('athlete/layout/index',$data);
	}
}
