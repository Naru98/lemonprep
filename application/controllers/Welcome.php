<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['child'] = 'main';
		$this->load->view('layout/index',$data);
	}

	public function login()
	{
		$data['child'] = 'login';
		$this->load->view('layout/index',$data);
	}

	public function register()
	{
		$data['child'] = 'register';
		$this->load->view('layout/index',$data);
	}
}
