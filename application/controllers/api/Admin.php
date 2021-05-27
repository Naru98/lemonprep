<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('CoachModel');
        $this->load->model('CompanyModel');
        $this->load->model('AthleteModel');
        $this->load->model('WorkoutModel');
        $this->load->model('DietModel');
        $this->load->model('ShowsModel');
        $this->load->model('FormsModel');
        $this->load->model('CheckinModel');
        $this->load->model('WebModel');
	}

    public function settings()
    {
        if(!empty($this->input->post('count')))
        {
            for($i=1; $i<$this->input->post('count'); $i++)
            {
                $data=array('value'=>0);
                if(!empty($this->input->post('value'.$i)))
                {
                    $data['value']=1;
                }
                $this->UserModel->updateByID($data,$this->input->post('id'.$i),'settings');
            }
            $this->msg(1,[],'Settings updated successfully.');
        }else{
            $this->msg(0,[],'Fields are missing!');
        }

    }
    public function addCoach()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('password')))
        {
            if(!empty($this->session->userdata('company_id')))
            {
                if(!$this->UserModel->checkEmail($this->input->post('email'),'coach'))
                {
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/coach';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $_POST['image'] = 'uploads/coach/'.$this->upload->data('file_name');
                        }
                    }
                    unset($_POST['cpassword']);
                    $_POST['password']=md5($_POST['password']);
                    $_POST['company_id']=$this->session->userdata('company_id');
                    if($this->UserModel->insert($_POST,'coach'))
                    {
                        $this->msg(1,[],'Coach added successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding coach!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
            }else{
                $this->msg(0,[],'Error occurred please try again later!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function editCoach()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('id')))
        {
            if(!empty($this->session->userdata('company_id')))
            {
                if(!$this->UserModel->checkEmailByID($this->input->post('email'),$this->input->post('id'),'coach'))
                {
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/coach';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $_POST['image'] = 'uploads/coach/'.$this->upload->data('file_name');
                        }
                    }
                    if(!empty($this->input->post('password')))
                    {
                        $_POST['password']=md5($_POST['password']);
                    }else{
                        unset($_POST['password']);
                    }
                    $id=$_POST['id'];
                    unset($_POST['id']);
                    unset($_POST['cpassword']);
                    if($this->UserModel->updateByID($_POST,$id,'coach'))
                    {
                        $this->msg(1,[],'Coach updated successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding coach!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
            }else{
                $this->msg(0,[],'Error occurred please try again later!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function delete()
    {
        if(!empty($this->input->post('id')) && !empty($this->input->post('table')))
        {
            if($this->UserModel->delete($this->input->post('id'),$this->input->post('table')))
            {
                $this->session->set_userdata('success', 'Deleted successfully.');
                $this->msg(1,[],'Deleted successfully.');
            }else{
                $this->session->set_userdata('error', 'Error occurred please try again later!');
                $this->msg(0,[],'Error occurred please try again later!');
            }
        }else{
            $this->session->set_userdata('error', 'Error occurred please try again later!');
            $this->msg(0,[],'Fields are missing!');
        }    
    }

    public function addCompany()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('password')))
        {
            if(!$this->WebModel->checkComapny($this->input->post('name')))
            {
                if(!$this->WebModel->checkEmail($this->input->post('email'),'users'))
                {
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/company';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $_POST['image'] = 'uploads/company/'.$this->upload->data('file_name');
                        }
                    }
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
                    $comp=array(
                        'name'=>$this->input->post('name'),
                        'data' => json_encode($arr),
                        'image'=> NULL);
                    if(!empty($_POST['image']))
                    {
                        $comp['image']=$_POST['image'];
                    }
                    $company_id=$this->WebModel->createCompany($comp);
                    if($company_id)
                    {
                        $_POST['name']=NULL;
                        unset($_POST['image']);
                        unset($_POST['cpassword']);
                        $_POST['company_id']=$company_id;
                        $_POST['password']=md5($_POST['password']);
                        if($this->WebModel->createUser($_POST))
                        {
                            $this->msg(1,[],'Company created successfully.');
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

    public function editCompany()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('id') && !empty($this->input->post('company_id')) ))
        {
                if(!$this->UserModel->checkEmailByID($this->input->post('email'),$this->input->post('id'),'users'))
                {
                    $company=array();
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/company';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $company['image'] = 'uploads/company/'.$this->upload->data('file_name');
                            $this->session->set_userdata('image',$company['image']);
                        }
                    }
                    $company['name']=$_POST['name'];
                    $this->UserModel->updateByID($company,$this->input->post('company_id'),'company');
                    if(!empty($this->input->post('password')))
                    {
                        $_POST['password']=md5($_POST['password']);
                    }else{
                        unset($_POST['password']);
                    }
                    $id=$_POST['id'];
                    unset($_POST['id']);
                    unset($_POST['company_id']);
                    unset($_POST['cpassword']);
                    unset($_POST['name']);
                    if($this->UserModel->updateByID($_POST,$id,'users'))
                    {

                        $this->msg(1,[],'Company updated successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding coach!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function getCoach()
    {
        $data = $row = array();
        
        // Fetch member's records
        $coachData = $this->CoachModel->getCoach($_POST);
        
        $i = $_POST['start'];
        foreach($coachData as $coach){
            $i++;
            $img = $coach->image? (base_url($coach->image)) : (base_url("assets/img/coach.png"));
            $data[] = array(
                'id'=>$coach->id,
                $i,
                '<div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="'.$img.'">
                    </a>
                    <div class="media-body">
                    <span class="name mb-0 text-sm">'.$coach->name.'</span>
                    </div>
                </div>',
                $coach->email,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/coach/edit/".$coach->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'coach\','.$coach->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->CoachModel->countAll(),
            "recordsFiltered" => $this->CoachModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function getCompany()
    {
        $data = $row = array();
        
        // Fetch member's records
        $coachData = $this->CompanyModel->getCompany($_POST);
        
        $i = $_POST['start'];
        foreach($coachData as $coach){
            $i++;
            $img = $coach->image? (base_url($coach->image)) : (base_url("assets/img/company.png"));
            $data[] = array(
                'id'=>$coach->id,
                $i,
                '<div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="'.$img.'">
                    </a>
                    <div class="media-body">
                    <span class="name mb-0 text-sm">'.$coach->name.'</span>
                    </div>
                </div>',
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("admin/company/edit/".$coach->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'company\','.$coach->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->CompanyModel->countAll(),
            "recordsFiltered" => $this->CompanyModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }


    public function getAthlete()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->AthleteModel->getAthlete($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $img = $athlete->image? (base_url($athlete->image)) : (base_url("assets/img/athlete.png"));
            $coachText='';
            $coach=$this->UserModel->getAthleteCoach($athlete->id);
            if($coach)
            {
                foreach($coach as $c)
                {
                    $curl= base_url('company/coach/edit/'.$c['id']);
                    $cimg= $c['image']? (base_url($c['image'])) : (base_url("assets/img/coach.png"));
                    $coachText.='<a href="'.$curl.'" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="'.$c['name'].'">
                                <img alt="Image placeholder" src="'.$cimg.'">
                                </a>';
                }
            }
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                '<div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="'.$img.'">
                    </a>
                    <div class="media-body">
                    <span class="name mb-0 text-sm">'.$athlete->name.'</span>
                    </div>
                </div>',
                $athlete->email,
                '<div class="avatar-group">'.$coachText.'</div>',
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/athlete/edit/".$athlete->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'athlete\','.$athlete->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->AthleteModel->countAll(),
            "recordsFiltered" => $this->AthleteModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function editProfile()
    {
        if(!empty($this->input->post('username')) && !empty($this->input->post('id')))
        {
                if(!$this->UserModel->checkEmailByID($this->input->post('email'),$this->input->post('id'),'users'))
                {
                    $company=array();
                    if(!empty($this->input->post('password')))
                    {
                        $_POST['password']=md5($_POST['password']);
                    }else{
                        unset($_POST['password']);
                    }
                    $id=$_POST['id'];
                    unset($_POST['id']);
                    unset($_POST['cpassword']);
                    if($this->UserModel->updateByID($_POST,$id,'admin'))
                    {
                        $ses= array(
                            'admin'=> $this->input->post('username'),
                            'admin_id'=> $this->input->post('id')
                        );
                        $this->session->set_userdata($ses);
                        $this->msg(1,[],'Profile updated successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding coach!');
                    }
                }else{
                    $this->msg(0,[],'username already exists!');
                }

        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function addAthlete()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('password')) && !empty($this->input->post('sdate')) && !empty($this->input->post('edate')))
        {
            if(!empty($this->session->userdata('company_id')))
            {
                if(!$this->UserModel->checkEmail($this->input->post('email'),'athlete'))
                {
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/athlete';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $_POST['image'] = 'uploads/athlete/'.$this->upload->data('file_name');
                        }
                    }
                    $coaches=$this->input->post('coach');
                    unset($_POST['coach']);
                    unset($_POST['cpassword']);
                    $_POST['sdate']=date('Y-m-d',strtotime($_POST['sdate']));
                    $_POST['edate']=date('Y-m-d',strtotime($_POST['edate']));
                    $_POST['password']=md5($_POST['password']);
                    $_POST['company_id']=$this->session->userdata('company_id');
                    $athlete_id=$this->UserModel->insert($_POST,'athlete');
                    if($athlete_id)
                    {
                        if(!empty($coaches))
                        {
                            foreach($coaches as $coach)
                            {
                                $this->UserModel->insert(array('coach_id'=>$coach,'athlete_id'=>$athlete_id),'coach_athlete');
                            }
                        }
                        $this->msg(1,[],'Athlete added successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding athlete!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
            }else{
                $this->msg(0,[],'Error occurred please try again later!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }
    public function editAthlete()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('id')) && !empty($this->input->post('sdate')) && !empty($this->input->post('edate')))
        {
            if(!empty($this->session->userdata('company_id')))
            {
                if(!$this->UserModel->checkEmailByID($this->input->post('email'),$this->input->post('id'),'athlete'))
                {
                    if(!empty($_FILES['image']['name']))
                    {
                        $config['upload_path'] = './uploads/athlete';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES["image"]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $_POST['image'] = 'uploads/athlete/'.$this->upload->data('file_name');
                        }
                    }
                    if(!empty($this->input->post('password')))
                    {
                        $_POST['password']=md5($_POST['password']);
                    }else{
                        unset($_POST['password']);
                    }
                    $id=$_POST['id'];
                    $coaches=$this->input->post('coach');
                    unset($_POST['id']);
                    unset($_POST['cpassword']);
                    unset($_POST['coach']);
                    $_POST['sdate']=date('Y-m-d',strtotime($_POST['sdate']));
                    $_POST['edate']=date('Y-m-d',strtotime($_POST['edate']));
                    if($this->UserModel->updateByID($_POST,$id,'athlete'))
                    {
                        $this->UserModel->deleteByField('athlete_id',$id,'coach_athlete');
                        if(!empty($coaches))
                        {
                            foreach($coaches as $coach)
                            {
                                $this->UserModel->insert(array('coach_id'=>$coach,'athlete_id'=>$id),'coach_athlete');
                            }
                        }
                        $this->msg(1,[],'Athlete updated successfully.');
                    }else{
                        $this->msg(0,[],'Error while adding coach!');
                    }
                }else{
                    $this->msg(0,[],'Email already exists!');
                }
            }else{
                $this->msg(0,[],'Error occurred please try again later!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function checkinSetting()
    {
        if(!empty($this->input->post('id')))
        {
            $data=array();
            for($i=1;$i<=21;$i++)
            {
                $t='Text';
                $m=0;
                $r=0;
                if($i==1 || $i==2 || $i==3 ) 
                    $t='Date';
                if($i==4 || $i==5 || $i==6 ) 
                    $t='Image';
                if($i==7)
                    $t='File';
                if(!empty($_POST['m'.$i]))
                    $m=1;
                if(!empty($_POST['r'.$i]))
                    $r=1;
                $data[]=array(
                        'f'=>$i,
                        't'=>$t,
                        'o'=>$_POST['o'.$i],
                        'r'=>$r,
                        'm'=>$m,
                        'l'=>$_POST['v'.$i],
                        );
            }

            if($this->UserModel->updateByID(array( 'data' => json_encode($data) ),$_POST['id'],'company'))
            {
                $this->msg(1,[],'Settings updated successfully.');
            }else{
                $this->msg(0,[],'Error while saving!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function getForms()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->FormsModel->getCForms($_POST);
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                $athlete->name,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/forms/edit/".$athlete->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'forms\','.$athlete->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->AthleteModel->countAll(),
            "recordsFiltered" => $this->AthleteModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function addForm()
    {
        if(!empty($this->input->post('name')) && !empty($_FILES['file']['name']) )
        {
            $config['upload_path'] = './uploads/forms';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $new_name = time() . '-' . $_FILES["file"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $this->msg(0,[],$this->upload->display_errors());
                exit();
            } else {
                $_POST['file'] = 'uploads/forms/'.$this->upload->data('file_name');
            }
            $_POST['coach_id']=0;
            $_POST['comp_id']=$this->session->userdata('company_id');
            if($this->UserModel->insert($_POST,'forms'))
            {
                $this->msg(1,[],'Form added successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function editForm()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('id')) )
        {
            $id=$_POST['id'];
            $config['upload_path'] = './uploads/forms';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $new_name = time() . '-' . $_FILES["file"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if(!empty($_FILES['file']['name']))
            {
                if (!$this->upload->do_upload('file')) {
                    $this->msg(0,[],$this->upload->display_errors());
                    exit();
                } else {
                    $_POST['file'] = 'uploads/forms/'.$this->upload->data('file_name');
                }
            }
            if($this->UserModel->updateByID($_POST,$id,'forms'))
            {
                $this->msg(1,[],'Form updated successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function getAthleteShows()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->ShowsModel->getShowsC($_POST);
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                $athlete->title,
                $athlete->date,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/shows/edit/".$athlete->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'shows\','.$athlete->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->AthleteModel->countAllC(),
            "recordsFiltered" => $this->AthleteModel->countFilteredC($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function addShow()
    {
        if(!empty($this->input->post('date')) && !empty($this->input->post('title')) )
        {
            $_POST['date']=date('y-m-d',strtotime($_POST['date']));
            $athlete=$_POST['athlete'];
            $_POST['type']=1;
            unset($_POST['athlete']);
            $show_id=$this->UserModel->insert($_POST,'shows');
            if($show_id)
            {
                if(!empty($athlete))
                {
                    foreach($athlete as $a)
                    {
                        $this->UserModel->insert(array('athlete_id'=>$a,'shows_id'=>$show_id),'shows_athlete');
                    }
                }
                $this->msg(1,[],'Show added successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function editShow()
    {
        if(!empty($this->input->post('date')) && !empty($this->input->post('title')) )
        {
            $_POST['date']=date('y-m-d',strtotime($_POST['date']));
            $athlete=$_POST['athlete'];
            $id=$_POST['id'];
            unset($_POST['athlete']);
            unset($_POST['id']);
            if($this->UserModel->updateByID($_POST,$id,'shows'))
            {
                $this->UserModel->deleteByField('shows_id',$id,'shows_athlete');
                if(!empty($athlete))
                {
                    foreach($athlete as $a)
                    {
                        $this->UserModel->insert(array('athlete_id'=>$a,'shows_id'=>$id),'shows_athlete');
                    }
                }
                $this->msg(1,[],'Show updated successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function getWorkout()
    {
        $data = $row = array();
        
        // Fetch member's records
        $coachData = $this->WorkoutModel->getWorkout($_POST);
        
        $i = $_POST['start'];
        foreach($coachData as $coach){
            $i++;
            $data[] = array(
                'id'=>$coach->id,
                $i,
                $coach->sdate,
                $coach->edate,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/athlete/workout/edit/".$coach->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'workouts\','.$coach->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->WorkoutModel->countAll(),
            "recordsFiltered" => $this->WorkoutModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function getDiet()
    {
        $data = $row = array();
        
        // Fetch member's records
        $coachData = $this->DietModel->getDiet($_POST);
        
        $i = $_POST['start'];
        foreach($coachData as $coach){
            $i++;
            $data[] = array(
                'id'=>$coach->id,
                $i,
                $coach->sdate,
                $coach->edate,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/athlete/diet/edit/".$coach->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'diet\','.$coach->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DietModel->countAll(),
            "recordsFiltered" => $this->DietModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function addWorkout()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('company_id')) && !empty($this->input->post('athlete_id')))
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
                'company_id'=>$this->input->post('company_id'),
                'athlete_id'=>$this->input->post('athlete_id'),
            );
            if($this->UserModel->insert($workout,'workouts'))
            {
                $this->msg(1,array( 'url' => base_url('coach/athlete/view/'.$workout['athlete_id']) ),'Workout added successfully.');
            }else{
                $this->msg(0,[],'Error while adding workout!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function editWorkout()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('id')) )
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
            );
            if($this->UserModel->updateByID($workout,$_POST['id'],'workouts'))
            {
                $this->msg(1,array(),'Workout updated successfully.');
            }else{
                $this->msg(0,[],'Error while adding workout!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }


    public function addDiet()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('company_id')) && !empty($this->input->post('athlete_id')))
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
                'company_id'=>$this->input->post('company_id'),
                'athlete_id'=>$this->input->post('athlete_id'),
            );
            if($this->UserModel->insert($workout,'diet'))
            {
                $this->msg(1,array( 'url' => base_url('coach/athlete/view/'.$workout['athlete_id'].'/2') ),'Nutrition added successfully.');
            }else{
                $this->msg(0,[],'Error while adding Nutrition!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function editDiet()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('id')) )
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
            );
            if($this->UserModel->updateByID($workout,$_POST['id'],'diet'))
            {
                $this->msg(1,array(),'Nutrition updated successfully.');
            }else{
                $this->msg(0,[],'Error while adding Nutrition!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function showsA()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->ShowsModel->getAShowsA($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                $athlete->title,
                $athlete->date,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/show/view/".$athlete->id).'">View</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->WorkoutModel->countAllA(),
            "recordsFiltered" => $this->WorkoutModel->countFilteredA($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function formsA()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->FormsModel->getCForms($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $sub='<span class="text-danger h5">Not Signed</span>';
            if($this->UserModel->checkForm($this->session->userdata('athlete_id'),$athlete->id))
            {
                $sub='<span class="text-dark h5">Signed</span>';
            }
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                $athlete->name,
                $sub
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->FormsModel->countAll(),
            "recordsFiltered" => $this->FormsModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function checkinA()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->CheckinModel->getACheckin($_POST);
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                date('Y-m-d',strtotime($athlete->created)),
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("company/checkin/view/".$athlete->id).'">View</a>
                    <a class="dropdown-item" onclick="deleteModal(\'check_in\','.$athlete->id.')">Delete</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->CheckinModel->countAll(),
            "recordsFiltered" => $this->CheckinModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
}
