<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('WebModel');
	}

    public function msg($status,$data,$msg)
	{
		echo json_encode(
			array(
				'status'=>$status,
				'data'=>$data,
				'msg'=>$msg
				)
			);
	}

	public function index()
	{
        if(!empty($this->session->userdata('admin')))
		{
			redirect(base_url('admin'));
		}
		$data['child'] = 'admin/login';
		$this->load->view('admin/layout/index',$data);
	}

	public function check()
	{
        if(!empty($this->input->post('username')) && !empty($this->input->post('password')))
        {
            $user=$this->UserModel->getByField('username',$this->input->post('username'),'admin');
            if($user)
            {
                if(md5($this->input->post('password'))==$user[0]['password'])
                {
                    
                    $ses= array(
                        'type'=> '',
                        'admin'=> $this->input->post('username'),
                        'admin_id'=> $user[0]['id']
                    );
                    $this->session->set_userdata($ses);
                    $this->msg(1,array( 'url' =>''),'Sign IN successfull.');
                }else{
                    $this->msg(0,[],'Invalid username and password!');
                }
            }else{
                $this->msg(0,[],'User not found!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
	}

    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'admin/login','refresh');
    }
	
}
