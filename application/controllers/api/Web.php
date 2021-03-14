<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('WebModel');
	}

	public function register()
	{
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('password')))
        {
            if(!$this->WebModel->checkComapny($this->input->post('name')))
            {
                if(!$this->WebModel->checkEmail($this->input->post('email'),'users'))
                {
                    $company_id=$this->WebModel->createCompany(array('name'=>$this->input->post('name')));
                    if($company_id)
                    {
                        $_POST['name']=NULL;
                        $_POST['company_id']=$company_id;
                        $_POST['password']=md5($_POST['password']);
                        if($this->WebModel->createUser($_POST))
                        {
                            $ses=array(
                                'type'=>'company',
                                'company_id'=>$company_id,
                                'email'=>$_POST['email'],
                                'image'=> '',
                                'name'=>$_POST['name'],
                            );
                            $this->session->set_userdata($ses);
                            $this->msg(1,[],'Account created successfully.');
                        }else
                        {
                            $this->msg(0,[],'Error while creating account!');
                        }
                    }else{
                        $this->msg(0,[],'Error while creating account!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
            }else{
                $this->msg(0,[],'Name already exists!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
	}

    public function login()
	{
        if(!empty($this->input->post('type')) && !empty($this->input->post('email')) && !empty($this->input->post('password')))
        {
            if($this->input->post('type')=='company')
            {
                $user=$this->WebModel->checkEmail($this->input->post('email'),'users');
                if($user)
                {
                    if(md5($this->input->post('password'))==$user[0]['password'])
                    {
                        $company=$this->WebModel->getComapny($user[0]['company_id']);
                        if($company)
                        {
                            $ses=array(
                                'type'=>$this->input->post('type'),
                                'company_id'=>$user[0]['company_id'],
                                'email'=>$_POST['email'],
                                'image'=>$company[0]['image'],
                                'name'=>$company[0]['name'],
                            );
                            $this->session->set_userdata($ses);
                            $this->msg(1,array( 'url' => $this->input->post('type') ),'Sign IN successfull.');
                        }else{
                            $this->msg(0,[],'Company not found!');
                        }
                    }else{
                        $this->msg(0,[],'Invalid email and password!');
                    }
                }else{
                    $this->msg(0,[],'User not found!');
                }
            }elseif($this->input->post('type')=='coach')
            {
                $user=$this->WebModel->checkEmail($this->input->post('email'),'coach');
                if($user)
                {
                    if(md5($this->input->post('password'))==$user[0]['password'])
                    {
                        $company=$this->WebModel->getComapny($user[0]['company_id']);
                        if($company)
                        {
                            $ses=array(
                                'type'=>$this->input->post('type'),
                                'company_id'=>$user[0]['company_id'],
                                'id'=>$user[0]['id'],
                                'email'=>$_POST['email'],
                                'image'=>$user[0]['image'],
                                'name'=>$user[0]['name'],
                            );
                            $this->session->set_userdata($ses);
                            $this->msg(1,array( 'url' => $this->input->post('type') ),'Sign IN successfull.');
                        }else{
                            $this->msg(0,[],'Company not found!');
                        }
                    }else{
                        $this->msg(0,[],'Invalid email and password!');
                    }
                }else{
                    $this->msg(0,[],'User not found!');
                }
            }else{
                $user=$this->WebModel->checkEmail($this->input->post('email'),'athlete');
                if($user)
                {
                    if(md5($this->input->post('password'))==$user[0]['password'])
                    {
                        $company=$this->WebModel->getComapny($user[0]['company_id']);
                        if($company)
                        {
                            $ses=array(
                                'type'=>$this->input->post('type'),
                                'company_id'=>$user[0]['company_id'],
                                'id'=>$user[0]['id'],
                                'email'=>$_POST['email'],
                                'image'=>$user[0]['image'],
                                'name'=>$user[0]['name'],
                            );
                            $this->session->set_userdata($ses);
                            $this->msg(1,array( 'url' => $this->input->post('type') ),'Sign IN successfull.');
                        }else{
                            $this->msg(0,[],'Company not found!');
                        }
                    }else{
                        $this->msg(0,[],'Invalid email and password!');
                    }
                }else{
                    $this->msg(0,[],'User not found!');
                }
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }
}
