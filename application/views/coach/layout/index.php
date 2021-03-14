<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('coach/layout/header.php');
$this->load->view($child);
$this->load->view('coach/layout/footer.php'); ?>