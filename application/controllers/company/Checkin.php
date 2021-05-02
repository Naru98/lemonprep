<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

    public function index()
    {
        $data['nav']=2;
		$data['child'] = 'company/checkin';
        $data['company']= $this->UserModel->getID($this->session->userdata('company_id'),'company');
		$this->load->view('company/layout/index',$data);
    }

	public function view($id)
    {
        $data['nav']=2;
		$data['child'] = 'company/view_checkin';
        $data['checkin']= $this->UserModel->getID($id,'check_in');
		$this->load->view('company/layout/index',$data);
    }
}
