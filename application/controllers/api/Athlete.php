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
        $this->load->model('CheckinModel');
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

    public function checkin()
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
                date('d-M-Y',strtotime($athlete->from)),
                date('d-M-Y',strtotime($athlete->to)),
                '<div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="'.base_url("athlete/check_in/view/".$athlete->id).'">View</a>
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
                            if(empty($_FILES['field'.$d->f]['name']))
                            {
                                $this->msg(0,[],'Fields are missing!');
                                exit();
                            }
                        }else{
                            if(empty($_POST['field'.$d->f]))
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
                if($d->t=='Image' || $d->t=='File')
                {
                    if(!empty($_FILES['field'.$d->f]['name']))
                    {
                        $config['upload_path'] = './uploads/check_in';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = 0;
                        $new_name = time() . '-' . $_FILES['field'.$d->f]['name'];
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('field'.$d->f)) {
                            $this->msg(0,[],$this->upload->display_errors());
                            exit();
                        } else {
                            $fdata[$d->f] = array(
                                'l'=>$d->l,
                                't'=>$d->t,
                                'v'=>'uploads/check_in/'.$this->upload->data('file_name')
                            );
                        }
                    }
                }else{
                    if(!empty($_POST['field'.$d->f]))
                    {
                        $fdata[$d->f] = array(
                            'l'=>$d->l,
                            't'=>'Text',
                            'v'=>$_POST['field'.$d->f]
                        );
                    }
                }
            }
            $rdata=array(
                'athlete_id'=> $this->session->userdata('id'),
                'comp_id'=>$this->session->userdata('company_id'),
                'data'=> json_encode($fdata),
                'from'=> $_POST['csdate'],
                'to'=> $_POST['cedate']
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

    public function checkinHistory()
    {
        $pre='';
        $nxt='';
        $page=$_POST['page'];
        $athleteData = $this->CheckinModel->getACheckinHistory($page*10,11);
        if($page>0)
        {
            $pre= '<button onclick="getCheckin('.($page-1).')" class="btn btn-primary mx-auto">Pre</button>';
        }
        if($athleteData->num_rows()==11)
        {
            $nxt='<button onclick="getCheckin('.($page+1).')" class="btn btn-primary mx-auto">Next</button>';
        }
        $data='';
        $athleteData=$athleteData->result();
        $i=1;
        foreach($athleteData as $aData)
        {
            $cdata=json_decode($aData->data);
            if($i==11)
            {
                break;
            }
            $fdata='';
            $idata='';
            $f=1;
            foreach($cdata as $value) {
                if($value->t=='File')
                {
                    $fdata.='<p class="card-text">'.$value->l.':-<a href="'.base_url($value->v).'">View</a></p>';
                }elseif($value->t=='Image')
                {
                    if($idata=='')
                    {
                        $idata.='<div class="carousel-item active">
                            <img class="w-100" src="'.base_url($value->v).'">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$value->l.'</h5>
                                </div>
                            </div>';
                    }else{
                        $idata.='<div class="carousel-item">
                            <img class="w-100" src="'.base_url($value->v).'">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$value->l.'</h5>
                                </div>
                            </div>';
                    }
                }else
                {
                    if($f>5)
                    {
                        $hfdata='';
                    }else{
                        $fdata.='<p class="card-text">'.$value->l.':-'.$value->v.'</p>';
                    }
                    $f++;
                }
            }
            $data.=' <div class="col-lg-4 col-md-3 xol-sm-12">
                    <div class="card">
                    <div id="carouselExampleIndicators'.$aData->id.'" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            '.$idata.'
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators'.$aData->id.'" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators'.$aData->id.'" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title text-center">'.date('d-M-Y',strtotime($aData->from)).' - '.date('d-M-Y',strtotime($aData->to)).'</h5>
                    '.$fdata.'
                    <a href="'.base_url('athlete/check_in/view/'.$aData->id).'" class="btn btn-primary btn-sm">view</a>
                    </div>
                    <div class="card-footer">
                        <p class="h5 text-muted">Submitted on '.date('d-M-Y',strtotime($aData->created)).'</p>
                    </div>
                </div>
                </div>';
            $i++;
        }
        if($data=='')
        {
            $data='<h4>No data found!</h4>';
        }
        echo '<div class="container">
                <div class="row">'.$data.'</div>
                <div class="d-flex pb-4">
                '.$pre.$nxt.'
                </div>
            </div>';
    }
}