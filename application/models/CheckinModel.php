<?php
class CheckinModel extends CI_Model {
	function __construct() {
		parent::__construct();
        // Set table name
        $this->table = 'check_in';
        $this->athlete_id= 0;
        if(!empty($this->session->userdata('athlete_id')))
        {
            $this->athlete_id= $this->session->userdata('athlete_id'); 
        }else{
            if($this->session->userdata('type')=='athlete')
            {
                $this->athlete_id= $this->session->userdata('id');
            }else{
                $this->athlete_id= 0;
            }
        }
        
        // Set orderable column fields
        $this->column_order = array(null, 'from', 'to');
        // Set searchable column fields
        $this->column_search = array('from','to');
        // Set default order
        $this->order = array('from' => 'asc');
	}

    public function getACheckinHistory($s,$l){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('athlete_id',$this->athlete_id);
        $this->db->order_by('created','asc');
        $this->db->limit($l,$s);
        $query = $this->db->get();
        return $query;
    }

    public function getACheckin($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('athlete_id',$this->athlete_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->where('athlete_id',$this->athlete_id);
        $this->db->from($this->table);
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
}