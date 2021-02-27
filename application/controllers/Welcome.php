<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$data['child'] = 'main';
		$this->load->view('layout/index',$data);
	}

	public function login()
	{
		if(empty($this->session->userdata('type')))
		{
			$data['child'] = 'login';
			$this->load->view('layout/index',$data);
		}else{
			redirect(base_url().$this->session->userdata('type'),'refresh');
		}
	}

	public function register()
	{
		if(empty($this->session->userdata('type')))
		{
			$data['child'] = 'register';
			$this->load->view('layout/index',$data);
		}else{
			redirect(base_url().$this->session->userdata('type'),'refresh');
		}
	}
}
