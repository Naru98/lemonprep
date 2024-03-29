<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Athlete extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		if(empty($this->session->userdata('type')))
		{
			redirect(base_url('login'));
		}else{
			if($this->session->userdata('type')!='coach')
			{
				redirect(base_url($this->session->userdata('type')),'refresh');
			}
		}
	}

	public function index()
	{
		$data['nav']=2;
		$data['child'] = 'coach/athlete';
		$this->load->view('coach/layout/index',$data);
	}

	public function add()
	{
		$data['nav']=2;
		$data['child'] = 'coach/add_athlete';
		$this->load->view('coach/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=2;
		$data['athlete'] = $this->UserModel->getByID($id,$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'coach/edit_athlete';
		$this->load->view('coach/layout/index',$data);
	}

	public function view($id,$type=1)
	{
		$data['nav']=2;
		$data['snav']=$type;
		$data['id']=$id;
		$this->session->set_userdata('athlete_id',$id);
		$data['athlete'] = $this->UserModel->getByID($id,$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'coach/view_athlete';
		$this->load->view('coach/layout/index',$data);
	}
	
}
