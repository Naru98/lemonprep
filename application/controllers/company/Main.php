<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$data['nav']=1;
		$data['child'] = 'company/main';
		$this->load->view('company/layout/index',$data);
	}
	
}
