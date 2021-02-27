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
                if(!$this->WebModel->checkEmail($this->input->post('email')))
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
                                'email'=>$_POST['email']
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

}
