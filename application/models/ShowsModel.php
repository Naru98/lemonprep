<?php
class ShowsModel extends CI_Model {
	function __construct() {
		parent::__construct();
        // Set table name
        $this->table = 'shows';
        if(!empty($this->session->userdata('id')))
        {
            $this->coach_id= $this->session->userdata('id'); 
        }else{
            $this->coach_id= 0;
        }
        // Set orderable column fields
        $this->column_order = array(null, 'title','date');
        // Set searchable column fields
        $this->column_search = array('title','date');
        // Set default order
        $this->order = array('created' => 'asc');

        // Set orderable column fields
        $this->column_orderA = array(null, 'shows.title','shows.date');
        // Set searchable column fields
        $this->column_searchA = array('shows.title','shows.date');
        // Set default order
        $this->orderA = array('shows.created' => 'asc');
	}

    public function getShows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('coach_id',$this->coach_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAShowsA($postData){
        $this->_get_datatables_queryA($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->where('coach_id',$this->coach_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $this->db->where('coach_id',$this->coach_id);
        $query = $this->db->get();
        return $query->num_rows();
    }


    /*
     * Count all records
     */
    public function countAllA(){
        $this->db->from('shows_athlete');
        $this->db->where('shows_athlete.athlete_id',$this->coach_id);
        $this->db->join('shows', 'shows.id = shows_athlete.shows_id');
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFilteredA($postData){
        $this->_get_datatables_queryA($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
        $this->db->where('coach_id',$this->coach_id);
 
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
         
        $this->db->from('shows_athlete');
        $this->db->where('shows_athlete.athlete_id',$this->coach_id);
        $this->db->join('shows', 'shows.id = shows_athlete.shows_id');
        $i = 0;
        // loop searchable columns 
        foreach($this->column_searchA as $item){
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
                if(count($this->column_searchA) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_orderA[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->orderA)){
            $order = $this->orderA;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}