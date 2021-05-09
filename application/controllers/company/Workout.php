<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workout extends MY_Controller {

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

	public function add($id)
	{
		$data['nav']=2;
        $data['id']=$id;
		$data['child'] = 'company/add_workout';
		$this->load->view('company/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=2;
        $data['id']=$id;
		$data['workout'] = $this->UserModel->getByField('id',$id,'workouts');
		$data['child'] = 'company/edit_workout';
		$this->load->view('company/layout/index',$data);
	}
	
}
