<?php
class MY_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();
    }

	public function msg($status,$data,$msg)
	{
		echo json_encode(
			array(
				'status'=>$status,
				'data'=>$data,
				'msg'=>$msg
				)
			);
	}
}