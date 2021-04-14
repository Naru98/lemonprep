<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shows extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

    public function index()
    {
        $data['nav']=4;
		$data['child'] = 'coach/shows';
		$this->load->view('coach/layout/index',$data);
    }

	public function add()
	{
		$data['nav']=4;
        $data['id']=$this->session->userdata('id');
        $data['athlete'] = $this->UserModel->getCoachAthlete($this->session->userdata('id'));
		$data['child'] = 'coach/add_show';
		$this->load->view('coach/layout/index',$data);
	}

	public function edit($id)
	{
		$data['nav']=4;
        $data['id']=$id;
		$data['shows'] = $this->UserModel->getByField('id',$id,'shows');
		$data['selected_athlete'] = $this->UserModel->getByField('shows_id',$id,'shows_athlete');
        $data['athlete'] = $this->UserModel->getCoachAthlete($this->session->userdata('id'));
		$data['child'] = 'coach/edit_show';
		$this->load->view('coach/layout/index',$data);
	}
	
}
