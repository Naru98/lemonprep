<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coach extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('AthleteModel');
        $this->load->model('WorkoutModel');
        $this->load->model('DietModel');
        $this->load->model('ShowsModel');
        $this->load->model('FormsModel');
        $this->load->model('CheckinModel');
	}

    public function getAthlete()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->AthleteModel->getCAthlete($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $img = $athlete->image? (base_url($athlete->image)) : (base_url("assets/img/athlete.png"));
            $sdate='';
            $edate='';
            if($athlete->sdate)
            {
                $sdate=date('m-d-Y',strtotime($athlete->sdate));
            }
            if($athlete->edate)
            {
                $edate=date('m-d-Y',strtotime($athlete->edate));
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
                $sdate,
                $edate,
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("coach/athlete/edit/".$athlete->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'athlete\','.$athlete->id.')">Delete</a>
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
                    <a class="dropdown-item" href="'.base_url("coach/athlete/workout/edit/".$coach->id).'">Edit</a>
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
                    <a class="dropdown-item" href="'.base_url("coach/athlete/diet/edit/".$coach->id).'">Edit</a>
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

    public function getAthleteShows()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->ShowsModel->getShows($_POST);
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
                    <a class="dropdown-item" href="'.base_url("coach/shows/edit/".$athlete->id).'">Edit</a>
                    <a class="dropdown-item" onclick="deleteModal(\'shows\','.$athlete->id.')">Delete</a>
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
                    <a class="dropdown-item" href="'.base_url("coach/forms/edit/".$athlete->id).'">Edit</a>
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
                    <a class="dropdown-item" href="'.base_url("coach/show/view/".$athlete->id).'">View</a>
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
                    <a class="dropdown-item" href="'.base_url("coach/checkin/view/".$athlete->id).'">View</a>
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

    public function addWorkout()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('company_id')) && !empty($this->input->post('coach_id')) && !empty($this->input->post('athlete_id')))
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
                'company_id'=>$this->input->post('company_id'),
                'coach_id'=>$this->input->post('coach_id'),
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


    public function addDiet()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('company_id')) && !empty($this->input->post('coach_id')) && !empty($this->input->post('athlete_id')))
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> $this->input->post('data'),
                'company_id'=>$this->input->post('company_id'),
                'coach_id'=>$this->input->post('coach_id'),
                'athlete_id'=>$this->input->post('athlete_id'),
            );
            if($this->UserModel->insert($workout,'diet'))
            {
                $this->msg(1,array( 'url' => base_url('coach/athlete/view/'.$workout['athlete_id'].'/2') ),'Diet added successfully.');
            }else{
                $this->msg(0,[],'Error while adding Diet!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function addShow()
    {
        if(!empty($this->input->post('date')) && !empty($this->input->post('title')) )
        {
            $_POST['date']=date('y-m-d',strtotime($_POST['date']));
            $athlete=$_POST['athlete'];
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
            $_POST['coach_id']=$this->session->userdata('id');
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

}
