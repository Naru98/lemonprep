<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		if(empty($this->session->userdata('type')))
		{
			redirect(base_url('login'));
		}else{
			if($this->session->userdata('type')!='athlete')
			{
				redirect(base_url($this->session->userdata('type')),'refresh');
			}
		}
	}

	public function index()
	{
		$data['nav']=1;
		$data['child'] = 'athlete/main';
		$this->load->view('athlete/layout/index',$data);
	}

	public function profile()
	{
		$data['nav']=0;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['user']=$this->UserModel->getByField('email',$this->session->userdata('email'),'athlete');
		$data['child'] = 'athlete/profile';
		$this->load->view('athlete/layout/index',$data);
	}


	public function workouts()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_workouts';
		$this->load->view('athlete/layout/index',$data);
	}

	public function workout($id)
	{
		$data['nav']=2;
		$data['workout']=$this->UserModel->getByField('id',$id,'workouts');
		$data['child'] = 'athlete/workout';
		$this->load->view('athlete/layout/index',$data);
	}

	public function diets()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_diets';
		$this->load->view('athlete/layout/index',$data);
	}

	public function diet($id)
	{
		$data['nav']=2;
		$data['diet']=$this->UserModel->getByField('id',$id,'diet');
		$data['child'] = 'athlete/diet';
		$this->load->view('athlete/layout/index',$data);
	}
	
	public function shows()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_shows';
		$this->load->view('athlete/layout/index',$data);
	}

	public function show($id)
	{
		$data['nav']=2;
		$data['show']=$this->UserModel->getByField('id',$id,'shows');
		$data['child'] = 'athlete/show';
		$this->load->view('athlete/layout/index',$data);
	}

	public function forms()
	{
		$data['nav']=2;
		$data['child'] = 'athlete/my_forms';
		$this->load->view('athlete/layout/index',$data);
	}

	public function form($id)
	{
		$data['nav']=2;
		$data['form']=$this->UserModel->getByField('id',$id,'forms');
		$data['child'] = 'athlete/form';
		$this->load->view('athlete/layout/index',$data);
	}

	public function check_in()
	{
		$data['status']=0;
		$user=$this->UserModel->getByField('email',$this->session->userdata('email'),'athlete');
		$data['data']=$user[0]['data'];
		if($data['data'] || !empty($data['data']))
		{
			$cdata=json_decode($data['data']);
			foreach($cdata as $cd)
			{
				$from= date('Y-m-d',strtotime($cd->from));
				$to= date('Y-m-d',strtotime($cd->to));
				$cur = date('Y-m-d');
				if( $from <= $cur && $to >= $cur)
				{
					$data['status'] = 1;
					$data['csdate'] = $from;
					$data['cedate'] = $to;
				}
			}
		}
		$data['nav']=2;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['child'] = 'athlete/check_in';
		$this->load->view('athlete/layout/index',$data);
	}

	public function add_check_in()
	{
		$data['status']=0;
		$user=$this->UserModel->getByField('email',$this->session->userdata('email'),'athlete');
		$data['data']=$user[0]['data'];
		if($data['data'] || $data['data'] != 'null')
		{
			$cdata=json_decode($data['data']);
			foreach($cdata as $cd)
			{
				$from= date('Y-m-d',strtotime($cd->from));
				$to= date('Y-m-d',strtotime($cd->to));
				$cur = date('Y-m-d');
				if( $from <= $cur && $to >= $cur)
				{
					$data['status'] = 1;
					$data['csdate'] = $from;
					$data['cedate'] = $to;
				}
			}
		}
		$data['nav']=2;
		$data['company']=$this->UserModel->getID($this->session->userdata('company_id'),'company');
		$data['child'] = 'athlete/add_check_in';
		$this->load->view('athlete/layout/index',$data);
	}

	public function view_check_in($id)
	{
		$data['nav']=2;
		$data['checkin']= $this->UserModel->getID($id,'check_in');
		$data['child'] = 'athlete/view_checkin';
		$this->load->view('athlete/layout/index',$data);
	}
}
