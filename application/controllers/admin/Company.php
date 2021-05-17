<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

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
		$data['child'] = 'admin/company';
		$this->load->view('admin/layout/index',$data);
	}

	public function add()
	{
		$data['child'] = 'admin/add_company';
		$this->load->view('admin/layout/index',$data);
	}

	public function edit($id)
	{
		$data['company']=$this->UserModel->getID($id,'company');
		$data['user']=$this->UserModel->getByField('company_id',$id,'users');
		$data['child'] = 'admin/edit_company';
		$this->load->view('admin/layout/index',$data);
	}

	public function view($id)
	{
		$company=$this->UserModel->getID($id,'company');
		$user=$this->UserModel->getByField('company_id',$id,'users');
		$ses=array(
			'type'=>'company',
			'company_id'=>$id,
			'email'=>$user[0]['email'],
			'image'=>$company[0]['image'],
			'name'=>$company[0]['name'],
		);
		$this->session->set_userdata($ses);
		redirect(base_url('company'));
	}
	
}
