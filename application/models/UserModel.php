<?php
class UserModel extends CI_Model {
	function __construct() {
		parent::__construct();
        // Set table name
        $this->table = 'coach';
        // Set orderable column fields
        $this->column_order = array(null, 'name','email');
        // Set searchable column fields
        $this->column_search = array('name','email');
        // Set default order
        $this->order = array('name' => 'asc');
	}

    function insert($data,$table)
    {
        if($this->db->insert($table, $data))
        {
            return true;
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

    public function getCoach($postData){
        $this->_get_datatables_query($postData);
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
 
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