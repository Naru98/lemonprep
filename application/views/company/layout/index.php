<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('company/layout/header.php');
$this->load->view($child);
 $this->load->view('company/layout/footer.php'); ?>