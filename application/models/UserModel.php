<?php
class UserModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

    function insert($data,$table)
    {
        if($this->db->insert($table, $data))
        {
            return $this->db->insert_id();
        }else
        {
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

    function checkForm($id,$fid)
    {
        $this->db->select("*");
		$this->db->from('forms_data');
		$this->db->where('forms_id',$fid);
        $this->db->where('athlete_id',$id);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    
    function checkEmailByID($email,$id,$table)
    {
        $this->db->select("*");
		$this->db->from($table);
        $this->db->where_not_in('id',$id);
		$this->db->where('email',$email);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    function updateByID($data,$id,$table)
    {
        $this->db->where('id',$id);
        if($this->db->update($table,$data))
        {
            return true;
        }else{
            return false;
        }
    }

    public function getByID($id,$company_id,$table)
    {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->where('id',$id);
        $this->db->where('company_id',$company_id);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function getID($id,$table)
    {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->where('id',$id);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function getTable($table)
    {
        $this->db->select("*");
		$this->db->from($table);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function getByField($field, $value, $table)
    {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->where($field,$value);
		$result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function deleteByField($field, $value, $table)
    {
        $this->db->where($field,$value);
        if($this->db->delete($table))
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getAthleteCoach($id)
    {
        $this->db->select('coach.*')
         ->from('coach_athlete')
         ->where('coach_athlete.athlete_id',$id)
         ->join('coach', 'coach_athlete.coach_id = coach.id');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function getCoachAthlete($id)
    {
        $this->db->select('athlete.*')
         ->from('coach_athlete')
         ->where('coach_athlete.coach_id',$id)
         ->join('athlete', 'coach_athlete.athlete_id = athlete.id');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return false;
        }
    }

    public function delete($id,$table)
    {
        $this->db->where('id',$id);
        if($this->db->delete($table))
        {
            return true;
        }else
        {
            return false;
        }
    }
}