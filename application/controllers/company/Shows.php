<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shows extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->session->set_userdata('athlete_id','');
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
        $data['nav']=4;
		$data['child'] = 'company/shows';
		$this->load->view('company/layout/index',$data);
    }

	public function add()
	{
		$data['nav']=4;
        $data['id']=$this->session->userdata('id');
        $data['athlete'] = $this->UserModel->getByField('company_id',$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'company/add_show';
		$this->load->view('company/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=4;
        $data['id']=$id;
		$data['shows'] = $this->UserModel->getByField('id',$id,'shows');
		$data['selected_athlete'] = $this->UserModel->getByField('shows_id',$id,'shows_athlete');
        $data['athlete'] = $this->UserModel->getByField('company_id',$this->session->userdata('company_id'),'athlete');
		$data['child'] = 'company/edit_show';
		$this->load->view('company/layout/index',$data);
	}

	public function view($id)
	{
		$data['nav']=4;
		$data['show'] = $this->UserModel->getByField('id',$id,'shows');
		$data['child'] = 'company/view_show';
		$this->load->view('company/layout/index',$data);
	}
	
}
