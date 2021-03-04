<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coach extends MY_Controller {

	public function index()
	{
		$data['nav']=2;
		$data['child'] = 'company/coach';
		$this->load->view('company/layout/index',$data);
	}

	public function add()
	{
		$data['nav']=2;
		$data['child'] = 'company/add_coach';
		$this->load->view('company/layout/index',$data);
	}
	
}
