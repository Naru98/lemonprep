<?php
class WorkoutModel extends CI_Model {
	function __construct() {
		parent::__construct();
        // Set table name
        $this->table = 'workouts';
        // set company id
        $this->athlete_id=0;
        if(!empty($this->session->userdata('athlete_id')))
        {
            $this->athlete_id=$this->session->userdata('athlete_id');
        }elseif(!empty($this->session->userdata('id')))
        {
            $this->athlete_id=$this->session->userdata('id');
        }
        
        // Set orderable column fields
        $this->column_order = array(null, 'sdate','edate');
        // Set searchable column fields
        $this->column_search = array('sdate','edate');
        // Set default order
        $this->order = array('sdate' => 'asc');

        // Set orderable column fields
        $this->acolumn_order = array(null, 'workouts.sdate','workouts.edate','coach.name');
        // Set searchable column fields
        $this->acolumn_search = array('workouts.sdate','workouts.edate','coach.name',);
        // Set default order
        $this->aorder = array('workouts.sdate' => 'asc');
	}

    public function getWorkout($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('athlete_id',$this->athlete_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAWorkout($postData){
        $this->_get_datatables_queryA($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
            $this->db->select('coach.*,workouts.*');
            $this->db->where('workouts.athlete_id',$this->athlete_id);
            $this->db->join('coach', 'coach.id = workouts.coach_id');
            $query = $this->db->get();
            return $query->result();
        }
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->where('athlete_id',$this->athlete_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function countAllA(){
        $this->db->where('workouts.athlete_id',$this->athlete_id);
        $this->db->join('coach', 'coach.id = workouts.coach_id');
        $this->db->from('workouts');
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $this->db->where('athlete_id',$this->athlete_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countFilteredA($postData){
        $this->_get_datatables_queryA($postData);
        $this->db->where('workouts.athlete_id',$this->athlete_id);
        $this->db->join('coach', 'coach.id = workouts.coach_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
        $this->db->where('athlete_id',$this->athlete_id);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _get_datatables_queryA($postData){
         
        $this->db->from('workouts');
        $i = 0;
        // loop searchable columns 
        foreach($this->acolumn_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->acolumn_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->acolumn_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}