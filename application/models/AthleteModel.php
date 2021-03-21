<?php
class AthleteModel extends CI_Model {
	function __construct() {
		parent::__construct();
        // Set table name
        $this->table = 'athlete';
        // set company id
        $this->company_id=$this->session->userdata('company_id');

        // set coach id
        if(!empty($this->session->userdata('id')))
        {
            $this->coach_id= $this->session->userdata('id'); 
        }else{
            $this->coach_id= 0;
        }
        // Set orderable column fields
        $this->column_order = array(null, 'name','email','sdate','edate');
        $this->ccolumn_order = array(null, 'athlete.name','athlete.email','athlete.sdate','athlete.edate');
        // Set searchable column fields
        $this->column_search = array('name','email','sdate','edate');
        $this->ccolumn_search = array('athlete.name','athlete.email','athlete.sdate','athlete.edate');
        // Set default order
        $this->order = array('created' => 'desc');
        $this->corder = array('athlete.created' => 'desc');
	}

    public function getAthlete($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('company_id',$this->company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCAthlete($postData){
        $this->_get_datatables_queryC($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('coach_athlete.coach_id',$this->coach_id);
        $this->db->join('athlete', 'coach_athlete.athlete_id = athlete.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAllC(){
        $this->db->where('coach_athlete.coach_id',$this->coach_id);
        $this->db->join('athlete', 'coach_athlete.athlete_id = athlete.id');
        $this->db->from('coach_athlete');
        return $this->db->count_all_results();
    }

    public function countAll(){
        $this->db->where('company_id',$this->company_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $this->db->where('company_id',$this->company_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function countFilteredC($postData){
        $this->_get_datatables_queryC($postData);
        $this->db->where('coach_athlete.coach_id',$this->coach_id);
        $this->db->join('athlete', 'coach_athlete.athlete_id = athlete.id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
        $this->db->where('company_id',$this->company_id);
 
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

    private function _get_datatables_queryC($postData){
         
        $this->db->from('coach_athlete');
        $i = 0;
        // loop searchable columns 
        foreach($this->ccolumn_search as $item){
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
                if(count($this->ccolumn_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->ccolumn_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}