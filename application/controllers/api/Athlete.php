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
            $img = $athlete->image? (base_url($athlete->image)) : (base_url("assets/img/coach.png"));
            $data[] = array(
                'id'=>$athlete->id,
                $i,
                $athlete->sdate,
                $athlete->edate,
                '<div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="'.$img.'">
                    </a>
                    <div class="media-body">
                    <span class="name mb-0 text-sm">'.$athlete->name.'</span>
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