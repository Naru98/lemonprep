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
                    $arr=array(
                        array(
                            'f'=>1,
                            't'=>'Date',
                            'o'=>1,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>2,
                            't'=>'Date',
                            'o'=>2,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>3,
                            't'=>'Date',
                            'o'=>3,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>4,
                            't'=>'Image',
                            'o'=>4,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>5,
                            't'=>'Image',
                            'o'=>5,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>6,
                            't'=>'Image',
                            'o'=>6,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>7,
                            't'=>'File',
                            'o'=>7,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>8,
                            't'=>'Text',
                            'o'=>8,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>9,
                            't'=>'Text',
                            'o'=>9,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>10,
                            't'=>'Text',
                            'o'=>10,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>11,
                            't'=>'Text',
                            'o'=>11,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>12,
                            't'=>'Text',
                            'o'=>12,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>13,
                            't'=>'Text',
                            'o'=>13,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>14,
                            't'=>'Text',
                            'o'=>14,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>15,
                            't'=>'Text',
                            'o'=>15,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>16,
                            't'=>'Text',
                            'o'=>16,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>17,
                            't'=>'Text',
                            'o'=>17,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>18,
                            't'=>'Text',
                            'o'=>18,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>19,
                            't'=>'Text',
                            'o'=>19,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>20,
                            't'=>'Text',
                            'o'=>20,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                        array(
                            'f'=>21,
                            't'=>'Text',
                            'o'=>21,
                            'r'=>0,
                            'm'=>0,
                            'l'=>''
                        ),
                    );
                    $company_id=$this->WebModel->createCompany(array('name'=>$this->input->post('name'),'data' => json_encode($arr)));
                    if($company_id)
                    {
                        $_POST['name']=NULL;
                        $_POST['company_id']=$company_id;
                        $_POST['password']=md5($_POST['password']);
                        if($this->WebModel->createUser($_POST))
                        {
                            $ses=array(
                                'admin'=> '',
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
                                'admin'=> '',
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
                                'admin'=> '',
                                'admin'=>$user[0]['isVerifiyed'],
                                'type'=>$this->input->post('type'),
                                'company_id'=>$user[0]['company_id'],
                                'id'=>$user[0]['id'],
                                'email'=>$_POST['email'],
                                'image'=>$user[0]['image'],
                                'name'=>$user[0]['name'],
                                'cimage'=>$company[0]['image'],
                                'cname'=>$company[0]['name'],
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
                                'admin'=> '',
                                'type'=>$this->input->post('type'),
                                'company_id'=>$user[0]['company_id'],
                                'id'=>$user[0]['id'],
                                'email'=>$_POST['email'],
                                'image'=>$user[0]['image'],
                                'name'=>$user[0]['name'],
                                'cimage'=>$company[0]['image'],
                                'cname'=>$company[0]['name'],
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
