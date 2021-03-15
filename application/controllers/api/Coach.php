<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coach extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('AthleteModel');
        $this->load->model('WorkoutModel');
        $this->load->model('DietModel');
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
                $i,
                $coach->sdate,
                $coach->edate,
                '<div class="d-flex align-items-center">
                   <span class="completion mr-2">100%</span>
                    <div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    </div>
                </div>',
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
                $i,
                $coach->sdate,
                $coach->edate,
                '<div class="d-flex align-items-center">
                   <span class="completion mr-2">100%</span>
                    <div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    </div>
                </div>',
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

    public function addWorkout()
    {
        if(!empty($this->input->post('sdate')) && !empty($this->input->post('edate')) && !empty($this->input->post('company_id')) && !empty($this->input->post('coach_id')) && !empty($this->input->post('athlete_id')))
        {
            $sdata= date($this->input->post('sdate'));
            $edata= date($this->input->post('edate'));
            $cdate= date($this->input->post('sdate'));
            $data=array();
            $c=1;
            while (strtotime($cdate) <= strtotime($edata)) {
                $d= '';
                if(!empty($this->input->post('wdata'.$c)))
                    $d=$this->input->post('wdata'.$c);
                $data[]=array('date'=>$cdate, 'data'=> $d);
                $cdate = date ("m/d/Y", strtotime("+1 days", strtotime($cdate)));
                $c++;
            }
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> json_encode($data),
                'per'=> 0,
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
            $cdate= date($this->input->post('sdate'));
            $data=array();
            $c=1;
            while (strtotime($cdate) <= strtotime($edata)) {
                $d= '';
                if(!empty($this->input->post('wdata'.$c)))
                    $d=$this->input->post('wdata'.$c);
                $data[]=array('date'=>$cdate, 'data'=> $d);
                $cdate = date ("m/d/Y", strtotime("+1 days", strtotime($cdate)));
                $c++;
            }
            $workout=array(
                'sdate'=> date('y-m-d',strtotime($sdata)),
                'edate'=> date('y-m-d',strtotime($edata)),
                'data'=> json_encode($data),
                'per'=> 0,
                'company_id'=>$this->input->post('company_id'),
                'coach_id'=>$this->input->post('coach_id'),
                'athlete_id'=>$this->input->post('athlete_id'),
            );
            if($this->UserModel->insert($workout,'diet'))
            {
                $this->msg(1,array( 'url' => base_url('coach/athlete/view/'.$workout['athlete_id']) ),'Diet added successfully.');
            }else{
                $this->msg(0,[],'Error while adding Diet!');
            }
        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }


    

}
