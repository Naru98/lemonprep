<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/layout/header.php');
$this->load->view($child);
 $this->load->view('admin/layout/footer.php'); ?>