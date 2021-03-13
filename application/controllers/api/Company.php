<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('CoachModel');
        $this->load->model('AthleteModel');
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
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('id')))
        {
            if(!empty($this->session->userdata('company_id')))
            {
                if(!$this->UserModel->checkEmailByID($this->input->post('email'),$this->input->post('id'),'users'))
                {
                    $company=array();
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
                            $company['image'] = 'uploads/coach/'.$this->upload->data('file_name');
                            $this->session->set_userdata('image',$company['image']);
                        }
                    }
                    $company['name']=$_POST['name'];
                    $this->UserModel->updateByID($company,$this->session->userdata('company_id'),'company');
                    if(!empty($this->input->post('password')))
                    {
                        $_POST['password']=md5($_POST['password']);
                    }else{
                        unset($_POST['password']);
                    }
                    $id=$_POST['id'];
                    unset($_POST['id']);
                    unset($_POST['cpassword']);
                    unset($_POST['name']);
                    if($this->UserModel->updateByID($_POST,$id,'users'))
                    {

                        $this->msg(1,[],'Profile updated successfully.');
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

    public function addAthlete()
    {
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('password')))
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
        if(!empty($this->input->post('name')) && !empty($this->input->post('email')) && !empty($this->input->post('id')))
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
}
