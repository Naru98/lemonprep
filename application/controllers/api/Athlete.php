<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Athlete extends MY_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('WorkoutModel');
        $this->load->model('DietModel');
        $this->load->model('ShowsModel');
        $this->load->model('FormsModel');
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

    public function getDiets()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->DietModel->getADiet($_POST);
        
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
                    <a class="dropdown-item" href="'.base_url("athlete/diet/".$athlete->id).'">View</a>
                    </div>
                </div>'
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DietModel->countAllA(),
            "recordsFiltered" => $this->DietModel->countFilteredA($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

    public function getShows()
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
                    <a class="dropdown-item" href="'.base_url("athlete/show/".$athlete->id).'">View</a>
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

    public function getForms()
    {
        $data = $row = array();
        
        // Fetch member's records
        $athleteData = $this->FormsModel->getCForms($_POST);
        
        $i = $_POST['start'];
        foreach($athleteData as $athlete){
            $i++;
            $sub='<a class="btn btn-primary" href="'.base_url("athlete/form/".$athlete->id).'">Sign</a>';
            if($this->UserModel->checkForm($this->session->userdata('id'),$athlete->id))
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

    public function applyForm()
    {
        if(!empty($this->input->post('forms_id')) && !empty($this->input->post('data')) )
        {
            $_POST['athlete_id']=$this->session->userdata('id');
            if($this->UserModel->insert($_POST,'forms_data'))
            {
                $this->msg(1,[],'Form submited successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            } 

        }else{
            $this->msg(0,[],'Fields are missing!');
        }
    }

    public function addCheckIn()
    {
        $data=$this->UserModel->getID($this->session->userdata('company_id'),'company');
        if($data)
        {
            $data= json_decode($data[0]['data']);
            foreach($data as $d)
            {
                if($d->r==1)
                {
                    if($d->m==1)
                    {
                        if($d->t=='Image' || $d->t=='File')
                        {
                            if(empty($_FILES[$d->l]['name']))
                            {
                                $this->msg(0,[],'Fields are missing!');
                                exit();
                            }
                        }else{
                            if(empty($_POST[$d->l]))
                            {
                                $this->msg(0,[],'Fields are missing!');
                                exit();
                            }
                        }

                    }
                }
            }
            $fdata=[];
            foreach($data as $d)
            {
                if($d->r==1)
                {
                    if($d->t=='Image' || $d->t=='File')
                    {
                        if(!empty($_FILES[$d->l]['name']))
                        {
                            $config['upload_path'] = './uploads/check_in';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = 0;
                            $new_name = time() . '-' . $_FILES[$d->l]['name'];
                            $config['file_name'] = $new_name;
                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload($d->l)) {
                                $this->msg(0,[],$this->upload->display_errors());
                                exit();
                            } else {
                                $fdata[$d->l] = array(
                                    't'=>$d->t,
                                    'v'=>'uploads/check_in/'.$this->upload->data('file_name')
                                );
                            }
                        }
                    }else{
                        if(!empty($_POST[$d->l]))
                        {
                            $fdata[$d->l] = array(
                                't'=>'Text',
                                'v'=>$_POST[$d->l]
                            );
                        }
                    }
                }
            }
            $rdata=array(
                'athlete_id'=> $this->session->userdata('id'),
                'comp_id'=>$this->session->userdata('company_id'),
                'data'=> json_encode($fdata),
            );
            if($this->UserModel->insert($rdata,'check_in'))
            {
                $this->msg(1,[],'Check IN data added successfully.');
            }else
            {
                $this->msg(0,[],'Error while adding show!');
            }
        }else{
            $this->msg(0,[],'Check IN data are missing!');
        }
    }
}