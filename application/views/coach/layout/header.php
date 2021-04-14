<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Narayan Rahul">
  <title>DashBoard - LemonPrep</title>
  <!-- Favicon -->
  <link rel="icon" href="<?php echo base_url()?>assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/quill/dist/quill.core.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/argon.css?v=1.2.0" type="text/css">
  <style>
    #overlay
    {
      display:none;
      position: fixed;
      z-index: 9999;
      width: 100%;
      height: 100vh;
      background: #00000082;
      text-align: center;
    }
    .loader {
      border: 10px solid #f3f3f3;
      border-radius: 50%;
      border-top: 10px solid #defc8c;
      width: 70px;
      height: 70px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
      margin: auto;
      margin-top: 45vh;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .clogo{
      max-width:100px;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6
    {
      color:#000;
    }
    .breadcrumb-dark .breadcrumb-item a,.nav-pills .nav-link
    {
      color: #000 !important;
    }
    body, .btn-primary , .page-item.active .page-link
    {
      color:#000!important;
    }
    .clickable
    {
      cursor: pointer;
    }
  </style>
  <script>
  let SELECTED_VALUE=[];
  </script>
</head>

<body>
  <div id="overlay">
    <div class="loader"></div>
  </div>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-nav  navbar-top navbar-expand-lg navbar-light bg-primary border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url()?>">Lemon Prep</a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 order-md-2">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?php if(!empty($this->session->userdata('image'))){ echo base_url($this->session->userdata('image')); }else{ echo base_url("assets/img/coach.png");} ?>">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php if(!empty($this->session->userdata('name'))){ echo $this->session->userdata('name'); }else{ echo 'Coach';} ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="<?php echo base_url('coach/profile')?>" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url()?>logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
          <!-- Navbar links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo base_url().$this->session->userdata('type')?>">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>coach/athlete">My Athlete</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>coach/checkin">Check In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>coach/forms">Forms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>coach/shows">Shows</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->