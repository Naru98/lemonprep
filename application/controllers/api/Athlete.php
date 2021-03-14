<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Athlete extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('WorkoutModel');
        $this->load->model('DietModel');
	}

    public function getworkouts()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->WorkoutModel->getAWorkout($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $img = $athlete->image? (base_url($athlete->image)) : (base_url("assets/img/athlete.png"));
            $data[] = array(
                $i,
                $athlete->sdate,
                $athlete->edate,
                $athlete->name,
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
                    <a class="dropdown-item" href="'.base_url("athlete/workout/".$athlete->id).'">View</a>
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
}