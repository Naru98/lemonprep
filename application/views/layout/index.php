<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/header.php');
$this->load->view($child);
 $this->load->view('layout/footer.php'); ?>