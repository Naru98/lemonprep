<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('athlete/layout/header.php');
$this->load->view($child);
$this->load->view('athlete/layout/footer.php'); ?>