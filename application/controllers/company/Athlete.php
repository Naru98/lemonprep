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
			if($this->session->userdata('type')!='company')
			{
				redirect(base_url($this->session->userdata('type')),'refresh');
			}
		}
	}

	public function index()
	{
		$data['nav']=3;
		$data['child'] = 'company/athlete';
		$this->load->view('company/layout/index',$data);
	}

	public function add()
	{
		$data['nav']=3;
        $data['coach'] = $this->UserModel->getByField('company_id',$this->session->userdata('company_id'),'coach');
		$data['child'] = 'company/add_athlete';
		$this->load->view('company/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=3;
		$data['selected_coach'] = $this->UserModel->getByField('athlete_id',$id,'coach_athlete');
		$data['coach'] = $this->UserModel->getByField('company_id',$this->session->userdata('company_id'),'coach');
		$data['athlete'] = $this->UserModel->getByID($id,$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'company/edit_athlete';
		$this->load->view('company/layout/index',$data);
	}
	
	public function view($id,$type=1)
	{
		$data['nav']=2;
		$data['snav']=$type;
		$data['id']=$id;
		$this->session->set_userdata('athlete_id',$id);
		$data['athlete'] = $this->UserModel->getByID($id,$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'company/view_athlete';
		$this->load->view('company/layout/index',$data);
	}
}
