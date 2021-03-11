<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Athlete extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
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
	
}
