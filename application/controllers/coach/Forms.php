<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends MY_Controller {

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
        $data['nav']=3;
		$data['child'] = 'coach/forms';
		$this->load->view('coach/layout/index',$data);
    }

	public function add()
	{
		$data['nav']=4;
		$data['child'] = 'coach/add_form';
		$this->load->view('coach/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=4;
		$data['forms'] = $this->UserModel->getByField('id',$id,'forms');
		$data['child'] = 'coach/edit_form';
		$this->load->view('coach/layout/index',$data);
	}
}
