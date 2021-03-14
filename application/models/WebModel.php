<?php
class WebModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

    function checkComapny($name)
    {
        $this->db->select("*");
		$this->db->from("company");
		$this->db->where('name',$name);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    function getComapny($id)
    {
        $this->db->select("*");
		$this->db->from("company");
		$this->db->where('id',$id);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    function checkEmail($email,$table)
    {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->where('email',$email);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    function createCompany($data)
    {
        $insert=$this->db->insert("company", $data);
        if($insert)
        {
            return $this->db->insert_id();
        }else
        {
            return false;
        }
    }

    function createUser($data)
    {
        if($this->db->insert("users", $data))
        {
            return true;
        }else
        {
            return false;
        }
    }
}