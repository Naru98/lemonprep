<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coach extends MY_Controller {

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
		$data['nav']=2;
		$data['child'] = 'company/coach';
		$this->load->view('company/layout/index',$data);
	}

	public function add()
	{
		$data['nav']=2;
		$data['child'] = 'company/add_coach';
		$this->load->view('company/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=2;
		$data['coach'] = $this->UserModel->getByID($id,$this->session->userdata('company_id'),'coach');
		$data['child'] = 'company/edit_coach';
		$this->load->view('company/layout/index',$data);
	}
	
}
